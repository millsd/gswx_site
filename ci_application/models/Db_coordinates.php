<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Talk to the `coordinates database table.
 *
 * @package    gswx
 * @subpackage Models
 * @author     Dan Mills
 */

require_once('Db.php');

class Db_coordinates extends Db {

	private $last_test_coord_id = 100;
	const COORD_NUM_DECIMALS = 5;

	public function __construct() {
		parent::__construct();
		$this->db_table = 'coordinates';
	}

	public function save_batch($batch) {
		$num = self::COORD_NUM_DECIMALS;
		$this->db->select("`id`, CONCAT(`lon`, ',', `lat`) AS rounded", FALSE);
		$this->db->where('id >', $this->last_test_coord_id);
		foreach ($batch as $i => $coord) {
			$round_lon = sprintf("%0.{$num}f", round($coord->lon, $num));
			$round_lat = sprintf("%0.{$num}f", round($coord->lat, $num));
			$wh_clause = "(`lon`=$round_lon AND `lat`=$round_lat)";
			$this->db->or_where($wh_clause, NULL, FALSE);
			$batch[$i]->rounded = "$round_lon, $round_lat";
		}
		$query = $this->db->get($this->db_table);
		$existing = array();
		foreach ($query->result() as $row) $existing[$row->rounded] = $row->id;
		$query->free_result();
		$existing_rounded = array_keys($existing);

		$touched = date('Y-m-d H:i:s');
		foreach ($batch as $i => $coord) {
			//$lon_ext = $coord->lon;
			//$lat_ext = $coord->lat;
			if (in_array($coord->rounded, $existing_rounded)) {
				$coord->id = $existing[$coord->rounded];
				list($coord->lon, $coord->lat) = explode(',', $coord->rounded);
				unset($coord->rounded);
				$coord->touched = $touched;
				unset($coord->created);
				$update = (object) compact('touched');
			//	$this->db->update($this->db_table, $update, "id = $coord->id");
			} else {
				$coord->touched = $coord->created;
				list($coord->lon, $coord->lat) = explode(',', $coord->rounded);
				unset($coord->rounded);
				$this->db->insert($this->db_table, $coord);
				$coord->id = $this->db->insert_id();
			}
			//$coord->lon_ext = $lon_ext;
			//$coord->lat_ext = $lat_ext;
			$batch[$i] = $coord;
		}

		return $batch;
	}

}
/* End of file */
