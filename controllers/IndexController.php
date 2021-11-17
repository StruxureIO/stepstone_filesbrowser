<?php

namespace humhub\modules\filesbrowser\controllers;

use Yii;
use yii\helpers\Url;
use yii\db\Query;
use humhub\components\Controller;
use humhub\modules\cfiles\models;

class IndexController extends Controller {
  
  //public $mFolders;
  public $parent_folder = 1;


  public function actionIndex(){
      
    $connection = Yii::$app->getDb();    
    $command = $connection->createCommand("SELECT id FROM cfiles_folder WHERE `parent_folder_id` is null order by id limit 0, 1");
    $folders = $command->queryOne();   
    
    return $this->render('index', ['root' => $folders['id']]);
  }

  public function actionExample(){
      return $this->render('example');
  }
  
  public function actionAjaxView(){
    
    $req = Yii::$app->request;

    $folder_id = $req->get('folder_id', '0');
           
    //$page = $req->get('page', "0");

      // used if pagaination needed    
//    $connection = Yii::$app->getDb();
//    $command = $connection->createCommand("SELECT (select COUNT(distinct f.id) from file as f left join cfiles_file as cf on (f.id = cf.id) where parent_folder_id = $folder_id) + 
//(select COUNT(distinct cff.id) from cfiles_folder as cff where parent_folder_id = $folder_id and title != 'Files from the stream') AS total");  
//    $count = $command->queryScalar();    
        
    $connection = Yii::$app->getDb();    
    $command = $connection->createCommand("(select f.id, file_name as title, size, created_at, 
updated_at, guid, hash_sha1, mime_type, 'b' as file_type from file as f 
left join cfiles_file as cf on (f.object_id = cf.id) 
where parent_folder_id = $folder_id and object_model like '%cfile%')
union
(select id, title, '', '', '', '', '', '', 'a' as file_type from cfiles_folder 
where parent_folder_id = $folder_id and title != 'Files from the stream') order by file_type, title");

    $folders = $command->queryAll();   
    
    //$offset = $page * MAX_FILE_ITEMS;
    //$total_number_pages = ceil($count / MAX_FILE_ITEMS);        
        
    return $this->renderPartial('_view', 
      ['folders' => $folders]);
    
  }
  
  public function actionAjaxSearch(){
    
    $req = Yii::$app->request;

    $search_text = $req->get('search_text', '');
    
    $connection = Yii::$app->getDb();
    $command = $connection->createCommand("select f.id, file_name as title, size, created_at, 
updated_at, guid, mime_type, 'b' as file_type  from file as f 
left join cfiles_file as cf on (f.id = cf.id) 
where file_name like '%$search_text%' group by id order by file_type, title");
      
    $folders = $command->queryAll();       
        
    return $this->renderPartial('_view', 
      ['folders' => $folders]);
      
    die();
    
    
  }
  
}

