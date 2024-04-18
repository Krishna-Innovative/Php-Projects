<?php

/**
 * Class ValidationException
 */
class ValidationException extends Exception
{

    /**
     * @var mixed
     */
    protected $errors;

    /**
     * @param string $message
     * @param mixed $errors
     */
    function __construct($message, $errors)
    {
        $this->errors = $errors;

        parent::__construct($message);
    }

    /**
     * Get form validation errors
     *
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

}

/**
 * Class BaseValidator
 */
class BaseValidator
{

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $v = Validator::make($data, $this->rules, $this->messages);

        if ($v->fails()) {
            throw new ValidationException('ValidationException', $v->messages());
        }

        return true;
    }

} 