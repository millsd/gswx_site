<?php //
$this->load->view('kml/header.kml.php'); 
?>

<name><?=$doc->name;?></name>

<?php 
  foreach ($doc->stations as $st_id => $st_obj) {
?>
<Placemark <?=isset($st_obj->pt_id) ? "id='$st_obj->pt_id'" : '';?>>
	<name><?=$st_obj->name;?></name>
  <?php if (isset($st_obj->description) and $st_obj->description) { ?>
	<description><![CDATA[<ins style='text-decoration:none !important; font-size:medium;'>
		<?=$st_obj->description;?>
	</ins>]]></description>
  <?php } /* end if $st_obj->description */ ?>
	<Point><coordinates><?=$st_obj->lon;?>,<?=$st_obj->lat;?>,<?=$st_obj->ele;?></coordinates></Point>
	<styleUrl>#<?=$st_obj->style;?></styleUrl>
</Placemark>
<?php } /* end foreach $doc->stations */ ?>

<?php foreach ($doc->paths as $path) { ?>
<Placemark>
	<name><?=$path->name;?></name>
	<LineString><tessellate>1</tessellate>
		<coordinates><?=$path->coords;?></coordinates>
	</LineString>
	<styleUrl>#<?=$path->style;?></styleUrl>
</Placemark>
<?php } /* end foreach $doc->paths */ ?>

<?php foreach ($doc->folders as $folder) { ?>
<Folder <?=isset($folder->id) ? "id='$folder->id'" : '';?>>
	<name><?=$folder->name;?></name>
  <?php 
	foreach ($folder->points as $pt_id) { 
		$pt = $doc->points[$pt_id];
		if ( ! $pt) continue;
  ?>
	<Placemark <?=isset($pt->id) ? "id='$pt->id'" : '';?>>
		<name><?=$pt->name;?></name>
	  <?php if (isset($pt->description) and $pt->description) { ?>
		<description><![CDATA[<ins style='text-decoration:none !important; font-size:medium;'>
			<?=$pt->description;?>
		</ins>]]></description>
	  <?php } /* end if $pt->description */ ?>
		<Point><coordinates><?=$pt->lon;?>,<?=$pt->lat;?>,<?=$pt->ele;?></coordinates></Point>
		<styleUrl>#<?=$pt->style;?></styleUrl>
	</Placemark>
	<?php } /* end foreach $folder->points */ ?>
</Folder>
<?php } /* end foreach $doc->folders */ ?>

<?php $this->load->view('kml/footer.kml.php'); 
# end of file
