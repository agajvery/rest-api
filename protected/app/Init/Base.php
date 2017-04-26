<?php

namespace app\Init;

/**
 * Description of Base
 *
 * @author agajvery
 */
abstract class Base implements IInit
{
    protected $rootDir;

    protected $configDirName = 'etc';

    protected $configLocalDirName = 'local';

    protected function doRun()
    {
        return true;
    }

    protected function afterRun()
    {
    }

    private function getConfig(): array
    {
        $config = [];

        $configFileName = $this->getConfigFileName();
        $pathToConfig = $this->pathToConfig() . DIRECTORY_SEPARATOR . $configFileName;
        $pathToLocalConfig = $this->pathToLocalConfig() . DIRECTORY_SEPARATOR . $configFileName;

        if (file_exists($pathToConfig)) {
            $config = require $pathToConfig;
        }

        if (file_exists($pathToLocalConfig)) {
            $localConfig = require $pathToLocalConfig;
            $config = array_merge_recursive($config, $localConfig);
        }
        return $config;
    }

    private function pathToConfig(): string
    {
        return $this->rootDir . DIRECTORY_SEPARATOR . $this->configDirName;
    }

    private function pathToLocalConfig(): string
    {
        return $this->pathToConfig() . DIRECTORY_SEPARATOR . $this->configLocalDirName;
    }

    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public final function run()
    {
        if ($this->doRun()) {
            $config = $this->getConfig();
            $appClass = $this->getAppClass();

            $app = new $appClass($config);
            $app->run();
        }
        $this->afterRun();
    }




}
