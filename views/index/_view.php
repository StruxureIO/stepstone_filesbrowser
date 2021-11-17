<?php

//use Yii;
use yii\helpers\Url;
use humhub\modules\filesbrowser\helpers\FileIcons;


$html = '';
//$pagination = '';
$folder_name = 'Home';

$current_user_id = \Yii::$app->user->identity->ID;

if($folders) { 
  
  if (\Yii::$app->urlManager->enablePrettyUrl) 
    $base_url = Url::base() . '/file/file/download?guid=';
  else
    $base_url = Url::base() . '/index.php?r=file%2Ffile%2Fdownload&guid=';

  foreach($folders as $folder) {
            
    $icon_class = FileIcons::get_file_icon($folder['title'], $folder['file_type']);        
    
    if (\Yii::$app->urlManager->enablePrettyUrl) {
      $hash_sha1 = "&hash_sha1=" . substr($folder['hash_sha1'], 0, 8);      
      $href = ($folder['file_type'] == 'b') ? 'href="'.$base_url. $folder['guid'] . $hash_sha1 .'" target="_blank"' : 'class="title-link"';
    } else {
      $href = ($folder['file_type'] == 'b') ? 'href="'.$base_url. $folder['guid'] .'" target="_blank"' : 'class="title-link"';
    }  
    
    $size = ($folder['size'] == '') ? '-&nbsp;&nbsp;' : number_format($folder['size']);
    $file_date = ($folder['updated_at'] == '') ? '' : date("m/d/Y", strtotime($folder['updated_at']));    
    
    $html .= '<tr >' . PHP_EOL;
    $html .= '  <td class="text-left">' . PHP_EOL;
    $html .= '    <div class="title" style="position:relative">' . PHP_EOL;
    $html .= '      <i class="'.$icon_class.'"></i>&nbsp;<a '. $href .' data-id="'. $folder['id'].'">'.$folder['title']. ' ' .'</a> ' . PHP_EOL;
    $html .= '    </div>' . PHP_EOL;
    $html .= '  </td>' . PHP_EOL;
    $html .= '  <td class="hidden-xs text-right">' . PHP_EOL;    
    $html .= '    <div class="size pull-right">'.$size.'</div>' . PHP_EOL;
    $html .= '  </td>' . PHP_EOL;
    $html .= '  <td class="hidden-xxs text-right">' . PHP_EOL;
    $html .= '    <div class="timestamp pull-right">' . PHP_EOL;
    $html .= '      <time class="tt time timeago">'. $file_date .'</time>' . PHP_EOL; 
    $html .= '    </div>' . PHP_EOL;
    $html .= '  </td>' . PHP_EOL;
    $html .= '</tr>' . PHP_EOL;
  } 
    
} else {
  $html = '<p id="no-files-founds">No files found</p>';  
}
  
//$pagination .= '<div id="files-page-navigation">' . PHP_EOL;
//if($page > 0)
//  $pagination .= '  <a id="step-file-prev" data-page-id="'. ($page-1) .'">< Previous</a>' . PHP_EOL;
//if($page < $total_number_pages-1)
//  $pagination .= '  <a id="step-file-next" data-page-id="'. ($page+1) .'">Next ></a>' . PHP_EOL;
//$pagination .= '</div>' . PHP_EOL;

$data = array ('html' => $html, 'folder_name' => $folder_name);
echo json_encode($data);

die();
?>
