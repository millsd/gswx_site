<?php //$Id$

?><!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="icon" href="/favicon.ico"> -->

	<title>GSW<Xml>.info</title>

	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/bootswatch.com_lumen.css" rel="stylesheet">
	<link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="/gsw.info.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

  </head>

  <body role="document">

<div class='container'>
	<h1>
		<small>The</small>
		<strong>G</strong>reat <strong>S</strong>tones <strong>W</strong>ay<small>,
		Wiltshire&nbsp;England</small>
	</h1>

	<!-- <h3>Overton Hill to Honey Street</h3> -->
<div class='row'>

	<div class='col-xs-7' style='max-width:480px;'>
		<div id="map-canvas" style='width:100%; height:640px; border:dotted 5px #ccc;'></div>
	</div>
	<div class='col-xs-5'>
		<h3 style='margin-left:-1em;'>GSW Stages</h3>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_1' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/green-dot.png' alt='paddle' width='24'>
			Barbury Castle
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/yellow-dot.png' alt='paddle' width='24'>
			Avebury
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/yellow-dot.png' alt='paddle' width='24'>
			Overton Hill
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/orange-dot.png' alt='paddle' width='24'>
			Honey Street
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/kml/paddle/ltblu-circle.png' alt='paddle' width='24'>
			Casterly Camp
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/blue-dot.png' alt='paddle' width='24'>
			Netheravon
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/white-star.png' alt='paddle' width='24'>
			Stonehenge
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/white-dot.png' alt='paddle' width='24'>
			Amesbury
		</a></p>
		<p style='margin-left:-2em;'><a href='/map/data/gsw_stage_2' class='btn btn-link'>
			<img src='http://maps.google.com/mapfiles/ms/micons/red-dot.png' alt='paddle' width='24'>
			Old Sarum
		</a></p>
		<p style='margin-left:-2em;'><a href='/map' class='btn btn-link'>
			<span style='font-size:x-large;'>&bull;</span> All Stages
		</a></p>
	</div>
  </div>

</div><!-- main container -->

<div class='container clearfix' style='margin-top:1em;'>
	<ol class="breadcrumb">
	  <li>Want help navigating the <a href='http://greatstonesway.org.uk/' target='_blank'>Great Stones Way</a> from Avebury to Stonehenge?<br>
	  Customize your walk with GSWx<small>.info</small> and then download the route in GPX or KML format.</li>
	  <!-- <li><a href='/map/data/gsw_stage_2'>2013</a></li>
	  <li class="active">November</li> -->
	</ol>
</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="/bootstrap/js/ie10-viewport-bug-workaround.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;region=GB&amp;key=AIzaSyDGWN0xLnrmOAtV511Qn-pbkdNlg9T6WuU"></script>
    <script>

function initialize() {
  var myLatlng = new google.maps.LatLng(51.428526,-1.854265);
  var mapOptions = {
    zoom: 16,
    center: myLatlng,
	mapTypeId: google.maps.MapTypeId.HYBRID
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var kmlLayer = new google.maps.KmlLayer({
    //url: "<?=site_url('data/the_avenue.kml?'.time());?>",
    //url: "<?=site_url('data/anon/stg2.kml?'.time());?>",
    //url: "<?=site_url('data/gsw_stage_points_also.kml?'.time());?>",
    //url: "<?=site_url('data/anon/gswx141676416010.kml?'.time());?>",
    //url: "<?=site_url('data/gsw_stage_2.kml?'.time());?>",
    url: "<?=site_url('data/great_stones_way_skinny.kml?'.time());?>",
    suppressInfoWindows: false,
    map: map
  });

  google.maps.event.addListener(kmlLayer, 'click', function(kmlEvent) {
    var text1 = kmlEvent.featureData.name;
    showInContentWindow(text1,'title');
    var text2 = kmlEvent.featureData.description;
    showInContentWindow(text2,'body');
  });

  function showInContentWindow(text,title_or_body) {
    var sidediv = document.getElementById('point-panel-'+title_or_body);
    sidediv.innerHTML = text;
  }
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  
  </body>
</html>
