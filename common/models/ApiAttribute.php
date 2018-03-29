<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "api_attribute".
 *
 * @property int $api_id
 * @property int $attribute_id
 * @property string $value
 * @property string $created_at
 *
 * @property Attribute $attribute0
 * @property Api $api
 */
class ApiAttribute extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_id', 'attribute_id'], 'required'],
            [['api_id', 'attribute_id'], 'integer'],
            [['string'], 'string', 'max' => 32],
            [['created_at'], 'safe'],
            [['api_id', 'attribute_id'], 'unique', 'targetAttribute' => ['api_id', 'attribute_id']],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['api_id'], 'exist', 'skipOnError' => true, 'targetClass' => Api::className(), 'targetAttribute' => ['api_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'api_id' => 'Api ID',
            'attribute_id' => 'Attribute ID',
            'created_at' => 'Created At',
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApi()
    {
        return $this->hasOne(Api::className(), ['id' => 'api_id']);
    }
}
