<?php
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

?><kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">

<Document <?=isset($doc->id) ? "id='D$doc->id'" : '';?>><!-- Generated by gswx.info at <?=gmdate('Y-m-d H:i:s');?> GMT -->
