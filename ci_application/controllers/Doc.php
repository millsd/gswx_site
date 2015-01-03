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
	 * How many 10ths of a mile between stones?
	 * @var int
	 * @access private
	 */
	private $cache_time_to_live = 7776000; // 90 days

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

		$this->load->driver('cache', array('adapter' => 'file'));
		$this->load->model('Document');
		$this->load->model('Db_documents');
		$this->load->model('Db_coordinates');
		$this->load->model('Db_folders');
		$this->load->model('Db_points');
	}

	/**
	 * Display a station document.
	 *
	 * @param int $doc_id
	 * @return void
	 * @access public
	 */
	public function station($stn_id=0) {
		$doc_id = is_numeric($stn_id) 
		        ? ($stn_id - 1) * 10 : 0;
		if ($doc_id < 10 or $doc_id > 100) {
			switch ($stn_id) {
				case '1B':
					$doc_id = 13;
					break;
				case 1:
				case '5A':
				default:
					$doc_id = 1;
			}
		}
		return $this->id($doc_id);
	}

	/**
	 * Display a document.
	 *
	 * @param int $doc_id
	 * @return void
	 * @access public
	 */
	public function id($doc_id=0, $format='html') {
		$doc_id = (int) $doc_id;
		switch ($format) {
			case 'kml':
				$format = $format;
				break;
			case 'html':
			default:
				$format = $format;
		}
		$cache_id = "controller_doc_{$doc_id}_{$format}";
		$new_file_name = "anon/gswx$doc_id.kml";

		try {
			$doc = $this->cache->get($cache_id);
			if ( ! $doc /* or 1 */) {
				$doc = $this->Document->marshal($doc_id);
				$this->cache->save($cache_id, $doc, $this->cache_time_to_live);
				$v = compact('doc');
				$kml = $this->load->view('kml/doc.kml.php', $v, TRUE);
				file_put_contents(GSWX_DATAROOT . $new_file_name, $kml);
			}
		} catch (Exception $e) {
			if (get_class($e) == 'InvalidArgumentException') {
				show_404();
			} else {
				show_error($e->getMessage());
			}
		}

		$v = compact('doc', 'styles', 'doc_id', 'new_file_name');
		//$debug = $v; $v['debug'] = $debug;

		$this->load->view('doc/id', $v);
		return;
	}

	/**
	 * Site index
	 *
	 * @return void
	 * @access public
	 */
	public function index() {
		$doc_id = 2;
		$cache_id = "controller_doc_{$doc_id}_html";
				$new_file_name = "anon/gswx$doc_id.kml";
		try {
			$doc = $this->cache->get($cache_id);
			if ( ! $doc /* or 1 */) {
				$doc = $this->Document->marshal($doc_id);
				$this->cache->save($cache_id, $doc, $this->cache_time_to_live);
				$v = compact('doc');
				$kml = $this->load->view('kml/doc.kml.php', $v, TRUE);
				file_put_contents(GSWX_DATAROOT . $new_file_name, $kml);
			}
		} catch (Exception $e) {
			if (get_class($e) == 'InvalidArgumentException') {
				show_404();
			} else {
				show_error($e->getMessage());
			}
		}

		$v = compact('doc', 'styles', 'doc_id', 'new_file_name');
		//$debug = $v; $v['debug'] = $debug;

		$this->load->view('site_index', $v);
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
