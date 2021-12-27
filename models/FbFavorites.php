<?php

namespace humhub\modules\filesbrowser\models;

use Yii;

/**
 * This is the model class for table "fb_favorites".
 *
 * @property int $fav_id
 * @property int|null $user_id
 * @property int|null $file_id
 */
class FbFavorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fb_favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fav_id'], 'required'],
            [['fav_id', 'user_id', 'file_id'], 'integer'],
            [['fav_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fav_id' => 'Fav ID',
            'user_id' => 'User ID',
            'file_id' => 'File ID',
        ];
    }
}
