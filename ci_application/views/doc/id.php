<?php //$Id$
$html_title = 'title';
$this->load->view('_header_default', compact('html_title'));
?>

<div class='container hero-unit'>
	<h1><?=$doc->name;?> <small><?=$doc->description;?></small></h1>
</div>
<div class='container'>
	<div class='row'>
		<div class='col-xs-10 col-sm-9 col-md-7' style='padding-right:0;margin-right:0;'>
			<div id="map-canvas" style='width:100%; height:<?=$this->agent->is_mobile() ? '550px' : '900px';?>; border:dotted 5px #ccc;'></div>
		</div>
		<div class='col-xs-2' style='padding-left:2px;margin-left:0;'>
			<button type="button" class="btn btn-default btn-sm" style='width:3.5em;'>
				Key</button>
			<button type="button" class="btn btn-default btn-sm" style='width:3.5em;'>
				<span class="glyphicon glyphicon glyphicon-fullscreen"></span></button>
		</div>
		<div class='col-xs-12 col-sm-2 col-md-5' <?=$this->agent->is_mobile() ? '' : 'style="padding-left:2px;margin-left:0;"';?>>
		  <?php if (isset($debug)) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h2 id="point-panel-title" class="panel-title">&nbsp;</h2>
				</div>
				<div id="point-panel-body" class="panel-body">
					<pre style='font-size:small;'><?=str_replace("\t",' ', print_r($debug,1));?></pre>
				</div>
			</div>
		  <?php } /* end if isset($debug) */ ?>
		</div>
	</div>
</div><!-- main container -->

<?php // Google maps with KML layer
$launch_spot = '51.1788585667832300,-1.826179434582305';

$googmaps_api_args = 'v=3.exp&amp;region=GB&amp;key=';
$googmaps_api_args .= GOOGLE_API_KEY;
$googmaps_api_uri = 'https://maps.googleapis.com/maps/api/js';
$googmaps_api_uri .= "?$googmaps_api_args";
$gswx_kml_uri = site_url('data/' . $new_file_name . '?' . time());

$post_jquery = "<script src='$googmaps_api_uri'></script>";
$post_jquery .= "<script>
function init_kml_map() {
  var map_html_id = document.getElementById('map-canvas');
  var map_options = {
    zoom: 16,
    center: new google.maps.LatLng($launch_spot),
    mapTypeId: google.maps.MapTypeId.HYBRID
  };
  var kml_options = {
    url: '$gswx_kml_uri', 
    suppressInfoWindows: false, 
    map: new google.maps.Map( map_html_id, map_options)
  };
  new google.maps.KmlLayer(kml_options);
}

$( document ).ready(init_kml_map())
</script>";

$this->load->view('_footer_default', compact('post_jquery'));
