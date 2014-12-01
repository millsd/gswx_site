<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Talk to the `coordinates database table.
 *
 * @package    gswx
 * @subpackage Models
 * @author     Dan Mills
 */

require_once('Db.php');

class Db_documents extends Db {

	//private $last_test_coord_id = 100;
	//const COORD_NUM_DECIMALS = 5;

	public function __construct() {
		parent::__construct();
		$this->db_table = 'documents';
	}

	public function create($doc) {
		$doc->id = time() . mt_rand(10,99);
		parent::create($doc);
		return $doc->id;
	}

}
/* End of file */
