<?php
Namespace Sphax\SpriteBundle\Services;

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
    public function listSprite();

    /**
     * Création du sprite
     * 
     */
    public function createSprite();

    /**
     * generation du sprite
     * 
     */
    public function createOneSprite($spriteName);

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