<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "api".
 *
 * @property int $id
 * @property string $title
 * @property string $required_attribute
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ApiAttribute[] $apiAttributes
 * @property Attribute[] $attributes0
 */
class Api extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'required_attribute'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'required_attribute'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'required_attribute' => 'Required Attribute',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApiAttributes()
    {
        return $this->hasMany(ApiAttribute::className(), ['api_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('api_attribute', ['api_id' => 'id']);
    }
}
