<?php

require_once("convertroman.php");
require_once("convertroman_tests.php");

$convertor = new ConvertRoman();

$convertorTest = new ConvertRoman_Tests();

// set the default in/out vars for handling integer conversion requests
$input_integer = '';
$output_numerals = '&nbsp;';

// handle integer conversion requests
if(isset($_POST['input_integer']))
{
	$input_integer = $_POST['input_integer'];
	$output_numerals = "Result = " . $convertor->generate($_POST['input_integer']);
}

// set the default in/out vars for handling numeral conversion requests
$input_numerals = '';
$output_integer = '&nbsp;';

// handle numeral conversion requests
if(isset($_POST['input_numerals']))
{
	$input_numerals = $_POST['input_numerals'];
	$output_integer = "Result = " . $convertor->parse($_POST['input_numerals']);
}

 // Start output buffer
ob_start();

?>
<html>
  	<head>
  		<title>Roman Numerals - Convertor</title>
  		<link rel="stylesheet" href="style.css">
  	</head>
  	<body>
	  	<div class="main">
	  		<div class="intro">
	  			<h3>Roman Numeral Convertor</h3>
	  			<form action="test_convertor.php" target="testAll">
	  			<p>This interface lets you convert to and from Roman Numerals in the range 1 to 3999. Click here to see a complete test of the generator <button type="submit">Complete Test</button></p>
		  		</form>
		  	<div class="testHarness">
		  		<div class="interface">
			  		<h3>Try the Roman Numeral Generator</h3>
			  		<p>Enter an intger from 1 to 3999 to test any valid number against the Roman numeral generator</p>
			  		<form method="POST" >
			  			<label for="input_integer">
			  			<input type="number" name="input_integer" id="input_integer" value=<?= $input_integer ?>>
			  			<input type="submit" value="Submit">
			  		</form>
				  	<div class="result"><?= $output_numerals ?></div>
			  	</div>

			  	<div>
				  	<h3>Generator - unit tests:</h3>
				  	<div class="unitTest">
				  		<p>The following are a series of unit test ran against the generate method</p>
					  	<?php

					  		try
					  		{
					  			// test conversion to Roman numerals
					  			echo $convertorTest->testGenerate(4, "IV");
					  			echo $convertorTest->testGenerate(9, "IX");
					  			echo $convertorTest->testGenerate(25, "XXV");
					  			echo $convertorTest->testGenerate(49, "XLIX");
					  			echo $convertorTest->testGenerate(50, "L");
					  			echo $convertorTest->testGenerate(100, "C");
					  			echo $convertorTest->testGenerate(200, "CC");
					  			echo $convertorTest->testGenerate(500, "D");
					  			echo $convertorTest->testGenerate(999, "CMXCIX");
					  			echo $convertorTest->testGenerate(1000, "M");
					  			echo $convertorTest->testGenerate(1066, "MLXVI");
					  			echo $convertorTest->testGenerate(1967, "MCMLXVII");
					  			echo $convertorTest->testGenerate(1975, "MCMLXXV");
					  			echo $convertorTest->testGenerate(1999, "MCMXCIX");
					  			echo $convertorTest->testGenerate(2013, "MMXIII");
					  			echo $convertorTest->testGenerate(3999, "MMMCMXCIX");
					  			echo $convertorTest->testGenerate(4000, "MMMM");
					  		} 
					  		catch(Exception $e) 
					  		{
					  			echo "Error " . $e;
					  		}

					  		?>
					  	</div>
					</div>
				</div>
			<div class="testHarness">
				<div class="interface">
			  		<h3>Try the Roman Numeral Parser</h3>
			  		<p>Enter a roman numeral string to test against the Roman numeral parser <br /><br /></p>
				  		<form method="POST" >
				  			<label for="input_numerals">
				  			<input type="text" name="input_numerals" id="input_numerals" value=<?= $input_numerals ?>>
				  			<input type="submit" value="Submit">
				  		</form>
				  	<div class="result"><?= $output_integer ?></div>
			  	</div>
				<div>
					<h3>Parser - unit tests:</h3>
				  	<div class="unitTest">
						<p>The following are a series of unit test ran against the parse method</p>
						<?php

							try
					  		{
					  			// test conversion from Roman numerals
					  			echo $convertorTest->testParse(4, "IV");
					  			echo $convertorTest->testParse(9, "IX");
					  			echo $convertorTest->testParse(25, "XXV");
					  			echo $convertorTest->testParse(49, "XLIX");
					  			echo $convertorTest->testParse(50, "L");
					  			echo $convertorTest->testParse(100, "C");
					  			echo $convertorTest->testParse(200, "CC");
					  			echo $convertorTest->testParse(500, "D");
					  			echo $convertorTest->testParse(999, "CMXCIX");
					  			echo $convertorTest->testParse(1000, "M");
					  			echo $convertorTest->testParse(1066, "MLXVI");
					  			echo $convertorTest->testParse(1967, "MCMLXVII");
					  			echo $convertorTest->testParse(1975, "MCMLXXV");
					  			echo $convertorTest->testParse(1999, "MCMXCIX");
					  			echo $convertorTest->testParse(2013, "MMXIII");
					  			echo $convertorTest->testParse(3999, "MMMCMXCIX");
					  			echo $convertorTest->testParse(4000, "MMMM");
					  		} 
					  		catch(Exception $e) 
					  		{
					  			echo "Error " . $e;
					  		}

				  		?>
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
