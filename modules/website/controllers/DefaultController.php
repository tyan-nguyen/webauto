<?php

namespace app\modules\website\controllers;

use yii\web\Controller;
use app\modules\website\models\Website;
use app\modules\website\models\WebsitePages;
use app\modules\template\models\TemplatePages;

/**
 * Default controller for the `website` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $website = Website::find()->all();
        return $this->render('index', compact('website'));
    }
    
    public function actionCreate(){
        $model = new Website();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        
        return $this->render('formWebsite', compact('model'));
    }
    
    public function actionView($id)
    {
        $model = Website::findOne($id);
        return $this->render('view', compact('model'));
    }
    
    public function actionDetail($id)
    {
        $webpage = WebsitePages::findOne($id);
        $page = TemplatePages::findOne($webpage->id_template_page);
        $model = Website::findOne($webpage->id_website);
        $varibles = $model->getVaribles();
        $blocks = $model->getBlocks();
        return $this->render($page->getFileRenderUrl(), compact('varibles', 'blocks'));
    }
}
