<?php
 require_once("convertroman.php");

 $convertor = new ConvertRoman();

$input_integer = '';
$output_numerals = '&nbsp;';
if(isset($_POST['input_integer']))
{
	$input_integer = $_POST['input_integer'];
	$output_numerals = "Result = " . $convertor->generate($_POST['input_integer']);
}

$input_numerals = '';
$output_integer = '&nbsp;';
if(isset($_POST['input_numerals']))
{
	$input_integer = $_POST['input_numerals'];
	$output_integer = "Result = " . $convertor->parse($_POST['input_numerals']);
}

 // Start output buffer
ob_start();

?>
<html>
  	<head>
  		<link rel="stylesheet" href="style.css">
  	</head>
  	<body>
	  	<div class="main">
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
				  	<h3>Generate Unit tests:</h3>
				  	<div class="unitTest">
				  		<p>The following are a series of unit test ran against the generate method</p>
					  	<?php

					  		try
					  		{
					  			// test conversion to Roman numerals
					  			echo $convertor->testGenerate(4, "IV");
					  			echo $convertor->testGenerate(9, "IX");
					  			echo $convertor->testGenerate(25, "XXV");
					  			echo $convertor->testGenerate(49, "XLIX");
					  			echo $convertor->testGenerate(50, "L");
					  			echo $convertor->testGenerate(100, "C");
					  			echo $convertor->testGenerate(200, "CC");
					  			echo $convertor->testGenerate(500, "D");
					  			echo $convertor->testGenerate(999, "CMXCIX");
					  			echo $convertor->testGenerate(1000, "M");
					  			echo $convertor->testGenerate(1066, "MLXVI");
					  			echo $convertor->testGenerate(1967, "MCMLXVII");
					  			echo $convertor->testGenerate(1975, "MCMLXXV");
					  			echo $convertor->testGenerate(1999, "MCMXCIX");
					  			echo $convertor->testGenerate(2013, "MMXIII");
					  			echo $convertor->testGenerate(3999, "MMMCMXCIX");
					  			echo $convertor->testGenerate(4000, "MMMM");
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
					<h3>Parse tests:</h3>
				  	<div class="unitTest">
						<p>The following are a series of unit test ran against the parse method</p>
						<?php
				  			// test conversion from Roman numerals
				  			echo $convertor->testParse(4, "IV");
				  			echo $convertor->testParse(9, "IX");
				  			echo $convertor->testParse(25, "XXV");
				  			echo $convertor->testParse(49, "XLIX");
				  			echo $convertor->testParse(50, "L");
				  			echo $convertor->testParse(100, "C");
				  			echo $convertor->testParse(200, "CC");
				  			echo $convertor->testParse(500, "D");
				  			echo $convertor->testParse(999, "CMXCIX");
				  			echo $convertor->testParse(1000, "M");
				  			echo $convertor->testParse(1066, "MLXVI");
				  			echo $convertor->testParse(1967, "MCMLXVII");
				  			echo $convertor->testParse(1975, "MCMLXXV");
				  			echo $convertor->testParse(1999, "MCMXCIX");
				  			echo $convertor->testParse(2013, "MMXIII");
				  			echo $convertor->testParse(3999, "MMMCMXCIX");
				  			echo $convertor->testParse(4000, "MMMM");
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