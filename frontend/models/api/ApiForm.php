<?php

namespace frontend\models\api;

use Yii;
use yii\helpers\ArrayHelper;

use common\models\Api;
use common\models\Attribute;

/**
 * @inheritdoc
 */
class ApiForm extends Api
{
    public $attributeIds;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['attributeIds'], 'default', 'value' => []],
            [['attributeIds'], 'exist',
                'allowArray' => true,
                'skipOnError' => true,
                'targetClass' => Attribute::className(),
                'targetAttribute' => 'id',
            ],
        ]);
    }
    
    public function saveApiForm()
    {
        self::getDb()->transaction(function($db) {
            if ($this->save()) {
                foreach ($this->attributes0 as $attribute) {
                    if (!in_array($attribute->id, $this->attributeIds)) {
                        $this->unlink('attributes0', $attribute, true);
                    }
                }
                
                $addAttrIds = ArrayHelper::getColumn($this->attributes0, 'id');
                $addAttrIds = array_diff($this->attributeIds, $addAttrIds);
                
                foreach ($addAttrIds as $addAttrId) {
                    $attribute = Attribute::findOne(['id' => $addAttrId]);
                    
                    if ($attribute) {
                        $this->link('attributes0', $attribute);
                    }
                }
            }
        });
        
        return !$this->hasErrors();
    }
}
