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
     * set exception and error handler
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
        $code = $exception->getCode();
        $errstr = $exception->getMessage();
        $errfile = $exception->getFile();
        $errline = $exception->getLine();
        $errno = '';

        $this->errroHandler($errno, $errstr, $errfile, $errline, $code);
    }

    /**
     *
     * @param string $errno
     * @param string $errstr
     * @param string $errfile
     * @param string $errline
     * @param string $code
     */
    private function errroHandler(string $errno, string $errstr, string $errfile, string $errline, string $code = '503')
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
        if ($code == '503') {
            header('HTTP/1.1 503 Service Temporarily Unavailable');
        }
        if ($code == '404') {
            header('HTTP/1.1 404 Not Found');
        }
        echo json_encode($result);
        exit();
    }
}