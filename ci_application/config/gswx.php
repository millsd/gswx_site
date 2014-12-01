<?php
/**
 * Config for folder types
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$config['station_colors'] = (object) array(
	'gray' => (object) array('kml'=>'508C8C8C', 'html'=>'8C8C8C', 'rgb'=>'140,140,140'),
	'grn' => (object) array('kml'=>'503CFA14', 'html'=>'14FA3C', 'rgb'=>'60,250,20'),
	'ylw' => (object) array('kml'=>'ee00ffff', 'html'=>'ffff00'),
	'ylw_a' => (object) array('kml'=>'ee66ffff', 'html'=>'ffff66'),
	'orng' => (object) array('kml'=>'ee0099ff', 'html'=>'ff9900'),
	'orng_a' => (object) array('kml'=>'ee6699ff', 'html'=>'ff9966'),
	'ltblu' => (object) array('kml'=>'50F0FF14', 'html'=>'14FFF0', 'rgb'=>'240,255,20'),
	'pink' => (object) array('kml'=>'507832F0', 'html'=>'F03278', 'rgb'=>'120,50,240'),
	'purple' => (object) array('kml'=>'50FA78B4', 'html'=>'B478FA', 'rgb'=>'250,120,180'),
	'red' => (object) array('kml'=>'501400FF', 'html'=>'FF0014', 'rgb'=>'20,0,255'),
	'brown' => (object) array('kml'=>'50143C8C', 'html'=>'8C3C14', 'rgb'=>'20,60,140')
);

$config['stations'] = array(
	0 => (object) array('name'=>'Swindon Rail Station', 
		'type'=>'minor', 'color'=>$config['station_colors']->gray),
	1 => (object) array('name'=>'Barbury Castle', 
		'type'=>'major', 'color'=>$config['station_colors']->grn),
	'1a' => (object) array('name'=>'Herepath', 'pt_id'=>11,
		'type'=>'minor', 'color'=>$config['station_colors']->ylw_a),
	'1B' => (object) array('name'=>'Avebury', 'pt_id'=>12, 
		'type'=>'monument', 'color'=>$config['station_colors']->ylw_a),
	2 => (object) array('name'=>'Overton Hill', 'pt_id'=>2, 
		'type'=>'major', 'color'=>$config['station_colors']->ylw),
	'2a' => (object) array('name'=>'E Kennet', /*'pt_id'=>21,*/ 
		'type'=>'minor', 'color'=>$config['station_colors']->orng_a),
	3 => (object) array('name'=>'Honey Street', 
		'type'=>'major', 'color'=>$config['station_colors']->orng),
	4 => (object) array('name'=>'Casterly Camp', 
		'type'=>'major', 'color'=>$config['station_colors']->ltblu),
	5 => (object) array('name'=>'Netheravon', 
		'type'=>'major', 'color'=>$config['station_colors']->pink),
	'5A' => (object) array('name'=>'Stonehenge', 
		'type'=>'monument', 'color'=>$config['station_colors']->purple),
	6 => (object) array('name'=>'Amesbury', 
		'type'=>'major', 'color'=>$config['station_colors']->purple),
	7 => (object) array('name'=>'Old Sarum', 
		'type'=>'major', 'color'=>$config['station_colors']->red),
	8 => (object) array('name'=>'Salisbury Rail Station', 
		'type'=>'minor', 'color'=>$config['station_colors']->brown),
);

$config['icon_types'] = array(
	'triangle' => 'direction',
	'shaded_dot' => 'interesting',
	'man' => 'streetview',
	'open-diamond' => 'milestone',
	'star' => 'terminal'
);

$config['style_types'] = array(
	'direction' => (object) array(
		'folder'=>'Directions', 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/shapes/triangle.png'
	  ),
	'interesting' => (object) array(
		'folder'=>'Interesting', 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/shapes/info-i.png'
	  ),
	'streetview' => (object) array(
		'folder'=>'Streetviews', 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/shapes/man.png'
	  ),
	'milestone' => (object) array(
		'folder'=>'Milestones', 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/shapes/open-diamond.png'
	  ),
	'cairn' => (object) array(
		'folder'=>FALSE, 
		'icon_href'=>FALSE
	  ),
	'terminal' => (object) array(
		'folder'=>'Milestones', 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/shapes/star.png'
	  ),
	'terminal_a' => (object) array(
		'folder'=>'Milestones', 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/shapes/star.png'
	  ),
	'terminal_z' => (object) array(
		'folder'=>'Milestones', 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/shapes/star.png'
	  ),
	'station_a' => (object) array(
		'folder'=>NULL, 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/paddle/wht-circle.png'
	  ),
	'station_i' => (object) array(
		'folder'=>NULL, 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/paddle/wht-blank.png'
	  ),
	'station_o' => (object) array(
		'folder'=>NULL, 
		'icon_href'=>'http://maps.google.com/mapfiles/kml/paddle/wht-stars.png'
	  )
);

/* End of file doctypes.php */
/* Location: ./application/config/doctypes.php */