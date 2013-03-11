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
     * Create one sprite
     * 
     */
    public function createOneSprite($spriteName);

    /**
     * generation du sprite
     * 
     */
    public function generateSprite();

    /**
     * generate only one sprite
     * 
     */
    public function generateOneSprite($spriteName);
}