<?php

namespace humhub\modules\filesbrowser\assets;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@filesbrowser/resources';

    /**
     * @inheritdoc
     */
    public $publishOptions = [
        // TIPP: Change forceCopy to true when testing your js in order to rebuild
        // this assets on every request (otherwise they will be cached)
        'forceCopy' => true
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/humhub.filesbrowser.js'
    ];
    public $css = [
        'css/humhub.filesbrowser.css'
    ];

}