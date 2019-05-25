<?php
/**
 * @author: Sonia Solanki
 * @date: March 01, 2018
 * @version: 1.0.0
 */
namespace App\View\Helper;

use Cake\Filesystem\Folder;
use Cake\View\Helper;

class ImageHelper extends Helper
{
    const IMAGE_ROOT = WWW_ROOT.'img'.DS;
    const IMAGE_DIR = 'img'.DS;
    const CACHE_DIRECTORY = 'cache'.DS;
    
    public $helpers = ['Html', 'Url'];
    
    public function image($path, $licencePath, $frameWidth, $frameHeight, $keepAspectRatio = true, $keepFrame = true, $constrainOnly = true, $cropImage = false, $imgTag = true, $htmlAttributes = [])
    {
        $types = [1 => 'gif', 'jpeg', 'png'];
        
        $sourceFile = static::IMAGE_ROOT.$licencePath.$path;
        $cacheAfter = $frameWidth.'x'.$frameHeight.DS.((int)$keepAspectRatio.(int)$keepFrame.(int)$constrainOnly.(int)$cropImage).DS;
        
        if(!($size = getimagesize($sourceFile)))
        {
            return;
        }
        
        $sourceX = $sourceY = 0;
        list($sourceWidth, $sourceHeight) = $size;
        
        $destinationX = $destinationY = 0;
        $destinationWidth = $frameWidth;
        $destinationHeight = $frameHeight;
        
        if($cropImage)
        {
            $keepAspectRatio = $keepFrame = $constrainOnly = true;
            
            $ratio = max(($frameWidth / $sourceWidth), ($frameHeight / $sourceHeight));
            $sourceX = round(($sourceWidth - ($frameWidth/$ratio))/2);
            
            $sourceHeight = round($frameHeight / $ratio);
            $sourceWidth = round($frameWidth / $ratio);
        }
        else
        {
            if($keepAspectRatio)
            {
                if($constrainOnly && ($frameWidth >= $size[0]) && ($frameHeight >= $size[1]))   //$size[0]:width, [1]:height, [2]:type
                {
                    $destinationWidth  = $size[0];
                    $destinationHeight = $size[1];
                }
                
                if(($size[0] / $size[1]) >= ($frameWidth / $frameHeight))
                {
                    $destinationHeight = round(($destinationWidth / $size[0]) * $size[1]);
                }
                else
                {
                    $destinationWidth = round(($destinationHeight / $size[1]) * $size[0]);
                }
            }
            
            $destinationX = round(($frameWidth - $destinationWidth) / 2);
            $destinationY = round(($frameHeight - $destinationHeight) / 2);
            
            if(!$keepFrame)
            {
                $frameWidth = $destinationWidth;
                $frameHeight = $destinationHeight;
                $destinationX = $destinationY = 0;
            }
        }
        
        $destinationFile = static::IMAGE_ROOT.$licencePath.static::CACHE_DIRECTORY.dirname($path).DS.$cacheAfter.basename($path);
        $destination = $this->request->getAttribute('webroot').static::IMAGE_DIR.$licencePath.static::CACHE_DIRECTORY.dirname($path).DS.$cacheAfter.basename($path);
        
        $folder = new Folder(dirname($destinationFile), true);
        
        $cached = false;
        if(file_exists($destinationFile))
        {
            $cached = true;
            if(@filemtime($destinationFile) < @filemtime($sourceFile))
            {
                $cached = false;
            }
        }
        
        if(!$cached)
        {
            $image = call_user_func('imagecreatefrom'.$types[$size[2]], $sourceFile);
            if(function_exists('imagecreatetruecolor') && ($temp = imagecreatetruecolor($frameWidth, $frameHeight)))
            {
                if(in_array($types[$size[2]], ['gif', 'png']))
                {
                    imagesavealpha($temp, true);
                    $transparentBackground = imagecolorallocatealpha($temp, 0, 0, 0, 127);
                    imagefill($temp, 0, 0, $transparentBackground);
                }
                else
                {
                    $whiteBackground = imagecolorallocate($temp, 255, 255, 255);
                    imagefill($temp, 0, 0, $whiteBackground);
                }
                
                imagecopyresampled($temp, $image, $destinationX, $destinationY, $sourceX, $sourceY, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
            }
            else
            {
                $temp = imagecreate($frameWidth, $frameHeight);
                $whiteBackground = imagecolorallocate($temp, 255, 255, 255);
                imagefill($temp, 0, 0, $whiteBackground);
                
                imagecopyresized($temp, $image, $destinationX, $destinationY, $sourceX, $sourceY, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
            }
            
            call_user_func('image'.$types[$size[2]], $temp, $destinationFile);
            imagedestroy($image);
            imagedestroy($temp);
        }
        
        if($imgTag)
        {
            $templater = $this->Html->templater();
            return $templater->format('image', [
                'url' => $destination, 'attrs' => $templater->formatAttributes($htmlAttributes)
            ]);
        }
        else
        {
            return $this->Url->build('/', true).static::IMAGE_DIR.$licencePath.static::CACHE_DIRECTORY.dirname($path).DS.$cacheAfter.basename($path);
        }
    }
}
