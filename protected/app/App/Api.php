<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\App;

/**
 * Description of Api
 *
 * @author agajvery
 */
class Api extends Base
{
    public function run()
    {
        $this->buildController();
    }

    protected function buildController()
    {
        $result = $this->getService('urlManager')->parseUrl();
        
        if (is_null($result)) {
            throw new \Error('Page doen\'t found', 404);
        }
        echo $this->getService('request')->pathInfo();
    }
}
