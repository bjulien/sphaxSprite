<?php
 
namespace Sphax\SpriteBundle\Services;

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
        foreach ($spriteList as $key => $value) {
            foreach ($value['options'] as $keyOptions => $valueOptions) {
                str_replace('-', '_', $keyOptions);
            }
        }
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
                throw new SpriteException('Sprite cannot be generate');
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
                    throw new SpriteException('Sprite cannot be generate');
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
                ($spriteInfo['options']['crop'] != false ? ' --crop ' : '') .
                ($spriteInfo['options']['less'] != false ? ' --less ' : '') .
                (!empty($spriteInfo['options']['url']) ? ' --url=' . $spriteInfo['options']['url'] : '') .
                ($spriteInfo['options']['quiet'] != false ? ' --q ' : '') .
                (!empty($spriteInfo['options']['padding']) ? ' --padding=' . $spriteInfo['options']['padding'] : '') .
                (!empty($spriteInfo['options']['ratios']) ? ' --ratios= ' . $spriteInfo['options']['ratios'] : '') .
                ($spriteInfo['options']['retina'] != false ? ' --retina ' : '') .
                ($spriteInfo['options']['imagemagick'] != false ? ' --imagemagick ' : '') .
                (!empty($spriteInfo['options']['imagemagickpath']) ? ' --imagemagick --imagemagickpath=' . $spriteInfo['options']['imagemagickpath'] : '') .
                ($spriteInfo['options']['watch'] != false ? ' --watch ' : '') .
                (!empty($spriteInfo['options']['css']) ? ' --css=' . $spriteInfo['options']['css'] : '') .
                (!empty($spriteInfo['options']['img']) ? ' --img=' . $spriteInfo['options']['img'] : '') .
                ($spriteInfo['options']['html'] != false ? ' --html ' : '') .
                (!empty($spriteInfo['options']['algorithm']) ? ' --algorithm=' . $spriteInfo['options']['algorithm'] : '') .
                (!empty($spriteInfo['options']['ordering']) ? ' --ordering=' . $spriteInfo['options']['ordering'] : '') .
                (!empty($spriteInfo['options']['margin']) ? ' --margin=' . $spriteInfo['options']['margin'] : '') .
                (!empty($spriteInfo['options']['namespace']) ? ' --namespace=' . $spriteInfo['options']['namespace'] : '') .
                (!empty($spriteInfo['options']['sprite_namespace']) ? ' --sprite-namespace=' . $spriteInfo['options']['sprite_namespace'] : '') .
                (!empty($spriteInfo['options']['separator']) ? ' --separator=' . $spriteInfo['options']['separator'] : '') .
                (!empty($spriteInfo['options']['global_template']) ? ' --global-template=' . $spriteInfo['options']['global_template'] : '') .
                (!empty($spriteInfo['options']['each_template']) ? ' --each-template=' . $spriteInfo['options']['each_template'] : '') .
                (!empty($spriteInfo['options']['margin']) ? ' --margin=' . $spriteInfo['options']['margin'] : '') .
                ($spriteInfo['options']['png8'] != false ? ' --png8 ' : '') .
                (!empty($spriteInfo['options']['ignore_filename_paddings']) ? ' --ignore-filename-paddings ' : '') .
                ($spriteInfo['options']['debug'] != false ? ' --debug ' : '') .
                ($spriteInfo['options']['optipng'] != false ? ' --optipng ' : '') .
                ($spriteInfo['options']['cachebuster'] != false ? ' --cachebuster ' : '') .
                ($spriteInfo['options']['follow_links'] != false ? ' --follow-links ' : '') .
                ($spriteInfo['force'] != false ? ' --force ' : '') .
                ($spriteInfo['options']['no_img'] != false ? ' --no-img ' : '') .
                ($spriteInfo['options']['no_css'] != false ? ' --no-css ' : '') .
                ($spriteInfo['options']['cachebuster_filename'] != false ? ' --cachebuster_filename ' : '') .
                (!empty($spriteInfo['options']['optipngpath']) ? ' --optipng --optipngpath=' . $spriteInfo['options']['optipngpath'] : '') .
                $spriteInfo['sourceSpriteImage'] . ' ' .
                $spriteInfo['outputSpriteImage'],
            $retval
        );
    }

}
