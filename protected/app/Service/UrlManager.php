<?php

namespace app\Service;

/**
 * Description of UrlManager
 *
 * @author haivoronskyi.oleksandr@gmail.com
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

    /**
     *
     * @var array
     */
    private $rules = [];

    /**
     *
     * @var array
     */
    private $params = [];

    public function init()
    {
    }

    /**
     * set request component name
     * @param string $serviceName
     */
    public function setRequestServise(string $serviceName)
    {
        $request = \app\App\Base::getService($serviceName);
        $this->setRequest($request);
    }

    /**
     *
     * @param \app\Service\IRequest $request
     */
    public function setRequest(IRequest $request)
    {
        $this->request = $request;
    }

    /**
     *
     * @param array $rules
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * parse URL and return 'controller/action' or null
     * @return string | null
     */
    public function parseUrl()
    {
        foreach ($this->rules as $rule) {
            if (isset($rule['method']) && $rule['method'] == $this->request->method()) {
                if (isset($rule['pattern']) &&
                    preg_match($rule['pattern'], $this->request->pathInfo(), $mathes)
                ) {
                    foreach ($rule['avaibleParams'] as $paramName) {
                        if (isset($mathes[$paramName])) {
                            $this->params[$paramName] = $mathes[$paramName];
                        }
                    }
                    return $rule['action'];
                }
            }
        }
        return null;
    }

    /**
     * get params from path
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
