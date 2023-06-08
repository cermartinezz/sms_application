<?php

namespace App\Request;

use Cake\Validation\Validator;

abstract class FormRequest
{
    /**
     * @var Validator
     */
    protected $validator;
    private $data;
    /**
     * @var array[]
     */
    private $errors;
    /**
     * @var bool
     */
    private $isValid;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function validate($data)
    {
        return $this->setData($data)
            ->setRules()
            ->runValidation()
            ->setValid();
    }

    private function setRules(): FormRequest
    {
        $this->rules();

        return $this;
    }

    private function runValidation(): FormRequest
    {
        $this->errors = $this->validator->validate($this->data);

        return $this;
    }

    private function setData($data): FormRequest
    {
        $this->data = $data;

        return $this;
    }

    private function setValid(): FormRequest
    {
        $this->isValid = empty($this->errors);

        return $this;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function isNotValid(): bool
    {
        return !$this->isValid();
    }

    public function errors(): array
    {
        return $this->errors;
    }


}
