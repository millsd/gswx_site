<?php //
$this->load->view('kml/header.kml.php'); 
?>

<name><?=$doc->name;?></name>

<?php 
  foreach ($doc->stations as $st_id => $st_obj) {
	  $pt = $st_obj->db;
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
