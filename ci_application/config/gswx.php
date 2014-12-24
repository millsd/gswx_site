<?php
/**
 * Config for folder types
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*$config['station_colors'] = (object) array(
	'gray' => (object) array('kml'=>'eeff5959', 'html'=>'5959ff'),
	'grn' => (object) array('kml'=>'503CFA14', 'html'=>'14FA3C', 'rgb'=>'60,250,20'),
	'ylw' => (object) array('kml'=>'ee00ffff', 'html'=>'ffff00'),
	'ylw_a' => (object) array('kml'=>'ee66ffff', 'html'=>'ffff66'),
	'orng' => (object) array('kml'=>'ee0099ff', 'html'=>'ff9900'),
	'orng_a' => (object) array('kml'=>'ee6699ff', 'html'=>'ff9966'),
	'ltblu' => (object) array('kml'=>'eeffff00', 'html'=>'00ffff'),
	'pink' => (object) array('kml'=>'eeff50ff', 'html'=>'ff50ff'),
	'purple' => (object) array('kml'=>'eeff0080', 'html'=>'8000ff'),
	'red' => (object) array('kml'=>'501400FF', 'html'=>'FF0014', 'rgb'=>'20,0,255'),
	'brown' => (object) array('kml'=>'50143C8C', 'html'=>'8C3C14', 'rgb'=>'20,60,140')
);*/
$config['station_colors'] = (object) array(
	'gray' => (object) array('kml'=>'dda19b96', 'html'=>'969ba1'),
	'grn' => (object) array('kml'=>'dd3e8401', 'html'=>'01843e'),
	'ylw' => (object) array('kml'=>'dd03d2ff', 'html'=>'ffd203'),
	'ylw_a' => (object) array('kml'=>'dd34b1fb', 'html'=>'fbb134'),
	'orng' => (object) array('kml'=>'dd0099ff', 'html'=>'ff9900'),
	'orng_a' => (object) array('kml'=>'dd232cf1', 'html'=>'f12c23'),
	'ltblu' => (object) array('kml'=>'ddbbce85', 'html'=>'85cebb'),
	'pink' => (object) array('kml'=>'ddb6a2ff', 'html'=>'ff5a2b6'),
	'purple' => (object) array('kml'=>'dd5f0196', 'html'=>'96015f'),
	'red' => (object) array('kml'=>'dd1025f2', 'html'=>'f22510'),
	'brown' => (object) array('kml'=>'dd0f60b1', 'html'=>'b1600f')
);

/*
brown : b1600f dd0f60b1
lt_red : f12c23 dd232cf1
yellow : ffd203 dd03d2ff
green : 01843e dd3e8401
tan : fbb134 dd34b1fb
pink : ff5a2b6 ddb6a2ff
steel : 969ba1 dda19b96
purple : 96015f dd5f0196
dk_blue : 1b3f95 dd953f1b
med_blue : 009edd dddd9e00
lt_blue : 85cebb ddbbce85
alt_blue : 02b0af ddafb002
red : f22510 dd1025f2
*/

$config['stations'] = array(
	0 => (object) array('name'=>'Swindon Rail Station', 
		'type'=>'minor', 'color'=>$config['station_colors']->gray),
	1 => (object) array('name'=>'Barbury Castle', 'pt_id'=>1, 
		'type'=>'major', 'color'=>$config['station_colors']->grn),
	'1a' => (object) array('name'=>'Herepath', 'pt_id'=>11,
		'type'=>'minor', 'color'=>$config['station_colors']->ylw),
	'1B' => (object) array('name'=>'Avebury', 'pt_id'=>12, 
		'type'=>'monument', 'color'=>$config['station_colors']->ylw),
	2 => (object) array('name'=>'Overton Hill', 'pt_id'=>2, 
		'type'=>'major', 'color'=>$config['station_colors']->ylw),
	'2a' => (object) array('name'=>'E Kennet', /*'pt_id'=>21,*/ 
		'type'=>'minor', 'color'=>$config['station_colors']->orng_a),
	3 => (object) array('name'=>'Honey Street', 'pt_id'=>3, 
		'type'=>'major', 'color'=>$config['station_colors']->orng),
	4 => (object) array('name'=>'Casterly Camp', 'pt_id'=>4, 
		'type'=>'major', 'color'=>$config['station_colors']->ltblu),
	5 => (object) array('name'=>'Netheravon', 'pt_id'=>5, 
		'type'=>'major', 'color'=>$config['station_colors']->pink),
	'5A' => (object) array('name'=>'Stonehenge', 'pt_id'=>51,
		'type'=>'monument', 'color'=>$config['station_colors']->purple),
	6 => (object) array('name'=>'Amesbury', 'pt_id'=>6,
		'type'=>'major', 'color'=>$config['station_colors']->purple),
	7 => (object) array('name'=>'Old Sarum', 'pt_id'=>7,
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
	'default' => (object) array(
		'folder'=>FALSE, 
		'icon_href'=>FALSE
	  ),
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

/* End of file  */
