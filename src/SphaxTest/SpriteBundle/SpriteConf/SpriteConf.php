<?php
Namespace Sphax\SpriteBundle\SpriteConf;

/*
*
* Define a classic confirguration for a sprite
*
*/
class SpriteConf implements SpriteConfInterface
{

    private $config;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    /*
    * Return Sprite Conf File
    */
    public function getFileConf($key) {
        $fileConfig = '[sprite]'.PHP_EOL;
        foreach ($this->config[$key] as $key => $setConfig) {
            if ($key == 'options') {
                foreach ($setConfig as $keyOption => $option) {
                    if ($option === false) {
                        $option = "false";
                    } elseif ($option === true) {
                        $option = "true";
                    }
                    $fileConfig.= $keyOption.'='.$option.PHP_EOL;
                }
            }
        }
        return $fileConfig;
    }

}