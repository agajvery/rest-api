<?php

namespace app\Service;

/**
 * Description of UrlManager
 *
 * @author agajvery
 */
class UrlManager extends Base
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     *
     * @var IRequest
     */
    private $request;

    private $rules = [];

    public function init()
    {
    }

    public function setRequestServise(string $serviceName)
    {
        $request = \app\App\Base::getService($serviceName);
        $this->setRequest($request);
    }

    public function setRequest(IRequest $request)
    {
        $this->request = $request;
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    public function parseUrl()
    {
        foreach ($this->rules as $rule) {
            if (isset($rule['method']) && $rule['method'] == $this->request->method()) {
                var_dump($rule['pattern'], $this->request->pathInfo());
                if (isset($rule['pattern']) &&
                    preg_match($rule['pattern'], $this->request->pathInfo(), $mathes)
                ) {
                    var_dump($mathes);
                }
            }
        }
        return null;
    }
}
