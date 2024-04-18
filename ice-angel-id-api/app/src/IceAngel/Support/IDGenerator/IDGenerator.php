<?php namespace IceAngel\Support\IDGenerator;

use DB;

class IDGenerator {

    /**
     * @var RandomDigitGeneratorInterface
     */
    protected $randomDigitGenerator;

    /**
     * Generates a unique IceAngel ID.
     *
     * @return int
     */
    public static function generate($user = null)
    {
        $instance = new static;
        $randomDigits = $instance->generateUnique10Digits();

        list($firstDigit, $secondDigit) = $instance->calculateMod97($randomDigits);

        $randomDigits = $instance->insertDigitAtPosition(5, $firstDigit, $randomDigits);
        $randomDigits = $instance->insertDigitAtPosition(9, $secondDigit, $randomDigits);

        if (!$instance->isValid($randomDigits) || $instance->exists($randomDigits)) {
            $instance->generate();
        }

        return $randomDigits;
    }

    /**
     * Insert a value within a portion of a number
     *
     * @param $position
     * @param $value
     * @param $subject
     * @return mixed
     */
    protected function insertDigitAtPosition($position, $value, $subject)
    {
        return substr_replace($subject, $value, $position, 0);
    }

    /**
     * Calculate Mod 97 and return array of 2 digits result.
     *
     * @param $number
     * @return array
     */
    protected function calculateMod97($number)
    {
        $mod = $number % 97;

        if ($mod < 10) {
            return [0, $mod];
        }

        return [floor($mod / 10), $mod % 10];
    }

    /**
     * Generate unique 10 digits.
     *
     * @return int
     */
    protected function generateUnique10Digits()
    {
        $pow = pow(10, 10);

        return rand($pow / 10, $pow - 1);
    }

    /**
     * Check if the the id has been already taken.
     *
     * @param $randomDigits
     * @return bool
     */
    private function exists($randomDigits)
    {
        return !!DB::table('users')->where('ice_id', $randomDigits)->count();
    }

    /**
     * Check if the given number does not include
     * any repeated digit more than 4 times.
     *
     * @param number $number
     * @return bool
     */
    private function isValid($number)
    {
        $regex = "/(\d)\\1{4}/";

        return !preg_match($regex, $number, $matches);
    }
} 