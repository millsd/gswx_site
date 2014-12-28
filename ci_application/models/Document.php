<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Model a GSWX Document.
 *
 * @package    gswx
 * @subpackage Models
 * @author     Dan Mills
 */

class Document extends CI_Model {

	private $doc = NULL;
	private $styles= array();
	private $default_interval = 5; # 5/10ths of mile

	function __construct() {
		parent::__construct();
	}

	public function children() {
		$doc = $this->doc;
		if ($doc->recursive < 1) return;
		$children = array();
		$child_docs = array();
		$where = "parent = 'D{$this->doc->id}' ";
		if ($doc->children) {
			$where .= "OR id IN ($doc->children)";
		}
		foreach ($this->Db_documents->fetch($where) as $doc_id => $child) {
			$doc_instance_name = "doc_$doc_id";
			$this->load->model('Document', $doc_instance_name);
			$this->$doc_instance_name->set($child);
			$this->$doc_instance_name->stations();
			$this->$doc_instance_name->folders();
			$this->$doc_instance_name->path();
				$this->$doc_instance_name->cull();
			if ($doc->recursive > 1) {
				$this->$doc_instance_name->children();
			}
			$child_docs[$doc_id] = $this->$doc_instance_name->get();
		}
		foreach ($child_docs as $doc_id => $child) {
			$children[$doc_id] = $child->name;
			if (isset($child->paths) and $child->paths) {
				foreach ($child->paths as $path_id => $path_obj) {
					$this->add_style($path_obj->style);
					$doc->paths[$path_id] = $path_obj;
				}
			}
			/*if (isset($child->stations) and $child->stations) {
				foreach ($child->stations as $st_id => $st_obj) {
					if ( ! isset($doc->stations[$st_id])) {
						$doc->stations[$st_id] = $st_obj;
						$this->add_style($st_obj->style);
					}
				}
			}*/
			if (isset($child->points) and $child->points) {
				foreach ($child->points as $pt_id => $pt_obj) {
					if ( ! $pt_obj) continue;
					if (strpos($pt_obj->style, 'terminal_') === 0) continue;
					if ( ! isset($doc->points[$pt_id])) {
						$doc->points[$pt_id] = $pt_obj;
						$this->add_style($pt_obj->style);
					}
				}
			}
			if (isset($child->folders) and $child->folders) {
				foreach ($child->folders as $fd_id => $fd_obj) {
					if ( ! isset($doc->folders[$fd_id])) {
						$doc->folders[$fd_id] = $fd_obj;
					}
				}
			}
		}
		$doc->children = $children;
		$this->doc = $doc;
	}

	public function cull($interval=FALSE) {
		if ( ! $interval) $interval = $this->default_interval;
		if ( ! isset($this->doc->folders)) $this->folders();
		$doc = $this->doc;
		foreach ($doc->points as $pt_id => $pt_obj) {
			if ( ! $pt_obj) continue;
			list($class) = explode('_', $pt_obj->style);
			switch ($class) {
				# Remove all cairns.
				case 'cairn':
					unset($doc->points[$pt_id]);
					break;
				case 'milestone':
					# Show milestones per interval.
					$bits = explode('.', $pt_obj->name);
					array_shift($bits);
					$distance = (implode('', $bits)) * 10;
					$modulo = $interval * 10;
					if ($distance % $modulo != 0) {
						$doc->points[$pt_id] = FALSE;
					}
					break;
			}
		}
		if ($doc->components) {
			$components = explode(',', $doc->components);
			foreach ($doc as $k => $v) {
				if ($k == 'styles') continue;
				if ( ! in_array($k, $components) and is_array($v)) {
					unset($doc->$k);
				}
			}
		}
		$this->doc = $doc;
	}

	public function get($interval=FALSE) {
		$this->styles();
		$this->cull($interval);
		return $this->doc;
	}

	public function set($doc) {
		if ( ! isset($doc->color)) {
			$station_colors = $this->config->item('station_colors');
			$doc->color = $station_colors->gray;
		}
		if ( ! isset($doc->folders)) $doc->folders = array();
		$this->doc = $doc;
		return $doc;
	}

