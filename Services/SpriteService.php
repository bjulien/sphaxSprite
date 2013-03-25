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
    public function getSpriteList()
    {
        $spriteList = $this->spriteConf->getConfig();
        if (empty($spriteList)) {
            throw new SpriteException('No sprite configuration found.');
        }
        return $spriteList;
    }

	/**
     * Création du sprite
     * 
     */
    public function createSprite()
    {
        $filesystem = new Filesystem();
        $spriteList = $this->getSpriteList();
        foreach ($spriteList as $key => $spriteInfo) {
            try {
                if ($filesystem->exists($spriteInfo['sourceSpriteImage']) === false) {
                    $filesystem->mkdir($spriteInfo['sourceSpriteImage']);
                }   
            } catch (DirectoryException $de) {
                throw new DirectoryException('Cannot create directory');
            }

            //create sprite config
            try {
                $fileSpriteConf = $spriteInfo['sourceSpriteImage'] . 'sprite.conf';  
                if (!$handle = fopen($fileSpriteConf, 'w')) {
                    throw new DirectoryException('Cannot open file' . $file);
                }
                $filesystem->chmod($fileSpriteConf, 0664);
            } catch (DirectoryException $de) {
                throw new DirectoryException('Sprite file config cannot be create');
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
        $spriteList = $this->getSpriteList();
        foreach ($spriteList as $key => $spriteInfo) {
            if ($key === $spriteName) {
                try {
                    if ($filesystem->exists($spriteInfo['sourceSpriteImage']) === false) {
                        $filesystem->mkdir($spriteInfo['sourceSpriteImage']);
                    }   
                } catch (DirectoryException $de) {
                    throw new DirectoryException('Cannot create directory');
                }

                //create sprite config
                try {
                    $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'sprite.conf';  
                    if (!$handle = fopen($fileSpriteConf, 'w')) {
                        throw new DirectoryException('Cannot open file' . $file);
                    }
                    $filesystem->chmod($fileSpriteConf, 0664);
                } catch (DirectoryException $de) {
                    throw new DirectoryException('Sprite file config cannot be create');
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

        $spriteList = $this->getSpriteList();
        foreach ($spriteList as $key => $spriteInfo) {
            try {
                $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'/sprite.conf';

                if (!$handle = fopen($fileSpriteConf, 'w')) {
                    throw new DirectoryException('Cannot open file'.$file);
                }
                fwrite($handle, $this->spriteConf->getFileConf($key));
                fclose($handle);
            } catch (DirectoryException $de) {
                throw new DirectoryException('Cannot write in sprite.conf');
            }
            
            // génération du sprite
            try {
                $this->executeBin($spriteInfo);
            } catch (SpriteException $de) {
                throw new DirectoryException('Sprite cannot be generate');
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

        $spriteList = $this->getSpriteList();
        foreach ($spriteList as $key => $spriteInfo) {
            if ($key === $spriteName) {
                try {
                    $fileSpriteConf = $spriteInfo['sourceSpriteImage'].'/sprite.conf';

                    if (!$handle = fopen($fileSpriteConf, 'w')) {
                        throw new DirectoryException('Cannot open file'.$file);
                    }
                    fwrite($handle, $this->spriteConf->getFileConf($key));
                    fclose($handle);
                } catch (DirectoryException $de) {
                    throw new DirectoryException('Cannot write in sprite.conf');
                }
                
                // génération du sprite
                try {
                    $this->executeBin($spriteInfo);
                } catch (SpriteException $de) {
                    throw new DirectoryException('Sprite cannot be generate');
                }
                return true;
            }
        }
    }

    /**
     * executeBin
     *
     * @param array $spriteInfo
     * @access private
     * @return mixed
     */
    private function executeBin($spriteInfo)
    {
        $retval = null;
        return system(
            '' . $spriteInfo['nameBin'] . ' ' .
                ($spriteInfo['force'] ? ' --force ' : '') .
                $spriteInfo['sourceSpriteImage'] . ' ' .
                $spriteInfo['outputSpriteImage'],
            $retval
        );
    }

}
