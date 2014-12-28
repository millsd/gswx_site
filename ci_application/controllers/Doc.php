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
	private $milestone_interval = 5;

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

		/*$this->load->driver('cache', array('adapter' => 'file'));
		if ( ! $foo = $this->cache->get('foo')) {
			 echo 'Saving to the cache!<br />';
			 $foo = 'foobarbaz!';
			 // Save into the cache for 5 minutes
			 $this->cache->save('foo', $foo, 30);
		}
		echo $foo; */

	}

	/**
	 * 
	 * @param string $segment
	 * @return void
	 * @access public
	 */
	public function id($doc_id=0) {
		$this->load->model('Document');
		$this->load->model('Db_documents');
		$this->load->model('Db_coordinates');
		$this->load->model('Db_folders');
		$this->load->model('Db_points');

		$doc_id = (int) $doc_id;
		try {
			$doc = $this->Db_documents->read($doc_id);
			if ( ! $doc) throw new InvalidArgumentException("$doc_id not found");

			$this->Document->set($doc);
			$this->Document->stations();
			//echo('<pre>'.print_r($doc,1));return;
			$this->Document->folders();
			$this->Document->path();
			$this->Document->children();
			$doc = $this->Document->get();
			//echo('<pre>'.print_r($doc,1));return;

			$v = compact('doc');
			$kml = $this->load->view('kml/doc.kml.php', $v, TRUE);
			//echo '<pre>'.htmlentities(print_r($kml,1));return;

			$new_file_name = "anon/gswx$doc->id.kml";
			file_put_contents(GSWX_DATAROOT . $new_file_name, $kml);
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

	public function index() {
		return $this->id(2);
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
