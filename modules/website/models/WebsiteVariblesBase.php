<?php

namespace app\modules\website\models;

use Yii;
use app\modules\template\models\TemplateVaribles;

/**
 * This is the model class for table "website_varibles".
 *
 * @property int $id
 * @property int $id_website
 * @property int $id_templage_varible
 * @property string|null $value
 *
 * @property TemplateVaribles $templageVarible
 * @property Website $website
 */
class WebsiteVariblesBase extends \app\models\WebsiteVaribles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_website', 'id_templage_varible'], 'required'],
            [['id_website', 'id_templage_varible'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['id_website'], 'exist', 'skipOnError' => true, 'targetClass' => Website::class, 'targetAttribute' => ['id_website' => 'id']],
            [['id_templage_varible'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateVaribles::class, 'targetAttribute' => ['id_templage_varible' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_website' => 'Id Website',
            'id_templage_varible' => 'Id Templage Varible',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[TemplageVarible]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplageVarible()
    {
        return $this->hasOne(TemplateVaribles::class, ['id' => 'id_templage_varible']);
    }

    /**
     * Gets query for [[Website]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWebsite()
    {
        return $this->hasOne(Website::class, ['id' => 'id_website']);
    }
}
