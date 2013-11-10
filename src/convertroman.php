<?

/** 
 * The following Class and Interface have been developed as a solution to the
 * Developer Coding Kata v4 test set by the BBC Recruitment Team. The intent is 
 * to determine what approach and assuptions are used to build the solution
 * 
 * Tam Saunders 10/11/2013 - tam.saunders@gmail.com
 */

/**
 * Interface definition for Roman Numerals convertor.
 * This is the interface definition procided for the test.
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

	// The map / table to use for conversions
	public $convertMap = array(
						"1" => "I",
						"5" => "V",
						"10" => "X",
						"50" => "L",
						"100" => "C",
						"500" => "D",
						"1000" => "M"
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
			$result = 'PASSED!' . $int; // start with initial string
			return $result;
		}
		else 
		{
			$this->handleInputError($int);
		}

		
	}

	public function parse($string)
	{
		$result = 0; // start with initial integer of 0
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
		$msg = 'unknown errpr';

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