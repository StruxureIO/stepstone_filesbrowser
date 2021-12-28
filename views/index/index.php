<?php
use yii\helpers\Url;

/* @var $this \humhub\modules\ui\view\components\View */

use humhub\modules\filesbrowser\assets\Assets;
use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
Assets::register($this);

//$displayName = (Yii::$app->user->isGuest) ? Yii::t('FilesbrowserModule.base', 'Guest') : Yii::$app->user->getIdentity()->displayName;

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
              <input id="fb-search-text" type="text" class="form-control form-search" name="keyword" value="" placeholder="search files">
              <button id="fb-search-button" type="submit" class="btn btn-default btn-sm form-button-search">Search</button>
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
                    <a id="home-icon" class="fbrowser-folder" data-id="<?php echo $root ?>" ><i class="fa fa-home fa-lg fa-fw"></i> </a>
                  </li>
                </ol>
                <!--<p><input type="text" id="current-folder" value="1" ></p>-->
                <!--<p><input type="text" id="previous-folder" value="1" ></p>-->
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
                      <th class="hidden-xs text-right" data-ui-sort="favorite">Favorite</th>
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
$ajax_favorite = yii\helpers\Url::to(['ajax-favorite']);
$ajax_view = yii\helpers\Url::to(['ajax-view']);
$ajax_search = yii\helpers\Url::to(['ajax-search']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;
$this->registerJs("
  
  load_latest_vidoes($root, '', '');
  
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
          var cfiles_crumb = $('ol#cfiles-crumb').html();
          var breadcrumb_link = '<li><a class=\"folder-link\" data-id=\"'+ folder_id +'\"> ' + folder_name + ' </a></li>';
          $('ol#cfiles-crumb').html(cfiles_crumb + breadcrumb_link);
        }
      }
    });
  }
  
  $(document).on('click', '.title-link', function (e) {
    e.stopImmediatePropagation();
    var folder_id  = $(this).attr('data-id');
    var folder_name  = $(this).text();       
    
    load_latest_vidoes(folder_id, '+', folder_name);
  });
  
  $(document).on('click', '.folder-link, .fbrowser-folder', function (e) {
    e.stopImmediatePropagation();
    $('#fb-search-text').val('');
    var folder_id = $(this).attr('data-id');   
    remove_breadcrumbs(folder_id);
    load_latest_vidoes(folder_id, '-', '');    
  });
  
  function remove_breadcrumbs(folder_id) {  
    var count = 0;
    var last_folder = $('#cfiles-crumb li:last a').attr('data-id');
    while (folder_id != last_folder) {
      $('#cfiles-crumb li:last').remove();
      last_folder = $('#cfiles-crumb li:last a').attr('data-id');
      count++
      // prevent endless loop
      if(count > 10)
        break;
    }  
  }

  $(document).on('click', '#step-files-back', function (e) {
    e.stopImmediatePropagation();
    var previous_folder  = $('ol#cfiles-crumb li:nth-last-child(2) a').attr('data-id');
    if(previous_folder != 'undefined' && previous_folder != undefined) {
      remove_breadcrumbs(previous_folder);
      load_latest_vidoes(previous_folder, '-', '');        
    }
  });

  $('#fb-search-text').on('keypress', function(e) {    
    e.stopImmediatePropagation();
    if(e.which == 13) {
      fb_file_search();
    }
  });

  $(document).on('click', '#fb-search-button', function (e) {
    fb_file_search();
  });
  
  function fb_file_search() {
  
    var search_text = $('#fb-search-text').val();
    
    if(search_text != '') {
    
      $('#ajaxloader').show();
      $.ajax({
        'type' : 'GET',
        'url' : '$ajax_search',
        'dataType' : 'json',
        'data' : {
          '$csrf_param' : '$csrf_token',
          'search_text' : search_text
        },
        'success' : function(data){
          $('#ajaxloader').hide();
          $('#folder-contents').html(data.html);
        }
      });
    
    }  
  }
   
  $(document).on('click', '.step-favorite', function (e) {
    e.stopImmediatePropagation();
    var favorite_icon = $(this).find('svg.svg-inline--fa.fa-star')
    //console.log('favorite_icon',favorite_icon);
    var user_id = $(this).attr('data-user');
    var file_id  = $(this).attr('file-id');
    if( $(favorite_icon).hasClass('checked') ) {
      $(favorite_icon).removeClass('checked');
      update_favorite(user_id, file_id, false);
    } else {
      $(favorite_icon).addClass('checked');
      update_favorite(user_id, file_id, true);
    }  
  });

  function update_favorite(user_id, file_id, status) {
    console.log('user_id',user_id,'file_id',file_id,'status',status);
    $('#ajaxloader').show();
    $.ajax({
      'type' : 'GET',
      'url' : '$ajax_favorite',
      'dataType' : 'html',
      'data' : {
        '$csrf_param' : '$csrf_token',
        'user_id' : user_id,
        'file_id' : file_id,
        'status' : status
      },
      'success' : function(data){
        $('#ajaxloader').hide();
      }
    });  
  }
  
   
");
?>

