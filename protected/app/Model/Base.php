<?php

namespace app\Model;

/**
 * Description of Base
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
abstract class Base implements IModel
{
    /**
     * list validation errors
     * @var array
     */
    private $errors = [];

    /**
     * storage component
     * @var \app\Service\Storage\IStorage
     */
    private $storage;

    /**
     *
     * @var bool
     */
    private $isValidate;

    /**
     * default error message
     * @var string
     */
    protected $defaultErrorMessage = 'Attribute is not valid';

    /**
     *
     * @param \app\Service\Storage\IStorage $storage
     */
    public function __construct(\app\Service\Storage\IStorage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * validate model
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->rules() as $rule) {
            $attributes = explode(',', ($rule[0] ?? ''));
            $validator = $rule[1] ?? null;
            if (!is_null($validator)) {
                foreach ($attributes as $attributeName) {
                    $options = $rule['options'] ?? [];
                    if (filter_var($this->$attributeName, $validator, $options) === false) {
                        $errorMessage = $rule['message'] ?? $this->defaultErrorMessage;
                        $this->errors[$attributeName][] = $errorMessage;
                    }
                }
            }
        }
        $this->isValidate = true;
        return empty($this->errors);
    }

    /**
     * save model
     * @return bool
     */
    public function save(): bool
    {
        if (is_null($this->isValidate)) {
            if ($this->validate()) {
                return $this->storage->save($this);
            } else {
                return false;
            }
        } else {
            return $this->storage->save($this);
        }
    }

    /**
     * get all errors
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * get all errors for $attributeName
     * @param string $attributeName
     * @return array
     */
    public function getError(string $attributeName): array
    {
        return $this->errors[$attributeName] ?? [];
    }

    /**
     * get all errors and convert result to string
     * @param type $format
     * @param type $errorDelimiter
     * @return string
     */
    public function getErrorsToString($format = '{attr}: {errors}', $errorDelimiter = '; '): string
    {
        $formatErros = [];
        foreach ($this->getErrors() as $attributeName => $errors) {
            $formatErros[] = str_replace(
                ['{attr}', '{errors}'],
                ['attr' => $attributeName, '{errors}' => implode(', ', $errors)],
                $format
            );
        }
        return implode($errorDelimiter, $formatErros);
    }

    /**
     * validation rules
     * @return array
     */
    protected function rules(): array
    {
        return [];
    }
}
