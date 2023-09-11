<?php

namespace app\modules\template\models;

use Yii;
use app\modules\website\models\WebsiteBlocks;

/**
 * This is the model class for table "template_blocks".
 *
 * @property int $id
 * @property int $id_template
 * @property string $code
 * @property string $name
 * @property string $value
 * @property int|null $user_created
 * @property string|null $date_created
 *
 * @property Template $template
 * @property WebsiteBlocks[] $websiteBlocks
 */
class TemplateBlocksBase extends \app\models\TemplateBlocks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_template', 'code', 'name', 'value'], 'required'],
            [['id_template', 'user_created'], 'integer'],
            [['value'], 'string'],
            [['date_created'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255],
            [['id_template'], 'exist', 'skipOnError' => true, 'targetClass' => Template::class, 'targetAttribute' => ['id_template' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_template' => 'Id Template',
            'code' => 'Code',
            'name' => 'Name',
            'value' => 'Value',
            'user_created' => 'User Created',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[Template]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::class, ['id' => 'id_template']);
    }

    /**
     * Gets query for [[WebsiteBlocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWebsiteBlocks()
    {
        return $this->hasMany(WebsiteBlocks::class, ['id_template_block' => 'id']);
    }
}
