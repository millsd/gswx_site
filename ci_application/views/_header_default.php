<?php //$Id$
$gsw_h1_find = 'The Great Stones Way';
$gsw_h1_repl = '<small>The</small> <strong>G</strong>reat <strong>S</strong>tones <strong>W</strong>ay';

?><!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="icon" href="/favicon.ico"> -->

	<title><?=$html_title;?> - GSW<Xml>.info</title>

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

  <?php if (isset($h1)) { ?>
	<div class='container hero-unit'><h1>
		<?=str_replace($gsw_h1_find, $gsw_h1_repl, $h1); ?><?=isset($h1_sm) ? "<small>, $h1_sm</small>" : ''; ?>
	</h1></div>
  <?php } /* end if $h1 */ ?>