	public function folders() {
		if ( ! isset($this->doc->points)) $this->points();
		$station_colors = $this->config->item('station_colors');
		$doc = $this->doc;
		$where = "parent = 'D$doc->id' ";
		$doc->folders = $this->Db_folders->fetch($where);
		
		$where = array();
		foreach ($doc->folders as $i => $f_obj) {
			$where[] = "F$f_obj->id";
			$doc->folders[$i]->name = "$doc->name {$doc->folders[$i]->name}";
			$doc->folders[$i]->points = array();
		}
		if (count($where)) {
			$where = "parent IN ('" . implode("', '", $where) . "')";
			foreach ($this->Db_points->fetch($where) as $pt_id => $pt_obj) {
				$folder_id = substr($pt_obj->parent, 1);
				$doc->folders[$folder_id]->points[] = $pt_id;
				$doc->points[$pt_id] = $pt_obj;
			}
		}

		ksort($doc->points);
		foreach ($doc->points as $pt_id => $pt_obj) {
			switch ($pt_obj->style) {
				case 'cairn':
					#$pt_obj->style = FALSE;
					break;
				case '':
					$pt_obj->style .= '_' . $station_colors->gray->kml;
					break;
				case 'terminal_a':
					$pt_obj->style .= '_' . $station_colors->grn->kml;
					break;
				case 'terminal_z':
					$pt_obj->style .= '_' . $station_colors->red->kml;
					break;
				case 'interesting':
				case 'streetview':
				case 'milestone':
				case 'direction':
				default:
					$pt_obj->style .= '_' . $doc->color->kml;
			}
			$this->add_style($pt_obj->style);
			$doc->points[$pt_id] = $pt_obj;
		}

		$this->doc = $doc;
		return $doc->folders;
	}

	public function path() {
		if ( count($this->doc->folders)) $this->folders();
		$doc = $this->doc;
		$path = (object) array(
			'name' => "$doc->name Path",
			'style' => 'path_' . $doc->color->kml,
			'coords' => array(),
		  );
		$path_marks = array('cairn', 'milestone', 'terminal');
		foreach ($doc->points as $pt_id => $pt_obj) {
			$style_bits = explode('_', $pt_obj->style);
			if (in_array($style_bits[0], $path_marks)) {
				$path->coords[] = "$pt_obj->lon,$pt_obj->lat,0";
			}
		}
		$path->coords = implode(' ', $path->coords);
		$this->add_style($path->style);
		$doc->paths = array($doc->id => $path);
		$this->doc = $doc;
		return $doc->paths;
	}

	public function points() {
		$doc = $this->doc;
		$where = "parent = 'D$doc->id' ";
		$doc->points = $this->Db_points->fetch($where);
		$this->doc = $doc;
		return $doc->points;
	}

	public function stations() {
		$doc = $this->doc;
		$doc->stations = $this->Db_points->fetch_stations($doc->stations);
		foreach ($doc->stations as $st_obj) {
			$this->add_style($st_obj->style);
			$doc->color = $st_obj->color;
		}
		$this->doc = $doc;
		return $doc->stations;
	}

	public function styles() {
		$doc = $this->doc;
		$doc->styles = array();
		$st_types = $this->config->item('style_types');
		foreach ($this->styles as $st_id) {
			$bits = ($st_id=='cairn') ? array($st_id,'') : explode('_',$st_id);
			$color = array_pop($bits);
			$type = implode('_', $bits);
			$class = $bits[0];
			$doc->styles[$st_id] = (object) compact('type', 'class', 'color');
			if (isset($st_types[$type])) {
				$doc->styles[$st_id]->folder = $st_types[$type]->folder;
				$doc->styles[$st_id]->icon_href = $st_types[$type]->icon_href;
			} elseif (isset($st_types[$class])) {
				$doc->styles[$st_id]->folder = $st_types[$class]->folder;
				$doc->styles[$st_id]->icon_href = $st_types[$class]->icon_href;
			} else {
				$doc->styles[$st_id]->folder = FALSE;
				$doc->styles[$st_id]->icon_href = FALSE;
			}
		}
		$this->doc = $doc;
		return $doc->styles;
	}

	protected function add_style($style) {
		if ($style and ! in_array($style, $this->styles)) {
			$this->styles[] = $style;
		}
	}

}
/* End of file */
