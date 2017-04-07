<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">

  h1 {
    color: #444;
    background-color: transparent;
    font-size: 150px;
    font-weight: bold;
    margin-bottom: -50px;
    font-family: Helvetica, Arial, sans-serif
  }
  
  h2{
    font-size: 24px !important
  }


  #page-not-found {
    text-align: center
  }

  p {
    margin: 12px 15px 12px 15px;
  }
</style>

	<div id="page-not-found">
		<h1>404</h1>
    <h2>Page not found</h2>
    <p>The page you are looking for doesn't exist or another error has occured. <a href="#" id="go-back">Go back</a> or <a href="<?php echo site_url('login'); ?>">Login</a> to choose a new direction</p>
	</div>


<script>
  $('#go-back').click(function(){
    window.history.back();
  });

</script>
