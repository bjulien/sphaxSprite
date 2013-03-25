<?php
 
namespace Sphax\SpriteBundle\Services;

use Sphax\SpriteBundle\SpriteConf\SpriteConf;
use Sphax\SpriteBundle\Exception\DirectoryException;
use Sphax\SpriteBundle\Exception\SpriteException;
use Symfony\Component\Filesystem\Filesystem;
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
        $filesystem = new Filesystem();
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
                if (!$handle = fopen($fileSpriteConf, 'w')) {
                    throw new DirectoryException('Cannot open file'.$file, 1);
                }
                $filesystem->chmod($fileSpriteConf, 0664);
            } catch (DirectoryException $de) {
                throw new DirectoryException('Sprite file config cannot be create', 1);
            }
        }
    }

    /**
     * Create one sprite
     * 
     */
    public function createOneSprite($spriteName)
    {
        $filesystem = new Filesystem();
        $listSprite = $this->spriteConf->getConfig();
        foreach ($listSprite as $key => $spriteInfo) {
            if ($key === $spriteName) {
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
                    if (!$handle = fopen($fileSpriteConf, 'w')) {
                        throw new DirectoryException('Cannot open file'.$file, 1);
                    }
                    $filesystem->chmod($fileSpriteConf, 0664);
                } catch (DirectoryException $de) {
                    throw new DirectoryException('Sprite file config cannot be create', 1);
                }
                return true;
            }
        }
    }

    /**
     * generation du sprite
     * 
     */
    public function generateSprite() 
    {
        $filesystem = new Filesystem();

        $listSprite = $this->spriteConf->getConfig();
        foreach ($listSprite as $key => $spriteInfo) {
            try {
                $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'/sprite.conf';

                if (!$handle = fopen($fileSpriteConf, 'w')) {
                    throw new DirectoryException('Cannot open file'.$file, 1);
                }
                fwrite($handle, $this->spriteConf->getFileConf($key));
                fclose($handle);
            } catch (DirectoryException $de) {
                throw new DirectoryException('Cannot write in sprite.conf', 1);
            }
            
            // génération du sprite
            try {
                system(''.$spriteInfo['nameBin'].' '.$spriteInfo['sourceSpriteImage'].' '.$spriteInfo['outputSpriteImage'], $retval);
            } catch (SpriteException $de) {
                throw new DirectoryException('Sprite cannot be generate', 1);
            }
        }
    }


    /**
     * generate only one sprite
     * 
     */
    public function generateOneSprite($spriteName) 
    {
        $filesystem = new Filesystem();

        $listSprite = $this->spriteConf->getConfig();

        foreach ($listSprite as $key => $spriteInfo) {
            if ($key === $spriteName) {
                try {
                    $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'/sprite.conf';

                    if (!$handle = fopen($fileSpriteConf, 'w')) {
                        throw new DirectoryException('Cannot open file'.$file, 1);
                    }
                    fwrite($handle, $this->spriteConf->getFileConf($key));
                    fclose($handle);
                } catch (DirectoryException $de) {
                    throw new DirectoryException('Cannot write in sprite.conf', 1);
                }
                
                // génération du sprite
                try {
                    system(''.$spriteInfo['nameBin'].' '.$spriteInfo['sourceSpriteImage'].' '.$spriteInfo['outputSpriteImage'], $retval);
                } catch (SpriteException $de) {
                    throw new DirectoryException('Sprite cannot be generate', 1);
                }
                return true;
            }
        }
    }

}