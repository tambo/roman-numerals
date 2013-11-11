<?php

require_once("convertroman_tests.php");


$convertorTest = new ConvertRoman_Tests();

 // Start output buffer
ob_start();

?>
<html>
  	<head>
  		<title>Roman Numerals - Convertor - Test All conversions</title>
  		<link rel="stylesheet" href="style.css">
  	</head>
  	<body>
	  	<div class="main">
	  		<div class="intro">
	  			<h3>Roman Numeral Convertor - Test Convertor complete</h3>
	  			<p>This following table shows a complete generate and parse comparison of all allowed values for the convertor, ie: the range 1 to 3999.</p>
		  	<div class="testHarness">
		  		<div class="interface">
				  	<div class="unitTest">
				  		<?= $convertorTest->testConvertorAll(); ?>
				  	</div>
				</div>
			</div>
	  	</div>
    </body>
</html>
<?php
ob_flush();
ob_end_clean();
?>
