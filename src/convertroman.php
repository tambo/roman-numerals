<?

/** 
 * The following Class and Interface have been developed as a solution to the
 * Developer Coding Kata v4 test set by the BBC Recruitment Team. The intent is 
 * to determine what approach and assumptions are used to build the solution
 * 
 * There are a variety of ways to repesent Roman Numerals, this class currently 
 * supports the more generally modern approach of using subtractive rather than
 * additive form, but could easily be adapted to support additive or both forms
 * instead.
 *
 * Tam Saunders 10/11/2013 - tam.saunders@gmail.com
 */

/**
 * Interface definition for Roman Numerals convertor.
 * This is the interface definition provided for the test.
 * It defines 2 public methods for converting to & from 
 * Roman numerals.
 */
interface RomanNumeralGenerator 
{
	public function generate($int); // convert from int -> roman
	public function parse($string); // convert from roman -> int
}

/**
 * This is the base class which forms the public API for the convertor
 * Call either of the public methods with an appropriate valid input to
 * convert to/from roman numerals
 * @example - 
 *
 * $myConvertor = new ConvertRoman();
 * echo $myConvertor->generate(2013);
 *
 *
 */
class ConvertRoman implements RomanNumeralGenerator
{
	// First we set up the constants common to the Class

	const MIN_INT = 1; // minimum integer to be converted
	const MAX_INT = 3999; // maximum integer to be converted

	// The map to use for conversions from integer
	public $integerMap = array(
						"1000" => "M",
						"900" => "CM",
						"500" => "D",
						"400" => "CD",
						"100" => "C",
						"90" => "XC",
						"50" => "L",
						"40" => "XL",
						"10" => "X",
						"9" => "IX",
						"5" => "V",
						"4" => "IV",
						"1" => "I"
						);

	public $numeralMap; // we can use php array_flip on $integerMap to create this map on the fly - less to maintain is good ;)

	public $errorMessages = array(
						0 => "You must provide a valid integer",
						1 => "You must input a number between 1 and 3999"
						);


	/**
	 * The generate function accepts an intger in the given range and returns 
	 * a string in Roman Numeral format
	 * @param integer $int The integer to be converted into numerals
	 * @return string The Roman numeral result of the conversion
	 */
	public function generate($int)
	{
		$result = '';
		// first we check that the revieved parameters are valid
		if($this->validateIntger($int))
		{
			foreach($this->integerMap as $units => $map)
			{
				$result .= $this->getNumerals($map, floor($int/$units));
				$int %= $units;
			}
		}
		else 
		{
			$result = $this->handleInputError($int);
		}	

		return $result;	
	}

	/**
	 * This is the stub method for the public parse method which will convert
	 * Roman Numerals into an integer
	 * @param string $str The string of Roman Numerals to convert
	 * @return int The integer value of the conversion
	 */
	public function parse($string)
	{
		$result = 0; // start with initial integer of 0
		$numerals = $string;
		// create the numeral map if not already done
		if(!$numeralMap)
		{
			$numeralMap = array_flip($this->integerMap);
		}

		/* iterate through the keys adding up the mapped values as we go
		 * and removing the matched string chunks
		 */
		foreach ($numeralMap as $units => $map) {
	    	while (strpos($numerals, $units) === 0) {
		        $result += $map;
		        $numerals = substr($numerals, strlen($units));
		    }
		}

		// Finally we validate againsst the min / max rules for the API
		if(!$this->validateIntger($result))
		{
			$result = $this->handleInputError($result);
		}	

		return $result;
	}

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
	 * Construct the string of numerals for the number of times
	 * required during the conversion. This is a simple secondary function 
	 * which helps keep things neat and tidy
	 * @param string $map The mapped numeral / character to use
	 * @param int $int The number of times to repear the character
	 * @return string The resultant string of characters 
	 */
	protected function getNumerals($map, $int)
	{
		$result = '';
		while($int--)
		{
			$result .= $map;
		}
		return $result;
	}

	/**
	 * The convertor must only accept integers within a valid range
	 * This method returns a boolean indicating if the intger parameter is valid
	 * @param integer $int The integer input
	 * @return Boolan The validity of the integer
	 */
	protected function validateIntger($int)
	{
		if(!$int || $int < self::MIN_INT || $int > self::MAX_INT)
		{
 			return false;
		} 
		else 
		{
			return true;
		}
	}

	/**
	 * The convertor should handle any errors with some degree of grace. 
	 * This method returns a short message describing the problem and provides 
	 * an opportunity for future development to override and implement proper
	 * exceptions / error handling if required.
	 * @param integer $int The integer input
	 * @return string The error message
	 */
	protected function handleInputError($int)
	{
		$msg = 'unknown error';

		if(!$int)
		{
			$msg = $this->errorMessages[0];
		}

		if($int < self::MIN_INT || $int > self::MAX_INT)
		{
			$msg = $this->errorMessages[1];
		} 

		//throw new Exception($msg);
		return $msg;
	}
}