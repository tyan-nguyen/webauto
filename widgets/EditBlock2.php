<?php
namespace app\widgets;

use yii\base\Widget;
use kartik\editable\Editable;

class Editblock2 extends Widget{
    public $id;
    public $content;
    
    public function init(){
        parent::init();
    }
    
    public function run(){
        //return $this->value . '---------------edit';
        /* return Editable::widget([
            'name'=>'block',
            'asPopover' => true,
            'value' => $this->content,
            'header' => 'Name',
            'size'=>'lg',
            'placement'=>'bottom bottom-left',
            'inputType' => Editable::INPUT_TEXTAREA,
            'options' => [
                'class'=>'form-control abc', 
                'rows'=>10,
                //'onload'=>"setNote()"
            ],
            'formOptions' => ['action' => ['/website/web/edit-block?id=' . $this->id]],
            'pluginEvents' => [
              
            ]
        ]); */
        $html = $this->content;
        
        
        return $html;
    }
}
?>