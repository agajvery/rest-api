<?php

namespace app\Init;

class Api extends Base
{
    public function getConfigFileName(): string
    {
        return 'api.php';
    }

    public function getAppClass(): string
    {
        return \app\App\Api::class;
    }

    protected function doRun()
    {
        $erroHandler = function ($errno, $errstr, $errfile, $errline) {$this->errroHandler($errno, $errstr, $errfile, $errline);};
        $exceptionHandler = function (\Error $exception) {$this->exceptionHandler($exception);};

        set_error_handler($erroHandler);
        set_exception_handler($exceptionHandler);
        
        return parent::doRun();
    }

    private function exceptionHandler(\Error $exception)
    {
        $errno = $exception->getCode();
        $errstr = $exception->getMessage();
        $errfile = $exception->getFile();
        $errline = $exception->getLine();

        $this->errroHandler($errno, $errstr, $errfile, $errline);
    }

    private function errroHandler($errno, $errstr, $errfile, $errline)
    {
        $result = ['error' => $errstr];
        if (IS_DEBUG) {
            $result['error_info'] = [
                'errno' => $errno,
                'errstr' => $errstr,
                'errfile' => $errfile,
                'errline' => $errline
            ];
        }
        echo json_encode($result);
        exit();

    }
}