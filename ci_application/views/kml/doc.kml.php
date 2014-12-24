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

<Placemark>
	<name><?=$doc->name;?> Path</name>
	<LineString><tessellate>1</tessellate>
		<coordinates><?=$doc->path;?></coordinates>
	</LineString>
	<styleUrl>#path_<?=$doc->color->kml;?></styleUrl>
</Placemark>

<?php foreach ($doc->points as $pt) { ?>
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
<?php } /* end foreach $doc->points */ ?>

<?php foreach ($doc->folders as $folder) { ?>
<Folder <?=isset($folder->id) ? "id='$folder->id'" : '';?>>
	<name><?=$folder->name;?></name>
  <?php foreach ($folder->points as $pt) { ?>
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
