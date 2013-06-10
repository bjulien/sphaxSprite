<?php
namespace Tests\Units;

use \atoum;


class SpriteService extends atoum
{
    public function testGetSpriteList()
    {
        $testGetSprite = new SpriteService;

        $arrayMock = array('toto' =>
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
                                  'margin' => '',
                                  'sprite_namespace' =>'' ,
                                  'imagemagickpath' => '',
                                  'global_template' =>'' ,
                                  'each_template' =>'' ,
                                  'optipngpath' =>'' ,
                                  'separator' =>'')
        ));
        $resultArrayMock = array('toto' =>
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
                                  'cachebuster_filename' => '',
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
                                  'margin' => '',
                                  'sprite-namespace' =>'' ,
                                  'imagemagickpath' => '',
                                  'global-template' =>'' ,
                                  'each-template' =>'' ,
                                  'optipngpath' =>'' ,
                                  'separator' =>'')
        ));
        $testGetSprite->setConfig($arrayMock);

        $testGetSpriteList = $testGetSprite->getSpriteList();
        $this
            ->variable($testGetSpriteList)
                ->isEqualTo($resultArrayMock)
        ;
    }
}