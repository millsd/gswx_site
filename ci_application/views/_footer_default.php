<?php //$Id$ ?>

  <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">GSW<small style='font-size:x-small;'>&lt;</small>x<small style='font-size:x-small;'>ml&gt;</small><small>.info</small></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="https://github.com/millsd/gswx_data">Github Data</a></li>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- Bootstrap core JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="/bootstrap/js/ie10-viewport-bug-workaround.js"></script>

  <?=isset($post_jquery) ? $post_jquery : '';?>

  </body>
</html>
