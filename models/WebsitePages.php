<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "website_pages".
 *
 * @property int $id
 * @property int $id_website
 * @property int $id_templage_page
 *
 * @property TemplatePages $templagePage
 * @property Website $website
 */
class WebsitePages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'website_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_website', 'id_templage_page'], 'required'],
            [['id_website', 'id_templage_page'], 'integer'],
            [['id_templage_page'], 'exist', 'skipOnError' => true, 'targetClass' => TemplatePages::class, 'targetAttribute' => ['id_templage_page' => 'id']],
            [['id_website'], 'exist', 'skipOnError' => true, 'targetClass' => Website::class, 'targetAttribute' => ['id_website' => 'id']],
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
            'id_templage_page' => 'Id Templage Page',
        ];
    }

    /**
     * Gets query for [[TemplagePage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplagePage()
    {
        return $this->hasOne(TemplatePages::class, ['id' => 'id_templage_page']);
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
