<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Talk to the `coordinates database table.
 *
 * @package    gswx
 * @subpackage Models
 * @author     Dan Mills
 */

require_once('Db.php');

class Db_points extends Db {

	//private $last_test_coord_id = 100;
	//const COORD_NUM_DECIMALS = 5;

	public function __construct() {
		parent::__construct();
		$this->db_table = 'points';
	}

	public function fetch($wh) {
		$result = parent::fetch($wh);
		if ( ! $result) return $result;
		foreach ($result as $i => $row) {
			if ($row->lookat) {
				$row->lookat = json_decode($row->lookat);
				$result[$i] = $row;
			}
		}
		return $result;
	}

	public function fetch_stations($stations=FALSE) {
		$cfg = $this->config->item('stations');
		if ( ! $stations) $stations = array_keys($cfg);
		if ( ! is_array($stations)) $stations = explode(',', $stations);

		$rtn = array();
		$where_in = array();
		foreach ($stations as $st_id) {
			if ( ! isset($cfg[$st_id])) continue;
			if ( ! isset($cfg[$st_id]->pt_id)) continue;
			$rtn[$st_id] = $cfg[$st_id];
			$where_in[] = $rtn[$st_id]->pt_id;
		}

		$this->db->where_in('id', $where_in);
		$query = $this->db->get('points');
		foreach ($query->result() as $row) {
			$pt_id = $row->id;
			foreach ($rtn as $st_id => $st_obj) {
				if ($st_obj->pt_id == $pt_id) {
					$rtn[$st_id]->db = $row;
					break;
				}
			}
		}
		$query->free_result();

		return $rtn;
	}

}
/* End of file */
