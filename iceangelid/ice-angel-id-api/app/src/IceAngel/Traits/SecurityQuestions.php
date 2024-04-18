<?php namespace IceAngel\Traits;

use Illuminate\Support\Facades\Hash;

trait SecurityQuestions {

    /**
     * Clear the security answer 1.
     *
     */
    public function clearSecurityQuestionAnswer1Attribute()
    {
        $this->attributes['security_question_1'] = null;
        $this->attributes['security_answer_1'] = null;
    }

    /**
     * Clear the security answer 2.
     *
     */
    public function clearSecurityQuestionAnswer2Attribute()
    {
        $this->attributes['security_question_2'] = null;
        $this->attributes['security_answer_2'] = null;
    }


    /**
     * Hash the security answer 1.
     *
     * @param $value
     */
    public function setSecurityAnswer1Attribute($value)
    {
        $this->attributes['security_answer_1'] = Hash::make($value);
    }

    /**
     * Hash the security answer 2.
     *
     * @param $value
     */
    public function setSecurityAnswer2Attribute($value)
    {
        $this->attributes['security_answer_2'] = Hash::make($value);
    }

    /**
     * Check if the given answer 1 is correct.
     *
     * @param string $answer
     * @return bool
     */
    public function checkSecurityAnswer1($answer)
    {
        return Hash::check($answer, $this->security_answer_1);
    }

    /**
     * Check if the given answer 2 is correct.
     *
     * @param string $answer
     * @return bool
     */
    public function checkSecurityAnswer2($answer)
    {
        return Hash::check($answer, $this->security_answer_2);
    }

    /**
     * Get the user's first security question.
     *
     * @return mixed
     */
    public function getSecurityQuestion1()
    {
        return $this->security_question_1;
    }

    /**
     * Get the user's second security question.
     *
     * @return mixed
     */
    public function getSecurityQuestion2()
    {
        return $this->security_question_2;
    }

    /**
     * Get the user's security questions.
     *
     * @return array
     */
    public function getSecurityQuestions()
    {
        return [
            'security_question_1' => $this->getSecurityQuestion1(),
            'security_question_2' => $this->getSecurityQuestion2(),
        ];
    }
}