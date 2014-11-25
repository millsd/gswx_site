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
class Map extends CI_Controller {

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
	public function data($segment_1=FALSE) {
		$data_path = GSWX_APPROOT . 'data/' .implode('/', func_get_args()) . '.kml';
		$public_data_path = str_replace(array(GSWX_APPROOT, '.kml'), '', $data_path);
		try {
			if ( ! $segment_1 or ! is_readable($data_path)) {
				throw new InvalidArgumentException("Invalid data file: $public_data_path");
			}

			libxml_use_internal_errors(TRUE);
			$xml = simplexml_load_file($data_path);
			$xml_err = libxml_get_errors();
			if ($xml_err) {
				throw new Exception("Invalid XML in $public_data_path: " . $xml_err[0]->message);
			}
			//echo '<pre>', print_r(readfile($data_path),1), PHP_EOL;
	
			$kml = htmlentities(file_get_contents($data_path));
		} catch (Exception $e) {
			if (get_class($e) == 'InvalidArgumentException') {
				show_404($e->getMessage());
			} else {
				show_error($e->getMessage());
			}
		}

		$v = compact('public_data_path', 'kml', 'xml');
		$debug = $v; $v['debug'] = $debug;
		$this->load->view('map/data', $v);
		return;
	}

	/**
	 * 
	 * @param string $segment
	 * @return void
	 * @access public
	 */
	public function build($segment_1=FALSE) {
		$data_path = GSWX_APPROOT . 'data/' .implode('/', func_get_args());
		$public_data_path = str_replace(GSWX_APPROOT, '', $data_path);
		try {
			if ( ! $segment_1 or ! is_readable($data_path)) {
				throw new InvalidArgumentException("Invalid data file: $public_data_path");
			}

			libxml_use_internal_errors(TRUE);
			$xml = simplexml_load_file($data_path);
			$xml_err = libxml_get_errors();
			if ($xml_err) {
				throw new Exception("Invalid XML in $public_data_path: " . $xml_err[0]->message);
			}

			$doc_name = $xml->Document->name->__toString();
			$folders = array();
			foreach ($xml->Document->Folder as $Folder) {
				$points = array();
				foreach ($Folder->Placemark as $pt) {
					if ( ! is_object($pt->Point->coordinates)) continue;
					$name = $pt->name->__toString();
					list($lon, $lat, $ele) = explode(',',
							$pt->Point->coordinates->__toString()
					  );
					$points[] = (object) compact('name', 'lon', 'lat', 'ele');
				}
				$name = $Folder->name->__toString();
				$folders[] = (object) compact('name', 'points');
			}

			$v = compact('doc_name', 'folders', 'xml', 'public_data_path');
			$kml = $this->load->view('kml/document.kml.php', $v, TRUE);
			//$kml = str_replace("\t", ' ', $kml);

			$new_file_name = GSWX_APPROOT . 'data/anon/gswx' . time() . mt_rand(10,99);
			file_put_contents($new_file_name . '.kml', $kml);
			redirect('map/' . str_replace(GSWX_APPROOT, '', $new_file_name), 303);
			//echo '<pre>', trim(htmlentities($kml)), PHP_EOL;


		} catch (Exception $e) {
			if (get_class($e) == 'InvalidArgumentException') {
				show_404($e->getMessage());
			} else {
				show_error($e->getMessage());
			}
		}
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
