<!-- styles -->
<?php if (isset($doc->styles) and $doc->styles) {
	foreach ($doc->styles as $st_id => $st_obj) {
		if ($st_obj->class == 'path') {
?>
	<Style id="<?=$st_id;?>">
		<LineStyle>
			<color>af<?=substr($st_obj->color, 2);?></color>
			<width>3</width>
		</LineStyle>
	</Style>
<?php
		} /* end if $st_obj->class == 'path' */
		if ($st_obj->icon_href) {
?>
	<StyleMap id="<?=$st_id;?>">
		<Pair><key>normal</key><styleUrl>#<?=$st_id;?>_normal</styleUrl></Pair>
		<Pair><key>highlight</key><styleUrl>#<?=$st_id;?>_highlight</styleUrl></Pair>
	</StyleMap>
	<Style id="<?=$st_id;?>_normal">
		<IconStyle><color><?=$st_obj->color;?></color><scale>1.0</scale>
			<Icon><href><?=$st_obj->icon_href;?></href></Icon>
			<hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
		</IconStyle>
		<LabelStyle><color><?=$st_obj->color;?></color></LabelStyle>
	</Style>
	<Style id="<?=$st_id;?>_highlight">
		<IconStyle><color><?=$st_obj->color;?></color><scale>1.2</scale>
			<Icon><href><?=$st_obj->icon_href;?></href></Icon>
			<hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
		</IconStyle>
		<LabelStyle><color><?=$st_obj->color;?></color></LabelStyle>
	</Style>
<?php
		} /* end if $st_obj->icon_href */
	} /* end foreach $doc-styles */
} /* end if $doc-styles */ ?>
<!-- /styles -->
