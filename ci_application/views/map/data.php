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

	<title>GSW.gpX.info</title>

	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/bootswatch.com_lumen.css" rel="stylesheet">
	<link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="/gsw.info.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

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
    url: "<?=site_url($public_data_path . '.kml?' . time());?>",
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

  </head>

  <body role="document" style='padding-top:60px;'>

<div class='container hero-unit'>
	<h1><?=$xml->Document->name;?> <small><?=$public_data_path;?></small></h1>
	<div id="map-canvas" style='width:90%; height:640px; border:dotted 5px #ccc;'></div>
</div>

<div class='container'>


		<div class="panel panel-primary" style='width:90%; margin-top:1em;'>
			<div class="panel-heading">
			  <h2 id="point-panel-title" class="panel-title">&nbsp;</h2>
			</div>
			<div id="point-panel-body" class="panel-body">
				<pre style='font-size:small;'><?=str_replace("\t",' ', print_r($debug,1));?></pre>
			</div>
		</div>

</div><!-- main container -->

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
            <li><a href="https://github.com/millsd/gswx/tree/master/data">Github Data</a></li>
		  </ul>
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href='/map/data/gsw_stage_2'>Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href='/map/data/gsw_stage_2' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href='/map/data/gsw_stage_2'>Action</a></li>
                <li><a href='/map/data/gsw_stage_2'>Another action</a></li>
                <li><a href='/map/data/gsw_stage_2'>Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href='/map/data/gsw_stage_2'>Separated link</a></li>
                <li><a href='/map/data/gsw_stage_2'>One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>
            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
          </ul> -->
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
