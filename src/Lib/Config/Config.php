<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Lib\Config;

class Config implements ConfigInterface
{
    protected string $configPath = APP_PATH . '/Config/klog.php';

    protected array $configs;

    public function __construct()
    {
        $this->readconfig();
    }

    public function get(string $key)
    {
        $key = explode('.', $key);
        while (! is_null($item = array_shift($key))) {
            if (array_key_exists($item, $this->configs)) {
                return $this->configs[$item];
            }
        }

        return null;
    }

    protected function readconfig()
    {
        $this->configs = require $this->configPath;
    }
}
