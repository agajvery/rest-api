<?php

namespace app\Controller;

/**
 * Description of Transaction
 *
 * @author agajvery
 */
class Transaction
{
    /**
     * this method will call before action
     * action method will be call if this method return true
     * @return boolean
     */
    public function beforeRun()
    {
        return true;
    }

    /**
     * save transaction
     * 
     * @param string $email
     * @param string $amount
     */
    public function actionSave(string $email, string $amount)
    {
        $model = new \app\Model\Transaction(\app\App\Base::getService('storage'));
        $model->email = $email;
        $model->amount = $amount;

        if ($model->save()) {
            $result = [
                'status' => 'approved',
                'transaction_id' => $model->id,
            ];
        } else {
            $result = [
                'status' => 'rejected',
                'error_message' => $model->getErrorsToString()
            ];
        }
        echo json_encode($result);
    }
}
