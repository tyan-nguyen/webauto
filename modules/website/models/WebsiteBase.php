<?php

namespace app\modules\website\models;

use Yii;
use app\modules\template\models\Template;

/**
 * This is the model class for table "website".
 *
 * @property int $id
 * @property int $id_template
 * @property int|null $user_created
 * @property int|null $datetime_created
 *
 * @property Template $template
 * @property WebsiteBlocks[] $websiteBlocks
 * @property WebsitePages[] $websitePages
 * @property WebsiteVaribles[] $websiteVaribles
 */
class WebsiteBase extends \app\models\Website
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_template'], 'required'],
            [['id_template', 'user_created', 'datetime_created'], 'integer'],
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
            'user_created' => 'User Created',
            'datetime_created' => 'Date Created',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->datetime_created = date('Y-m-d H:i:s');
            $this->user_created = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function afterSave( $insert, $changedAttributes ){
        foreach ($this->template->templatePages as $page){
            $websitePage = new WebsitePages();
            $websitePage->id_website = $this->id;
            $websitePage->id_templage_page = $page->id;
            $websitePage->save();
        }
        parent::afterSave($insert, $changedAttributes);
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
        return $this->hasMany(WebsiteBlocks::class, ['id_website' => 'id']);
    }

    /**
     * Gets query for [[WebsitePages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWebsitePages()
    {
        return $this->hasMany(WebsitePages::class, ['id_website' => 'id']);
    }

    /**
     * Gets query for [[WebsiteVaribles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWebsiteVaribles()
    {
        return $this->hasMany(WebsiteVaribles::class, ['id_website' => 'id']);
    }
}
