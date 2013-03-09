<?php
namespace Sphax\SpriteBundle\FileSprite;

use Symfony\Component\Filesystem\Filesystem;

class FileSprite extends Filesystem
{

    public function fopen($file, $mode) 
    {
        if (!$handle = fopen($file, $mode)) {
            throw new Exception('Cannot open file'.$file, 1);
        }

        return $handle;
    }

    public function fread($handle)
    {
    	while (!feof($handle)) { 
            $lines[] = fgets($handle, 4096); 
        }

        return $lines;
    }

}