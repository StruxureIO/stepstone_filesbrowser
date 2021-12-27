<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fb_favorites}}`.
 */
class m211222_200901_create_fb_favorites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->createTable('fb_favorites', [
          'fav_id' => 'pk',
          'user_id' => 'bigint(20) NOT NULL',
          'file_id' => 'int(11) NOT NULL',
        ], '');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fb_favorites}}');
    }
}
