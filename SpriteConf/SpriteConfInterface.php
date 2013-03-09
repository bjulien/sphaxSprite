<?php
Namespace Sphax\SpriteBundle\SpriteConf;

/*
*
* Define a classic confirguration for a sprite
*
*/
interface SpriteConfInterface
{
    /*
    * Set Config
    */
    public function setConfig($config);
    
    /*
    * Get Config
    */
    public function getConfig();

    /*
    * Return Sprite Conf File
    */
    public function getFileConf($key); 

}