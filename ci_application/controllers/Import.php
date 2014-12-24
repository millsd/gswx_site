<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Display a map
 *
 * @package    gswx
 * @subpackage Controllers
 * @author     Dan Mills
 */

/**
 * 
 */
class Import extends CI_Controller {

	/**
	 * Enable CI profiler?
	 * @var bool
	 * @access private
	 */
	private $_profile = 1;

	/**
	 * Constructor
	 */
	public function __construct( ) {
		if ( ! GSWX_ALLOW_INPUT_XML) {
			show_error('Service not available.', 400);
			exit;
		}
		parent::__construct();
		$this->_profile = (bool) $this->_profile;
		$this->output->enable_profiler($this->_profile);
	}

	/**
	 * Accept Google-Earth-generated KML via $_POST['kml_in']
	 *
	 * @return void
	 * @access public
	 */
	public function ge_kml($dryrun=1) {
		$this->load->model('Db_documents');
		$this->load->model('Db_coordinates');
		$this->load->model('Db_folders');
		$this->load->model('Db_points');

		$this->load->config('gswx');
		$icon_types = $this->config->item('icon_types');
		$styles = $this->config->item('style_types');

		$the_magic_folder_name = 'STAGEDRAFT';
		$created = date('Y-m-d H:i:s');

		$kml_in = trim($this->input->post('kml_in'));
		$kml_in_entity_esc = htmlentities($kml_in);

		$name = strip_tags(trim(
				substr($this->input->post('doc_name', TRUE), 0, 100)));
		$description = trim(substr($this->input->post('doc_descrip', TRUE), 0, 10000));
		$parent = 'D' . (int) $this->input->post('doc_id');
		$document = (object) compact('name', 'description', 'parent');
		if ($dryrun) {
			$document->id =  time() . mt_rand(10,99);;
		} else {
			$document->id = $this->Db_documents->create($document);
		}

		$folders = array();
		$points = array();
		$coordinates = array();

		try {
			if ( ! $kml_in) throw new InvalidArgumentException('No data.');

			libxml_use_internal_errors(TRUE);
			$kml = simplexml_load_string($kml_in);
			$xml_err = libxml_get_errors();
			if ($xml_err) {
				throw new InvalidArgumentException('XML not well formed:' . $xml_err[0]->message);
			}

			$path = array();
			foreach ($kml->Document->Folder as $Folder) {
				$name = @$Folder->name->__toString();
				if ($name != $the_magic_folder_name) continue;

				# First loop over points/placemarks
				foreach ($Folder->Placemark as $pt) {
					if ( ! is_object($pt->Point->coordinates)) continue;
					$coords = $pt->Point->coordinates->__toString();
					list($lon, $lat) = explode(',', $coords);
					$key = "$lon,$lat";
					$coordinates[$key] = (object) compact('lon', 'lat', 'created');

					$styleUrl = @$pt->styleUrl->__toString();
					$pt->style = 'default';
					foreach (array_keys($icon_types) as $pt_type) {
						if (strpos($styleUrl, "_$pt_type")) {
							$pt->style = $icon_types[$pt_type];
							break;
						}
					}
					
					if ($pt->name == '.') $pt->style = 'cairn';

					# Handle both LookAt and Camera as lookat.
					if ($pt_type == 'man' and isset($pt->Camera)) {
						$pt->Camera->range = 200;
						unset($pt->Camera->roll);
						$pt->lookat = json_encode($pt->Camera);
					}
					if ($pt_type == 'man' and isset($pt->LookAt)) {
						$pt->lookat = json_encode($pt->LookAt);
					}
					if (isset($pt->LookAt)) unset($pt->LookAt);
					if (isset($pt->Camera)) unset($pt->Camera);

					list($pt->lon, $pt->lat, $pt->ele) = explode(',',
						$pt->Point->coordinates->__toString()
					  );
					unset($pt->styleUrl, $pt->Point);
					$points[$key] = $pt;

					$pt_style = $pt->style->__toString();
					$name = $styles[$pt_style]->folder;
					if ($name) {
						if ( ! isset($folders[$name])) {
							$parent = 'D' . $document->id;
							$folder = (object) compact('name', 'parent');
							$folder->id = $dryrun ? 
									rand(0,999) : $this->Db_folders->create($folder);
							$folder->points = array();
							$folders[$name] = $folder;
						}
						$folders[$name]->points[] = $key;
					}
				}
			}

			$coordinates = $this->Db_coordinates->save_batch($coordinates);

			// 2nd loop thru points/placemarks
			foreach ($points as $key => $pt) {
				if (isset($coordinates[$key])) {
					$pt->coord_id = $coordinates[$key]->id;
				}
				foreach ($folders as $folder) {
					if (in_array($key, $folder->points)) {
						$pt->parent = 'F' . $folder->id;
					}
				}
				if ( ! isset($pt->parent)) {
					$pt->parent =  'D' . $document->id;
				}
				$pt->id = $dryrun ? 
						rand(0,999) : $this->Db_points->create($pt);
				$points[$key] = $pt;
			}

			$v = compact('document', 'folders', 'points', 'coordinates', 'kml', 
					'kml_in_entity_esc');
			echo '<pre>', print_r($v,1), '</pre>', PHP_EOL;
	
			//$kml = htmlentities(file_get_contents($data_path));
		} catch (Exception $e) {
			echo '<pre>', $e->getMessage(), print_r($kml_in,1), '</pre>';
			//show_error($e->getMessage(), 400);
		}
		return;
	}

						//$folders[$pt_type]->points[] = $key;
					//echo('<pre>'.print_r(compact('pt','key','folders'),1));
/*							if ( ! isset($folders[$pt_type])) {
								$folders[$pt_type] = (object) array(
									'name' => "$document->name {$icon_types[$pt_type]}",
									'parent' => "D$document->id",
									'created' => $created,
									'points' => array()
								  );
							}*/

	public function index() {
		echo '<html><body>', form_open('import/ge_kml/1'),
			'Doc name: <input name="doc_name"><br>
			  Doc descrip: <input name="doc_descrip"><br>
			  KML: <textarea name="kml_in"></textarea><br>
			  Doc type: <select name="doc_id">
				<option value="1">The Great Stones Way: Wiltshire, England</option>
				<option value="10">The Great Stones Way: Stage 1</option>
				<option value="20">The Great Stones Way: Stage 2</option>
				<option value="30">The Great Stones Way: Stage 3</option>
				<option value="40">The Great Stones Way: Stage 4</option>
				<option value="50">The Great Stones Way: Stage 5</option>
				<option value="60">The Great Stones Way: Stage 6</option>
				<option value="101">Great Stones Way: Variants</option>
				<option value="102">Great Stones Way: Extensions</option>
				<option value="103">Great Stones Way: Tracks</option>
				<option value="104">Great Stones Way: Intersecting Trails</option>
				<option value="105" selected>Great Stones Way: Custom Maps</option>
				<option value="106">Great Stones Way: Transportation</option>
				<option value="107">Great Stones Way: Accomodations</option>
				<option value="108">Great Stones Way: Pubs</option>
			  </select><br>
			  <input type="submit" value="Send GE KML">
			</form></body></html>';
		return;
	}

}
/* End of file */

			/* stream kml (for potential use on /data) --
			//header('Content-Description: File Transfer');
			header('Content-Type: application/vnd.google-earth.kml+xml');
			//header('Content-Disposition: attachment; filename='.basename($file));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($data_path));
			readfile($data_path);
			*/
