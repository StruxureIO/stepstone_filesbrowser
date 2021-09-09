<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Filesbrowser</strong> <?= Yii::t('FilesbrowserModule.base', 'configuration') ?></div>

        <div class="panel-body">
          <?php if(defined('LOCALHOST')) { ?>
            <a href="/humhub/index.php?r=cfiles%2Fbrowse&cguid=178fdc90-6ef5-4b12-ba86-d66d2a018776">Click here to access the File Browser admin area.</a>
          <?php } else { ?>
            <a href="https://theblacksheephub.com/index.php?r=space%2Fspace&cguid=150a99b2-2f6b-4620-83ff-140a6662ce70">Click here to access the File Browser admin area.</a>
          <?php } ?>
        </div>
    </div>
</div>