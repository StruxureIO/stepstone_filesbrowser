<?php

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
                        <strong>Marketing Material for Recruit</strong> Files
                    </div>

                    <div class="col-md-6 heading-search">
                        <div class="form-group-search">
                            <input type="text" class="form-control form-search" name="keyword" value=""
                                placeholder="search files">
                            <button type="submit" class="btn btn-default btn-sm form-button-search">Search</button>
                        </div>
                    </div>

                </div>



                <div id="cfiles-folderView">

                    <div class="panel panel-default">
                        <div class="panel-head">
                            <ol id="cfiles-crumb" class="breadcrumb">
                                <li>
                                    <a href="#"><i class="far fa-arrow-left" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-home fa-lg fa-fw"></i> </a>
                                </li>
                                <li>
                                    <a href="#"> Recruiting </a>
                                </li>
                                <li>
                                    <a href="#"> Marketing Material for Recruit </a>
                                </li>
                            </ol>
                        </div>
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

                                <tbody>
                                    <tr >
                                        <td class="text-left">
                                            <div class="title" style="position:relative">
                                                <i class="fa fa-file-pdf-o"></i>&nbsp;
                                                <a class="tt" href="#">REQUESTING SPONSORSHIP 3.2019</a> </div>
                                        </td>

                                        <td class="hidden-xs text-right">
                                            <div class="size pull-right">66.6 kB </div>
                                        </td>

                                        <td class="hidden-xxs text-right">
                                            <div class="timestamp pull-right">
                                                <time class="tt time timeago">Jun 19, 2021</time> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="text-left">
                                            <div class="title" style="position:relative">
                                                <i class="fa fa-file-pdf-o"></i>&nbsp;
                                                <a class="tt" href="#">NEW Story of the Black Sheep</a> </div>
                                        </td>

                                        <td class="hidden-xs text-right">
                                            <div class="size pull-right">698.0 kB </div>
                                        </td>

                                        <td class="hidden-xxs text-right">
                                            <div class="timestamp pull-right">
                                                <time class="tt time timeago">Jun 19, 2021</time> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="text-left">
                                            <div class="title" style="position:relative">
                                                <i class="fa fa-file-pdf-o"></i>&nbsp;
                                                <a class="tt" href="#">NEW Myths</a> </div>
                                        </td>

                                        <td class="hidden-xs text-right">
                                            <div class="size pull-right">252.4 kB </div>
                                        </td>

                                        <td class="hidden-xxs text-right">
                                            <div class="timestamp pull-right">
                                                <time class="tt time timeago">Jun 19, 2021</time> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="text-left">
                                            <div class="title" style="position:relative">
                                                <i class="fa fa-file-pdf-o"></i>&nbsp;
                                                <a class="tt" href="#">NEW Join Us</a> </div>
                                        </td>

                                        <td class="hidden-xs text-right">
                                            <div class="size pull-right">367.7 kB </div>
                                        </td>

                                        <td class="hidden-xxs text-right">
                                            <div class="timestamp pull-right">
                                                <time class="tt time timeago">Jun 19, 2021</time> 
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
