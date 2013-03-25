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
    private $config;


    /*
     * set config for command line
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /*
     * get config for command line
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sprite List
     * 
     */
    public function getSpriteList()
    {
        $spriteList = $this->getConfig();
        if (empty($spriteList)) {
            throw new SpriteException('No sprite configuration found.');
        }
        return $spriteList;
    }


    /**
     * generate sprite
     * 
     */
    public function generateSprite() 
    {
        $filesystem = new Filesystem();

        $spriteList = $this->getSpriteList();
        foreach ($spriteList as $key => $spriteInfo) {
            if ($filesystem->exists($spriteInfo['sourceSpriteImage']) === false) {
                throw new DirectoryException('Directory doesn\'t exist');
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
                if ($filesystem->exists($spriteInfo['sourceSpriteImage']) === false) {
                    throw new DirectoryException('Directory doesn\'t exist');
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
                ($spriteInfo['crop'] ? ' --crop ' : '') .
                ($spriteInfo['less'] ? ' --less ' : '') .
                ($spriteInfo['url'] ? ' --url=' . $spriteInfo['url'] : '') .
                ($spriteInfo['quiet'] ? ' --q ' : '') .
                ($spriteInfo['padding'] ? ' --padding=' . $spriteInfo['padding'] : '') .
                ($spriteInfo['ratios'] ? ' --ratios= ' . $spriteInfo['ratios'] : '') .
                ($spriteInfo['retina'] ? ' --retina ' : '') .
                ($spriteInfo['imagemagick'] ? ' --imagemagick ' : '') .
                ($spriteInfo['imagemagickpath'] ? ' --imagemagick --imagemagickpath=' . $spriteInfo['imagemagickpath'] : '') .
                ($spriteInfo['watch'] ? ' --watch ' : '') .
                ($spriteInfo['css'] ? ' --css=' . $spriteInfo['css'] : '') .
                ($spriteInfo['img'] ? ' --img=' . $spriteInfo['css'] : '') .
                ($spriteInfo['html'] ? ' --html ' : '') .
                ($spriteInfo['algorithm'] ? ' --algorithm=' . $spriteInfo['algorithm'] : '') .
                ($spriteInfo['ordering'] ? ' --ordering=' . $spriteInfo['ordering'] : '') .
                ($spriteInfo['margin'] ? ' --margin=' . $spriteInfo['margin'] : '') .
                ($spriteInfo['namespace'] ? ' --namespace=' . $spriteInfo['namespace'] : '') .
                ($spriteInfo['sprite-namespace'] ? ' --sprite-namespace=' . $spriteInfo['sprite-namespace'] : '') .
                ($spriteInfo['separator'] ? ' --separator=' . $spriteInfo['separator'] : '') .
                ($spriteInfo['global-template'] ? ' --global-template=' . $spriteInfo['global-template'] : '') .
                ($spriteInfo['each-template'] ? ' --each-template=' . $spriteInfo['each-template'] : '') .
                ($spriteInfo['margin'] ? ' --margin=' . $spriteInfo['margin'] : '') .
                ($spriteInfo['png8'] ? ' --png8 ' : '') .
                ($spriteInfo['ignore-filename-paddings'] ? ' --ignore-filename-paddings ' : '') .
                ($spriteInfo['debug'] ? ' --debug ' : '') .
                ($spriteInfo['optipng'] ? ' --optipng ' : '') .
                ($spriteInfo['cachebuster'] ? ' --cachebuster ' : '') .
                ($spriteInfo['follow-links'] ? ' --follow-links ' : '') .
                ($spriteInfo['force'] ? ' --force ' : '') .
                ($spriteInfo['no-img'] ? ' --no-img ' : '') .
                ($spriteInfo['no-css'] ? ' --no-css ' : '') .
                ($spriteInfo['cachebuster-filename'] ? ' --cachebuster-filename ' : '') .
                ($spriteInfo['optipngpath'] ? ' --optipng --optipngpath=' . $spriteInfo['optipngpath'] : '') .
                $spriteInfo['sourceSpriteImage'] . ' ' .
                $spriteInfo['outputSpriteImage'],
            $retval
        );
    }

}
