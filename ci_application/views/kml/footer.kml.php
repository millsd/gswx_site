<!-- styles -->
<?php if (isset($doc->styles) and $doc->styles) {
	foreach ($doc->styles as $st_id => $st_obj) { ?>
<Style id='<?=$st_id;?>'>
  <?php if ($st_obj->class == 'path') { ?>
	<LineStyle><color><?=$st_obj->color;?></color><width>2</width></LineStyle>
  <?php 
	} /* end if $st_obj->class == 'path' */
	if ($st_obj->icon_href) { ?>
	<IconStyle><color><?=$st_obj->color;?></color><scale>1.0</scale><Icon><href><?=$st_obj->icon_href;?></href></Icon></IconStyle>
  <?php 
	} /* end if $st_obj->icon_href */
	if ($st_obj->color) {
  ?>
	<LabelStyle><color><?=$st_obj->color;?></color></LabelStyle>
  <?php } /* end if $st_obj->color */ ?>
</Style>
  <?php }  /* end foreach $doc-styles */
} /* end if $doc-styles */ ?>
<!-- /styles -->
</Document>
</kml>
