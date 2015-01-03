<?php //$Id$
$html_title = 'Home';
$h1 = $doc->name;
$h1_sm = $doc->description;

$this->load->view('_header_default', compact('html_title', 'h1', 'h1_sm'));
?>

<div class='container'>
	<div class='row'>
		<div class='col-xs-7' style='max-width:480px;'>
			<div id="map-canvas" style='width:100%; height:<?=$this->agent->is_mobile() ? '550px' : '800px';?>; border:dotted 5px #ccc;'></div>
		</div>
	<div class='col-xs-5'>
			  <ul class="nav nav-pills nav-stacked" style='margin-left:-1.5em;'>
<li role="presentation">
				  <a style='border:dotted 2px #fff; padding:5px 0 4px 12px !important;'>
					<strong>&#187; Stations</strong>
				  </a>
				</li>
		  <?php foreach ($doc->stations as $stn_id => $stn_obj) { ?>
				<li role="presentation">
				  <a href="/station/<?=$stn_id;?>" style='border:dotted 2px #<?=$stn_obj->color->html;?>; padding:5px 0 4px 2px !important;'>
					<span style='background-color:#<?=$stn_obj->color->html;?>;'><img src='<?=$doc->styles["$stn_obj->style"]->icon_href;?>' alt='paddle' width='24'></span>
					<?=str_replace(' ', '&nbsp;', $stn_obj->name);?>
				  </a>
				</li>
		  <?php } /* end foreach $doc->stations */ ?>
			  </ul>
	</div>
</div><!-- main container -->

<?php // Google maps with KML layer
$map_init_coords = '51.1788585667832300,-1.826179434582305';
$map_kml_uri = site_url('data/' . $new_file_name);
$footer_args = compact('map_init_coords', 'map_kml_uri', 'post_jquery');
$this->load->view('_footer_default', $footer_args);
