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

	<title>Document <?=$doc_id;?> - GSW<Xml>.info</title>

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

  <body role="document" style='padding-top:40px;'>

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
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h2 id="point-panel-title" class="panel-title">&nbsp;</h2>
				</div>
				<div id="point-panel-body" class="panel-body">
					<pre style='font-size:small;'><?=str_replace("\t",' ', print_r($debug,1));?></pre>
				</div>
			</div>
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
            <li><a href="https://github.com/millsd/gswx_data">Github Data</a></li>
		  </ul>
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

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;region=GB&amp;key=<?=GOOGLE_API_KEY;?>"></script>
    <script>

function initialize() {
  var myLatlng = new google.maps.LatLng(51.45,-1.85);
  var mapOptions = {
    zoom: 16,
    center: myLatlng,
	mapTypeId: google.maps.MapTypeId.HYBRID
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var kmlLayer = new google.maps.KmlLayer({
    url: "<?=site_url('/data/' . $new_file_name . '?' . time());?>",
    suppressInfoWindows: false,
    map: map
  });

  /*google.maps.event.addListener(kmlLayer, 'click', function(kmlEvent) {
    var text1 = kmlEvent.featureData.name;
    showInContentWindow(text1,'title');
    var text2 = kmlEvent.featureData.description;
    showInContentWindow(text2,'body');
  });

  function showInContentWindow(text,title_or_body) {
    var sidediv = document.getElementById('point-panel-'+title_or_body);
    sidediv.innerHTML = text;
  }*/
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

  </body>
</html>
