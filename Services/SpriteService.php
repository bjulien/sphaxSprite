<?php
 
namespace Sphax\SpriteBundle\Services;

use Sphax\SpriteBundle\FileSprite\FileSprite;
use Sphax\SpriteBundle\SpriteConf\SpriteConf;
use Sphax\SpriteBundle\Exception\DirectoryException;
use Sphax\SpriteBundle\Exception\SpriteException;
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
            try {
                if ($filesystem->exists($spriteInfo['sourceSpriteImage']) === false) {
                    $filesystem->mkdir($spriteInfo['sourceSpriteImage']);
                }   
            } catch (DirectoryException $de) {
                throw new DirectoryException('Cannot create directory', 1);
            }

            //create sprite config
            try {
                $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'sprite.conf';  
                $handle = $filesystem->fopen($fileSpriteConf, 'w');
            } catch (DirectoryException $de) {
                throw new DirectoryException('Sprite file config cannot be create', 1);
            }
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
            try {
                $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'/sprite.conf';

                $handle = $filesystem->fopen($fileSpriteConf, 'w');
                fwrite($handle, $this->spriteConf->getFileConf($key));
                fclose($handle);
            } catch (DirectoryException $de) {
                throw new DirectoryException('Cannot write in sprite.conf', 1);
            }
            
            // génération du sprite
            try {
                system('glue '.$spriteInfo['sourceSpriteImage'].' '.$spriteInfo['outputSpriteImage'], $retval);
                //$filesystem->mirror($spriteInfo['outputSpriteImage'], $dirGlobal.'/web/bundles/'.strtolower($this->getRequest()->query->get('site')).$dirAsset.'/sprites');    }
            } catch (SpriteException $de) {
                throw new DirectoryException('Sprite cannot be generate', 1);
            }
        }
        

}