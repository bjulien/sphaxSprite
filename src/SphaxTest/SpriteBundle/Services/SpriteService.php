<?php
 
namespace Sphax\SpriteBundle\Services;

use Sphax\SpriteBundle\FileSprite\FileSprite;
use Sphax\SpriteBundle\SpriteConf\SpriteConf;
use Symfony\Component\Filesystem\Exception\IOException;


/**
 * Generateur de sprite
 *
 * @author julien besnard
 */
class SpriteService implements SpriteServiceInterface
{
 
    /**
     * @var SpriteConfInterface
     */
    protected $spriteConf;

    public function __construct(SpriteConf $spriteConf)
    {
        $this->spriteConf = $spriteConf;
    }

    /**
     * liste des sprites
     * 
     */
    public function listSprite()
    {
        return $this->spriteConf->getConfig();
    }

	/**
     * Création du sprite
     * 
     */
    public function createSprite()
    {
        $filesystem = new FileSprite();
        $listSprite = $this->spriteConf->getConfig();
        foreach ($listSprite as $key => $spriteInfo) {
            /*if ($key === $spriteName && $spriteInfo->getBundle() === $dirBundle && $spriteInfo->getDossierImage() === $dirDossierImage) {
                throw new Exception('Sprite already exist with the same informations', 1);
            }*/
            if ($filesystem->exists($spriteInfo['sourceSpriteImage']) === false) {
                $filesystem->mkdir($spriteInfo['sourceSpriteImage']);
            }

            //create sprite config
            $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'sprite.conf';
            $handle = $filesystem->fopen($fileSpriteConf, 'w');
        }
    }

    /**
     * generation du sprite
     * 
     */
    public function generateSpriteAction() 
    {
        $filesystem = new FileSprite();

        $listSprite = $this->spriteConf->getConfig();
        foreach ($listSprite as $key => $spriteInfo) {
            $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'/sprite.conf';

            $handle = $filesystem->fopen($fileSpriteConf, 'w');
            fwrite($handle, $this->spriteConf->getFileConf($key));
            fclose($handle);

            // génération du sprite
            system('glue '.$spriteInfo['sourceSpriteImage'].' '.$spriteInfo['outputSpriteImage'], $retval);
        }
        //$filesystem->mirror($spriteInfo['outputSpriteImage'], $dirGlobal.'/web/bundles/'.strtolower($this->getRequest()->query->get('site')).$dirAsset.'/sprites');
    }

}