<?php
use yii\helpers\Url;

/* @var $this \humhub\modules\ui\view\components\View */

use humhub\modules\filesbrowser\assets\Assets;
use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
Assets::register($this);

$displayName = (Yii::$app->user->isGuest) ? Yii::t('FilesbrowserModule.base', 'Guest') : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("filesbrowser", [
  'username' => (Yii::$app->user->isGuest) ? $displayName : Yii::$app->user->getIdentity()->username,
  'text' => [
      'hello' => Yii::t('FilesbrowserModule.base', 'Hi there {name}!', ["name" => $displayName])
  ]
])
?>
<div id="layout-content">
  <div class="container">

    <div id="cfiles-container" class="panel panel-default cfiles-content">

      <div class="panel-body">

        <div class=row>

          <div class="col-md-6 panel-heading">
            <strong>Files</strong>
          </div>

          <div class="col-md-6 heading-search">
            <div class="form-group-search">
              <input type="text" class="form-control form-search" name="keyword" value="" placeholder="search files">
              <button type="submit" class="btn btn-default btn-sm form-button-search">Search</button>
            </div>
          </div>

        </div>


          <div id="cfiles-folderView">

            <div class="panel panel-default">
              <div class="panel-head">
                <ol id="cfiles-crumb" class="breadcrumb">
                  <li>
                    <a id="step-files-back"><i class="far fa-arrow-left" aria-hidden="true"></i></a>
                  </li>
                  <li>
                    <a class="fbrowser-folder" data-id="1" ><i class="fa fa-home fa-lg fa-fw"></i> </a>
                  </li>
<!--                  <li>
                    <a href="#"> Recruiting </a>
                  </li>
                  <li>
                    <a href="#"> Marketing Material for Recruit </a>
                  </li>-->
                </ol>
                <input type="hidden" id="folder-list" value="">
                <input type="hidden" id="folder-id-list" value="">
                <input type="hidden" id="current-folder-id" value="">
              </div>
            </div>
            
            <div id="alwrap">
              <div id="ajaxloader"></div>
            </div>                  

            <div id="fileList">
              <div class="table-responsive">
                <table id="bs-table" class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-left" data-ui-sort="name" data-ui-order="DESC"> Name </th>
                      <th class="hidden-xs text-right" data-ui-sort="size">Size</th>
                      <th class="hidden-xxs text-right" data-ui-sort="updated_at">Updated</th>
                    </tr>
                  </thead>
                  
                  <tbody id="folder-contents"></tbody>                  
                  
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
$ajax_view = yii\helpers\Url::to(['ajax-view']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;
$this->registerJs("
  
  load_latest_vidoes(1, '' '');
  
  function load_latest_vidoes(folder_id, operation, folder_name) {
    $('#ajaxloader').show();
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_view',
      'dataType' : 'json',
      'data' : {
        '$csrf_param' : '$csrf_token',
        'folder_id' : folder_id
      },
      'success' : function(data){
        $('#ajaxloader').hide();
        $('#folder-contents').html(data.html);
        if(operation == '+') {
          var breadcrumb_link = '<li><a data_id=\"folder_id\"> ' + folder_name + ' </a></li>';
          $('ol#cfiles-crumb').html(breadcrumb_link);
        }

      }
    });
  }
  
  $(document).on('click', '.title-link', function (e) {
    e.stopImmediatePropagation();
    var folder_id = $(this).attr('data-id');   
    var folder_name = $(this).text();       
    load_latest_vidoes(folder_id, '+', folder_name);
  });
  

  $(document).on('click', '#step-files-back', function (e) {
    //history.back();
  });
  

  $(document).on('click', '.fbrowser-folder', function (e) {
    e.stopImmediatePropagation();
    var folder_id = $(this).attr('data-id');   
    //if(folder_id == '1') {
    //  var folder_name = '';       
    //} else {
    //  var folder_name = $(this).text();       
    //}  
    load_latest_vidoes(folder_id, '-', '');
  });
  
  function add_folder_breadcrumb(folder_name, folder_id) {
  
  }
  
  function pop_folder_breadcrumb() {
  
  }
  
");
?>

