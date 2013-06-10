<?php
Namespace SphaxSprite\Services;

/*
*
* Define a classic confirguration for a sprite
*
*/
interface SpriteServiceInterface
{
    /**
     * liste des sprites
     * 
     */
    public function getSpriteList();


    /**
     * generation du sprite
     * 
     */
    public function generateSprite();

    /**
     * generation du sprite
     * 
     */
    public function generateOneSprite($spriteName);

}
