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
class Doc extends CI_Controller {

	/**
	 * Enable CI profiler?
	 * @var bool
	 * @access private
	 */
	private $_profile = FALSE;

	/**
	 * Constructor
	 */
	public function __construct( ) {
		parent::__construct();
		$this->_profile = (bool) $this->_profile;
		$this->output->enable_profiler($this->_profile);
	}

	/**
	 * 
	 * @param string $segment
	 * @return void
	 * @access public
	 */
	public function id($doc_id=0) {
		$this->load->model('Db_documents');
		$this->load->model('Db_coordinates');
		$this->load->model('Db_folders');
		$this->load->model('Db_points');

		$doc_id = (int) $doc_id;
		try {
			$doc = $this->Db_documents->read($doc_id);
			if ( ! $doc) throw new InvalidArgumentException("$doc_id not found");

			$stations = $this->config->item('stations');
			$style_types = $this->config->item('style_types');
			switch ($doc->parent) {
				case 'D10':
					$doc->color = $stations['1B']->color;
					break;
				default:
					$doc->color = 'default';
			}

			$doc->stations = $this->Db_points->fetch_stations($doc->stations);
			$doc->points = array();
			$doc->folders = $this->Db_folders->fetch("parent = 'D$doc_id'");
			$doc->path = array();

			foreach ($doc->folders as $i => $folder) {
				$folder->points = array();
				unset($doc->folders[$i]);
				$doc->folders["$folder->id"] = $folder;
			}

			$styles = array("path_{$doc->color->kml}" => 'line_style');
			foreach ($doc->stations as $sta_id => $sta_obj) {
				$style_id = $sta_obj->db->style . '_' . $doc->color->kml;
				if ( ! isset($styles[$style_id])) {
					$styles[$style_id] = $style_types[$sta_obj->db->style];
				}
				$doc->stations[$sta_id]->db->style = $style_id;
			}

			$where = "parent = 'D$doc_id' ";
			foreach ($doc->folders as $folder) {
				$where .= "OR parent = 'F$folder->id' ";
			}
			foreach ($this->Db_points->fetch($where) as $pt) {
				$pt->color = $doc->color->kml;
				if (strpos($pt->style, 'terminal') === 0 or
						$pt->style == 'milestone' or $pt->style == 'cairn') {
					$doc->path[] = "$pt->lon,$pt->lat,$pt->ele";
					if ($pt->style == 'cairn') continue;
					if ($pt->style == 'milestone') {
						$bits = explode('.', $pt->name);
						array_shift($bits);
						$distance = (implode('', $bits)) * 10;
						if ($distance % 50 != 0) continue;
						$mi = $distance/100;
						$km = round($mi * 1.60934, 1);
						$pt->description .= "$mi&nbsp;mi from start ($km&nbsp;km)";
						$pt->color = 'ffcccccc';
					} else { /* terminal of some kind */
						if ($pt->style == 'terminal_a') $pt->color = 'ee00ff00';
						if ($pt->style == 'terminal_z') $pt->color = 'ee0000ff';
					}
				}

				switch ($pt->parent[0]) {
					case 'D':
						$doc->points[] = $pt;
						break;
					case 'F':
						$folder_id = mb_substr($pt->parent, 1);
						$doc->folders[$folder_id]->points[] = $pt;
						break;
				}

				$style_id = $pt->style . '_' . $pt->color;
				if ( ! isset($styles[$style_id])) {
					$styles[$style_id] = $style_types[$pt->style];
				}
				$pt->style = $style_id;
			}
			$doc->path = str_replace(',0.000', ',0', implode(' ', $doc->path));
			$doc->styles = $styles;

			$v = compact('doc');
			$kml = $this->load->view('kml/doc.kml.php', $v, TRUE);
			//echo '<pre>'.print_r(htmlentities($kml),1); return;

			$new_file_name = "anon/gswx$doc->id.kml";
			file_put_contents(GSWX_DATAROOT . $new_file_name, $kml);
		} catch (Exception $e) {
			if (get_class($e) == 'InvalidArgumentException') {
				show_404();
			} else {
				show_error($e->getMessage());
			}
		}

		$v = compact('styles', 'doc_id', 'doc', 'new_file_name');
		$debug = $v; $v['debug'] = $debug;
		$this->load->view('doc/id', $v);
		return;
	}

	public function index() {
		echo 'love';
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
