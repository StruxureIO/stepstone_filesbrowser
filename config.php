<?php

use humhub\modules\filesbrowser\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\widgets\TopMenu;

return [
    'id' => 'filesbrowser',
    'class' => 'humhub\modules\filesbrowser\Module',
    'namespace' => 'humhub\modules\filesbrowser',
    'events' => [
        [TopMenu::class, TopMenu::EVENT_INIT, [Events::class, 'onTopMenuInit']],
        [AdminMenu::class, AdminMenu::EVENT_INIT, [Events::class, 'onAdminMenuInit']]
    ],
];
