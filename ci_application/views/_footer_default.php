<?php

function my_goog_map_js($kml_uri, $init_coords) {
	$googmaps_api_args = 'v=3.exp&amp;region=GB&amp;key=';
	$googmaps_api_args .= GOOGLE_API_KEY;
	$googmaps_api_uri = 'https://maps.googleapis.com/maps/api/js';
	$googmaps_api_uri .= "?$googmaps_api_args";

	$rtn = "<script src='$googmaps_api_uri'></script>";
	$rtn .= "<script>
	function init_kml_map() {
	  var map_html_id = document.getElementById('map-canvas');
	  var map_options = {
		zoom: 16,
		center: new google.maps.LatLng($init_coords),
		mapTypeId: google.maps.MapTypeId.HYBRID
	  };
	  var kml_options = {
		url: '$kml_uri', 
		suppressInfoWindows: false, 
		map: new google.maps.Map( map_html_id, map_options)
	  };
	  new google.maps.KmlLayer(kml_options);
	}

	$( document ).ready(init_kml_map())
	</script>";
	return $rtn;
}

?>
  <div class="container text-center" style='padding:15px;'>
  <!-- footer -->
  </div>

  <?php if (isset($debug)) { ?>
  <div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
		  <h2 id="point-panel-title" class="panel-title">Debug</h2>
		</div>
		<div id="point-panel-body" class="panel-body">
			<pre style='font-size:small;'><?=str_replace("\t",' ', print_r($debug,1));?></pre>
		</div>
	</div>
  </div>
  <?php } /* end if isset($debug) */ ?>

  <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">GSW<small style='font-size:x-small;'>&lt;</small>x<small style='font-size:x-small;'>ml&gt;</small><small>.info</small></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="https://github.com/millsd/gswx_data">Github Data</a></li>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- Bootstrap core JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="/bootstrap/js/ie10-viewport-bug-workaround.js"></script>

  <?=(isset($map_kml_uri) and isset($map_init_coords)) ?
		my_goog_map_js($map_kml_uri, $map_init_coords) : '';?>

  <?=isset($post_jquery) ? $post_jquery : '';?>

  </body>
</html>
