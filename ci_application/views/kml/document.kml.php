<?php //
$this->load->view('kml/header.kml.php'); 
?>
	<name><?=$doc_name;?></name>
  <?php foreach ($folders as $fldr) { ?>
	<Folder>
		<name><?=$fldr->name;?></name>
	  <?php
		$type = (strpos($fldr->name, 'Mile-Marks')) ? 'rte' : 'wpt';
		$coords = array();
		foreach ($fldr->points as $pt) {
			if ($type == 'rte') {
				$coords[] = "$pt->lon,$pt->lat,$pt->ele";
			  ?>
		  <Placemark id='<?=uniqid();?>'>
			<name><?=$pt->name;?></name>
			<description><![CDATA[<!-- <ins style='text-decoration:none !important; font-size:medium;'>
				<dl>
					<dt style='display:inline;'>Lon</dt><dd style='display:inline;'><?=$pt->lon;?><br></dd>
					<dt style='display:inline;'>Lat</dt><dd style='display:inline;'><?=$pt->lat;?><br></dd>
				</dl>
			</ins> -->]]></description>
			<Point><coordinates><?=$pt->lon;?>,<?=$pt->lat;?>,<?=$pt->ele;?></coordinates></Point>
			<styleUrl>#mile_stone</styleUrl>
		  </Placemark>
			  <?php } else {
				$coord = "$pt->lon,$pt->lat,$pt->ele";
		  ?>
			<Placemark>
				<name><?=$pt->name;?></name>
				<Point><coordinates><?=$coord;?></coordinates></Point>
				<styleUrl>#paddle_lg_orange</styleUrl>
			</Placemark>
		<?php
			}
		}
		if ($coords) {
		  ?>
			<Placemark>
				<name>Path</name>
				<LineString><tessellate>1</tessellate>
					<coordinates><?=implode(' ', $coords);?></coordinates>
				</LineString>
				<styleUrl>#line_orange</styleUrl>
			</Placemark>
		<?php
		}
	  ?>
	</Folder>
  <?php } /* end foreach $folders*/ ?>

<?php $this->load->view('kml/footer.kml.php'); 
# end of file
