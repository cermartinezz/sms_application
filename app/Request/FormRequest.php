<?php

namespace App\Request;

use Cake\Validation\Validator;

abstract class FormRequest
{
    /**
     * @var Validator
     */
    protected $validator;
    protected $prepareData = [];
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

    public function prepareData($data)
    {
        return $this;
    }

    public function validate($data)
    {
        return $this->prepareData($data)
            ->setData($data)
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
        $this->data = array_merge($data,$this->prepareData);

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

    public function validated():array
    {
        return $this->data;
    }


}
