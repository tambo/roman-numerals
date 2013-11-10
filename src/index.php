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
  			echo $convertor->testGenerate(100, "C");
  			echo $convertor->testGenerate(200, "CC");
  			echo $convertor->testGenerate(500, "D");
  			echo $convertor->testGenerate(999, "CMXCIX");
  			echo $convertor->testGenerate(1000, "M");
  			echo $convertor->testGenerate(1066, "MLXVI");
  			echo $convertor->testGenerate(1967, "C");
  			echo $convertor->testGenerate(1999, "MCMXCIX");
  			echo $convertor->testGenerate(2013, "MMXIII");
  			echo $convertor->testGenerate(3999, "MMMCMXCIX");
  			echo $convertor->testGenerate(4000, "ERROR");
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