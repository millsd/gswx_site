<?php //
$this->load->view('kml/header.kml.php'); 
?>

<name><?=$doc->name;?></name>


<?php
  $this->load->view('kml/styles.kml.php');

  foreach ($doc->stations as $st_id => $st_obj) {
?>
<Placemark <?=isset($st_obj->pt_id) ? "id='P$st_obj->pt_id'" : '';?>>
	<name><?=$st_obj->name;?></name>
  <?php if (isset($st_obj->description) and $st_obj->description) { ?>
	<description><![CDATA[<ins style='text-decoration:none !important; font-size:medium;'>
		<?=$st_obj->description;?>
	</ins>]]></description>
  <?php } /* end if $st_obj->description */ ?>
	<styleUrl>#<?=$st_obj->style;?></styleUrl>
	<Point><coordinates><?=$st_obj->lon;?>,<?=$st_obj->lat;?>,<?=$st_obj->ele;?></coordinates></Point>
	<!-- <styleUrl>#<?=$st_obj->style;?></styleUrl> -->
</Placemark>
<?php } /* end foreach $doc->stations */ ?>

<?php 
  foreach ($doc->paths as $path) {
	  if ( ! $path->coords) continue;
?>
<Placemark>
	<!-- <name><?=$path->name;?></name>
	<LineString><tessellate>1</tessellate>
		<coordinates><?=$path->coords;?></coordinates>
	</LineString>
	<styleUrl>#<?=$path->style;?></styleUrl> -->
		<name><?=$path->name;?></name>
		<styleUrl>#<?=$path->style;?></styleUrl>
		<LineString>
			<tessellate>1</tessellate>
			<coordinates><?=$path->coords;?></coordinates>
		</LineString>

</Placemark>
<?php } /* end foreach $doc->paths */ ?>

<?php if (isset($doc->folders)) { foreach ($doc->folders as $folder) { ?>
<Folder <?=isset($folder->id) ? "id='F$folder->id'" : '';?>>
	<name><?=$folder->name;?></name>
  <?php 
	foreach ($folder->points as $pt_id) { 
		if (isset($doc->points[$pt_id]) and $doc->points[$pt_id]) {
			$pt = $doc->points[$pt_id];
		} else {
			continue;
		}
  ?>
	<Placemark <?=isset($pt->id) ? "id='F$folder->id-P$pt->id'" : '';?>>
		<name><?=$pt->name;?></name>
	  <?php if (isset($pt->description) and $pt->description) { ?>
		<description><![CDATA[<ins style='text-decoration:none !important; font-size:medium;'>
			<?=$pt->description;?>
		</ins>]]></description>
	  <?php } /* end if $pt->description */ ?>
		<styleUrl>#<?=$pt->style;?></styleUrl>
		<Point><coordinates><?=$pt->lon;?>,<?=$pt->lat;?>,<?=$pt->ele;?></coordinates></Point>
	</Placemark>
	<?php } /* end foreach $folder->points */ ?>
</Folder>
<?php } } /* end if/foreach $doc->folders */ ?>

<?php $this->load->view('kml/footer.kml.php'); 
# end of file
