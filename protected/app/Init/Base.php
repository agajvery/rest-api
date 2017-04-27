<?php

namespace app\Init;

/**
 * Description of Base
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
abstract class Base implements IInit
{
    /**
     * path to the root directory
     * @var string
     */
    protected $rootDir;

    /**
     * path to the configuration directory
     * @var string
     */
    protected $configDirName = 'etc';

    /**
     *
     * @var bool
     */
    protected $isDebug = false;

    /**
     * path to the local configuration directory
     * @var string
     */
    protected $configLocalDirName = 'local';

    protected function doRun()
    {
        return true;
    }

    protected function afterRun()
    {
    }

    /**
     * return configuration
     * @return array
     */
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

    /**
     * get full path to the configuration file
     * @return string
     */
    private function pathToConfig(): string
    {
        return $this->rootDir . DIRECTORY_SEPARATOR . $this->configDirName;
    }

    /**
     * get full path to the local configuration file
     * @return string
     */
    private function pathToLocalConfig(): string
    {
        return $this->pathToConfig() . DIRECTORY_SEPARATOR . $this->configLocalDirName;
    }

    /**
     *
     * @param string $rootDir path to the root directory
     */
    public function __construct(string $rootDir, bool $isDebug = false)
    {
        $this->rootDir = $rootDir;
        $this->isDebug = $isDebug;
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
