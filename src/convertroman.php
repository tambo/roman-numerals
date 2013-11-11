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

	const NUMERALS_ALLOWED = "/[IVXLCDM]/";

	const TYPE_INTEGER = "integer"; // const def used in error handling
	const TYPE_NUMERAL = "numeral"; // const def used in error handling

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
						1 => "You must input a number between 1 and 3999",
						2 => "Only numerals I,V,X,L,C,D & M are supported"
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
			$result = $this->handleInputError(self::TYPE_INTEGER, $int);
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

		// first we check for valid input
		$match = preg_grep(self::NUMERALS_ALLOWED, (str_split($numerals)), PREG_GREP_INVERT);
		if(count($match) > 0)
		{
			// if string contains illegal characters
			$result = $this->handleInputError(self::TYPE_NUMERAL); 
			return $result;
		}

		// now create the numeral map if not already done
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
			$result = $this->handleInputError(self::TYPE_INTEGER, $result);
		}	

		return $result;
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
	 * The convertor must only convert integers within a valid range
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
	 * @param string $inputType The type of input to handle error for
	 * @param integer $int The integer input
	 * @return string The error message
	 */
	protected function handleInputError($inputType, $int = null)
	{
		$msg = 'unknown error';

		switch($inputType)
		{
			case(self::TYPE_INTEGER):
				if(!$int)
				{
					$msg = $this->errorMessages[0];
				}

				if($int < self::MIN_INT || $int > self::MAX_INT)
				{
					$msg = $this->errorMessages[1];
				} 
				break;
			case(self::TYPE_NUMERAL):
				$msg = $this->errorMessages[2];
				break;
		}
		

		//throw new Exception($msg);
		return $msg;
	}
}