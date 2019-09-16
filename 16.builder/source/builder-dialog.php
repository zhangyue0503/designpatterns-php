<?php

class Dialog
{
    private $attributes = [];
    private $buttons = [];
    private $title = '';
    private $content = '';

    public function AddAttributes($attr)
    {
        $this->attributes[] = $attr;
    }
    public function AddButtons($button)
    {
        $this->buttons[] = $button;
    }
    public function SetTitle($title)
    {
        $this->title = $title;
    }
    public function SetContent($content)
    {
        $this->content = $content;
    }

    public function ShowDialog(){
        echo PHP_EOL, '显示提示框 === ', PHP_EOL;
        echo '标题：' . $this->title, PHP_EOL;
        echo '内容：' . $this->content, PHP_EOL;
        echo '样式：' . implode(',', $this->attributes), PHP_EOL;
        echo '按扭：' . implode(',', $this->buttons), PHP_EOL;
    }
}

interface Builder
{
    public function BuildAttribute($attr);
    public function BuildButton($button);
    public function BuildTitle($title);
    public function BuildContent($content);
    public function GetDialog();
}

class DialogBuilder implements Builder{
    private $dialog;
    public function __construct(){
        $this->dialog = new Dialog();
    }
    public function BuildAttribute($attr){
        $this->dialog->AddAttributes($attr);
    }
    public function BuildButton($button){
        $this->dialog->AddButtons($button);
    }
    public function BuildTitle($title){
        $this->dialog->SetTitle($title);
    }
    public function BuildContent($content){
        $this->dialog->SetContent($content);
    }
    public function GetDialog(){
        return $this->dialog;
    }
}

class DialogDirector {
    public function Construct($title, $content){

        $builder = new DialogBuilder();

        $builder->BuildAttribute('置于顶层');
        $builder->BuildAttribute('居中显示');

        $builder->BuildButton('确认');
        $builder->BuildButton('取消');

        $builder->BuildTitle($title);
        $builder->BuildContent($content);
        
        return $builder;
    }
}

class ModalDialogDirector {
    public function Construct($title, $content){

        $builder = new DialogBuilder();

        $builder->BuildAttribute('置于顶层');
        $builder->BuildAttribute('居中显示');
        $builder->BuildAttribute('背景庶照');
        $builder->BuildAttribute('外部无法点击');

        $builder->BuildButton('确认');
        $builder->BuildButton('取消');

        $builder->BuildTitle($title);
        $builder->BuildContent($content);
        
        return $builder;
    }
}

$d1 = new DialogDirector();
$d1->Construct('窗口1', '确认要执行操作A吗？')->GetDialog()->ShowDialog();

$d2 = new ModalDialogDirector();
$d2->Construct('窗口2', '确认要执行操作B吗？')->GetDialog()->ShowDialog();