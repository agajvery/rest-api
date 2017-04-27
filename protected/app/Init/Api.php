<?php

namespace app\Init;

class Api extends Base
{
    /**
     * get configuration file name
     * @return string
     */
    public function getConfigFileName(): string
    {
        return 'api.php';
    }

    /**
     * get application class name
     * @return string
     */
    public function getAppClass(): string
    {
        return \app\App\Api::class;
    }

    /**
     * call before run
     * @return type
     */
    protected function doRun()
    {
        $erroHandler = function ($errno, $errstr, $errfile, $errline) {$this->errroHandler($errno, $errstr, $errfile, $errline);};
        $exceptionHandler = function (\Throwable $exception) {$this->exceptionHandler($exception);};

        set_error_handler($erroHandler);
        set_exception_handler($exceptionHandler);
        
        return parent::doRun();
    }

    /**
     * exception handler
     * @param \Error $exception
     */
    private function exceptionHandler(\Throwable $exception)
    {
        $errno = $exception->getCode();
        $errstr = $exception->getMessage();
        $errfile = $exception->getFile();
        $errline = $exception->getLine();

        $this->errroHandler($errno, $errstr, $errfile, $errline);
    }

    /**
     *
     * @param string $errno
     * @param string $errstr
     * @param string $errfile
     * @param string $errline
     */
    private function errroHandler(string $errno, string $errstr, string $errfile, string $errline)
    {
        $result = ['error_message' => $errstr];
        if ($this->isDebug === true) {
            $result['error_info'] = [
                'errno' => $errno,
                'errstr' => $errstr,
                'errfile' => $errfile,
                'errline' => $errline
            ];
        }
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        echo json_encode($result);
        exit();
    }
}