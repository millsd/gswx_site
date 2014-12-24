<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Talk to a database table.
 *
 * @package    gswx
 * @subpackage Models
 * @author     Dan Mills
 */

class Db extends CI_Model {
	protected $db_table = NULL;

	function __construct() {
		parent::__construct();
		$this->load->database(); 
		$this->db->simple_query("SET time_zone = '+0:00'");
	}

	public function create($row) {
		if ( ! isset($row->created)) $row->created = date('Y-m-d H:i:s');
		if ( ! isset($row->updated)) $row->updated = $row->created;

		$this->db->insert($this->db_table, $row);
		return $this->db->insert_id();
	}

	public function read($id) {
		$id = (int) $id;
		$this->db->where('id', $id);
		$query = $this->db->get($this->db_table, 1);
		$result = $query->result();
		$query->free_result();
		return count($result) ? $result[0] : FALSE;
	} 

	public function fetch($wh) {
		$wh = (string) $wh;
		$this->db->where($wh);
		$this->db->order_by('id');
		$query = $this->db->get($this->db_table);
		$result = array();
		foreach ($query->result() as $row) {
			$id = $row->id;
			$result[$id] = $row;
		}
		$query->free_result();
		return count($result) ? $result : array();
	}



}
/* End of file */
