<?php

namespace app\Model;

/**
 * Model of Transaction
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
class Transaction extends Base
{
    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var double
     */
    public $amount;

    /**
     *
     * @var int
     */
    public $id;

    /**
     * list validation rules
     * @return array
     */
    protected function rules(): array
    {
        return [
            ['email', FILTER_VALIDATE_EMAIL, 'message' => 'Email is not valid'],
            ['amount', FILTER_VALIDATE_FLOAT, 'message' => 'Amount is not valid'],
            [
                'email',
                FILTER_CALLBACK,
                'options' => ['options' => [$this, 'froudDetect']],
                'message' => 'Fraud detected',
            ]
        ];
    }

    /**
     * storage table name
     * @return string
     */
    public function tableName(): string
    {
        return 'transactions';
    }

    /**
     * froud detect
     * @param type $value
     * @return bool
     */
    public function froudDetect($value)
    {
        return mt_rand(1, 10) > 5 ? true : false;
    }
}
