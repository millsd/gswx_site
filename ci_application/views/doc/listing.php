<?php
$html_title = 'GSWX Documents';
$h1 = $html_title;
$this->load->view('_header_default', compact('html_title', 'h1'));
?>

<div class="container">
<table class="table table-striped table-hover">
  <thead>
	<tr>
		<th>ID</th>
		<th>Document Name</th>
		<th>Description</th>
	</tr>
  </thead>
  <tbody>
<?php foreach ($docs as $doc_id => $doc_obj) { ?>
	<tr>
		<td><?=$doc_id;?></td>
		<td><a href='/doc/<?=$doc_id;?>'><?=$doc_obj->name;?></a></td>
		<td><?=$doc_obj->description;?></td>
	</tr>
<?php } /* end foreach $docs */ ?>
  </tbody>
</table>
</div>
<?php
$this->load->view('_footer_default', compact('post_jquery'));
