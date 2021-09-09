<?php

namespace humhub\modules\filesbrowser\helpers;

class FileIcons {
          
    public static function get_file_icon($title, $file_type) {
      
      $ext = '';
      $icon_class = '';
      
      if($file_type == 'b') {
        $position = strrpos($title, '.');
        $ext = substr($title, $position+1);
      }
                    
      switch ($ext) {

        case 'jpg':
        case 'gif':
        case 'bmp':
        case 'svg':
        case 'tiff':
        case 'png':      
          $icon_class = 'fal fa-file-image';
          break;

        case 'html':
        case 'cmd':  
        case 'bat':  
        case 'xml':  
          $icon_class = 'far fa-file-code';
          break;

        case 'zip':
        case 'rar':
        case 'gz':
        case 'tar':
          $icon_class = 'far fa-file-archive';
          break;

        case 'pdf':  
          $icon_class = 'far fa-file-pdf';
          break;

        case 'docx':  
        case 'doc':  
          $icon_class = 'far fa-file-word';
          break;

        case 'mp3':  
        case 'wav':  
          $icon_class = 'far fa-file-audio';
          break;

        case 'xls':  
        case 'xlsx':  
          $icon_class = 'far fa-file-excel';
          break;

        case 'ppt':  
        case 'pptx':  
          $icon_class = 'far fa-file-powerpoint';
          break;

        case 'txt':  
        case 'log':  
        case 'md':  
          $icon_class = 'far fa-file-alt';
          break;

        case 'mp4':  
        case 'mpeg':  
        case 'swf':  
          $icon_class = 'far fa-file-video';
          break;


        default:
          $icon_class = 'fa fa-folder';
          break;
      }
          
      return $icon_class;

    }
          
}

