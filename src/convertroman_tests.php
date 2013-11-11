<?php

require_once('convertroman.php');

/** 
 * The ConvertRoman_Tests Class extends the ConvertRoman class adding some basic
 * unit Tests and provides a testConvertorAll() method for extended testing of the convertor.
 *
 * Tam Saunders 10/11/2013 - tam.saunders@gmail.com
 */
class ConvertRoman_Tests extends ConvertRoman
{

	/** 
	 * This is simple unit test function to allow for basic TDD without 
	 * many dependencies on other libs / src etc.
	 * @param Integer $int The integer to be converted into numerals
	 * @param String $expectedResult - The expected sequence of Numerals
	 * @return string The test result report
	 */
	public function testGenerate($int, $expectedResult)
	{
		$result = $this->generate($int);
		$testResult = ($result == $expectedResult) ? "PASSED" : "FAILED";
		return ('<div class="' . strtolower($testResult) . '">' . $testResult . ': ' . $int . ' = ' . $result . '</div>');
	}

	/** 
	 * This is simple unit test function to allow for basic TDD without 
	 * many dependencies on other libs / src etc.
	 * @param nteger $int The integer to be converted into numerals
	 * @param String $expectedResult - The expected integer value
	 * @return string The test result report
	 */
	public function testParse($expectedResult, $string)
	{
		$result = $this->parse($string);
		$testResult = ($result == $expectedResult) ? "PASSED" : "FAILED";
		return ('<div class="' . strtolower($testResult) . '">' . $testResult . ': ' . $string . ' = ' . $result . '</div>');
	}
	

	/** 
	 * This is a test function to check the complete output of the convertor against 
	 * itself. This should highlight any problems
	 * @return string The test result report
	 */
	public function testConvertorAll()
	{
		$result = 'The results of a complete comparison of generator and parser are as follows : <br />';
		// first we generate the table of integer mappings from the convertor
		$integerTable = array();
		$parseTable = array();
		for($i = self::MIN_INT; $i <= self::MAX_INT; $i++)
		{
			$generateTable[$i] = $this->generate($i);
			$parseTable[$generateTable[$i]] =  $this->parse($generateTable[$i]);
		}

		for($i = self::MIN_INT; $i <= self::MAX_INT; $i++)
		{
			// flip the parsed array to perform the compare
			$parsedFlip = array_flip($parseTable);
			$testResult = ($generateTable[$i] == $parsedFlip[$i]) ? "PASSED" : "FAILED";
			$result .= '<div class="' . strtolower($testResult) . '">' . $testResult . ': ' . $i . ' = ' . $generateTable[$i] . ' = ' . $parsedFlip[$i] . '</div>';
		}

		return $result;
				
	}

}

?>


	