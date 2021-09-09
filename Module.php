<?php

namespace humhub\modules\filesbrowser;

use yii\helpers\Url;

define('MAX_FILE_ITEMS', 20);


class Module extends \humhub\components\Module
{
    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';    
    
    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/filesbrowser/admin']);
    }

    /**
     * @inheritdoc
     *
     * @return void
     */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }
    
            
}
