<?

/** 
 * The following Class and Interface have been developed as a solution to the
 * Developer Coding Kata v4 test set by the BBC Recruitment Team. The intent is 
 * to determine what approach and assumptions are used to build the solution
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
 * @example  - TBC
 *
 */
class ConvertRoman implements RomanNumeralGenerator
{
	// First we set up the constants common to the Class

	const MIN_INT = 1; // minimum integer to be converted
	const MAX_INT = 3999; // maximum integer to be converted

	// The map to use for conversions
	public $maps = array(
						"1000" => "M",
						"500" => "D",
						"100" => "C",
						"50" => "L",
						"10" => "X",
						"5" => "V",
						"1" => "I"
						);

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
		// first we check that the revieved parameters are valid
		if($this->validateIntger($int))
		{
			//$result = 'PASSED!' . $int; // start with initial string
			$result = $this->convertFromInteger($int);
			return $result;
		}
		else 
		{
			$this->handleInputError($int);
		}		
	}

	/**
	 * This is the stub method for the public parse method which will convert
	 * Roman Numerals into an integer
	 * TODO: Still to commence work on this method
	 * @param string $str The string of Roman Numerals to convert
	 * @return int The integer value of the conversion
	 */
	public function parse($string)
	{
		$result = 0; // start with initial integer of 0
	}

	/** 
	 * This is simple unit test function to allow for simple TDD without 
	 * many dependencies on other libs / src etc.
	 */
	public function testGenerate($int, $expectedResult)
	{
		$result = $this->generate($int);
		$testResult = ($result == $expectedResult) ? "PASSED" : "FAILED";
		return ($testResult . ': ' . $int . ' = ' . $result . '<br/>');
	}

	/**
	 * This is the actual conversion method that the generate function
	 * uses to produce a returned value. This allows the core method to 
	 * be maintained while allowing public generate method to be exposed
	 * and have whatever specific validations etc incorporated.
	 * required during the conversion
	 * @param integer $int The integer to be converted into numerals
	 * @return string The Roman numeral result of the conversion
	 */
	protected function convertFromInteger($int)
	{
		$result = ''; // we will store the returned results here
		foreach($this->maps as $units => $map)
		{
			$result .= $this->getNumerals($map, floor($int/$units));
			$int %= $units;
		}
		return $result;
	}

	/**
	 * Construct the string of numerals for the number of times
	 * required during the conversion
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
	 * This method returns a boolean indicating it the intger parameter is valid
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
	 * This method throws an exception with a short message and as such provides 
	 * a resonable mechanism for extending the convertor to better handle errors
	 * @param integer $int The integer input
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

		throw new Exception($msg);
	}
}