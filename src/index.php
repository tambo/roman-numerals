<?php
 require_once("convertroman.php");

 $convertor = new ConvertRoman();

 // Start output buffer
ob_start();

?>
<html>
  <head></head>
  <body>
  	<?php

  		try
  		{
  			echo $convertor->generate(100);
  		} 
  		catch(Exception $e) 
  		{
  			echo "Error " . $e;
  		}

  	?>

    </body>
</html>

<?php
ob_flush();
ob_end_clean();
?>