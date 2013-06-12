<?php
namespace Sphax\SphaxSprite\Services\tests\units;

use \atoum;

class SpriteService extends atoum
{
    public function testGetSpriteList()
    {
        $testGetSprite = new \SphaxSprite\Services\SpriteService;
        
        $arrayData = array('toto' =>
                     array('sourceSpriteImage' => '/home/upload/sphax/src/Acme/DemoBundle/Resources/public/images/',
                     'outputSpriteImage' => '/home/upload/sphax/src/Acme/DemoBundle/Resources/public/images/sprites/',
                     'nameBin' => 'glue',
                     'force' =>'',
                     'options' => 
                            array('optipng' => '',
                                  'cachebuster' =>'',
                                  'less' => '',
                                  'crop' => '',
                                  'quiet' => '',
                                  'retina' => '',
                                  'imagemagick' => '',
                                  'watch' => '',
                                  'html' => '',
                                  'png8' => '',
                                  'ignore-filename-paddings' => '',
                                  'debug' => '',
                                  'cachebuster-filename' => '',
                                  'follow-links' =>'' ,
                                  'no-img' =>'' ,
                                  'no-css' =>'' ,
                                  'namespace' => '',
                                  'url' => '',
                                  'padding' => '',
                                  'ratios' =>'' ,
                                  'css' =>'' ,
                                  'img' =>'' ,
                                  'algorithm' => '',
                                  'ordering' => '',
                                  'margin' => '10',
                                  'sprite-namespace' =>'' ,
                                  'imagemagickpath' => '',
                                  'global-template' =>'' ,
                                  'each-template' =>'' ,
                                  'optipngpath' =>'' ,
                                  'separator' =>'')
        ));
        $resultArrayData = array('toto' =>
                     array('sourceSpriteImage' => '/home/upload/sphax/src/Acme/DemoBundle/Resources/public/images/',
                     'outputSpriteImage' => '/home/upload/sphax/src/Acme/DemoBundle/Resources/public/images/sprites/',
                     'nameBin' => 'glue',
                     'force' =>'',
                     'options' => 
                            array('optipng' => '',
                                  'cachebuster' =>'',
                                  'less' => '',
                                  'crop' => '',
                                  'quiet' => '',
                                  'retina' => '',
                                  'imagemagick' => '',
                                  'watch' => '',
                                  'html' => '',
                                  'png8' => '',
                                  'ignore_filename_paddings' => '',
                                  'debug' => '',
                                  'cachebuster_filename' => '',
                                  'follow_links' =>'' ,
                                  'no_img' =>'' ,
                                  'no_css' =>'' ,
                                  'namespace' => '',
                                  'url' => '',
                                  'padding' => '',
                                  'ratios' =>'' ,
                                  'css' =>'' ,
                                  'img' =>'' ,
                                  'algorithm' => '',
                                  'ordering' => '',
                                  'margin' => '10',
                                  'sprite_namespace' =>'' ,
                                  'imagemagickpath' => '',
                                  'global_template' =>'' ,
                                  'each_template' =>'' ,
                                  'optipngpath' =>'' ,
                                  'separator' =>'')
        ));
        

        $testGetSprite->setConfig($arrayData);
        $testGetSpriteList = $testGetSprite->getSpriteList();

        $this
            ->variable($testGetSpriteList)
                ->isEqualTo($resultArrayData)
        ;
    }

    public function testGenerateOneSprite() {
        $testGenerate = new \SphaxSprite\Services\SpriteService;
        $fs = new \Symfony\Component\Filesystem\Filesystem;
        $arrayData = array('toto' =>
                     array('sourceSpriteImage' => '/home/pl4n7tis/sphaxSprite/src/SphaxSprite/tests/Resources/public/images/',
                     'outputSpriteImage' => '/home/pl4n7tis/sphaxSprite/src/SphaxSprite/tests/Resources/public/sprites/',
                     'nameBin' => 'glue',
                     'force' =>'',
                     'options' => 
                            array('optipng' => true,
                                  'cachebuster' =>true,
                                  'less' => true,
                                  'crop' => '',
                                  'quiet' => true,
                                  'retina' => '',
                                  'imagemagick' => '',
                                  'watch' => '',
                                  'html' => '',
                                  'png8' => '',
                                  'ignore-filename-paddings' => '',
                                  'debug' => '',
                                  'cachebuster-filename' => '',
                                  'follow-links' =>'',
                                  'no-img' =>'',
                                  'no-css' =>'',
                                  'namespace' => '',
                                  'url' => '',
                                  'padding' => '',
                                  'ratios' =>'',
                                  'css' =>'',
                                  'img' =>'',
                                  'algorithm' => '',
                                  'ordering' => '',
                                  'margin' => '',
                                  'sprite-namespace' =>'',
                                  'imagemagickpath' => '',
                                  'global-template' =>'',
                                  'each-template' =>'',
                                  'optipngpath' =>'',
                                  'separator' =>'')
        ));
        $testGenerate->setConfig($arrayData);
        $testGenerate->generateOneSprite('toto');

        $this
            ->boolean($fs->exists('/home/pl4n7tis/sphaxSprite/src/SphaxSprite/tests/Resources/public/sprites/images.png'))
                ->isTrue()
        ;
    }



    public function tearDown()
    {
        $fs = new \Symfony\Component\Filesystem\Filesystem;
        $fs->remove(array('/home/pl4n7tis/sphaxSprite/src/SphaxSprite/tests/Resources/public/sprites/images.png', '/home/pl4n7tis/sphaxSprite/src/SphaxSprite/tests/Resources/public/sprites/images.less'));
    }
}