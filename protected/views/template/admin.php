<?php
/* @var $this TemplateController */
/* @var $model Template */

$this->breadcrumbs=array(
	'Шаблоны',
	'Управление',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('template-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Шаблонами</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'template-grid',
	'dataProvider'=>$model->search(),
	'filter'=>false,
	'columns'=>array(
		//'id',
		//'name',
		array(
            'header'=> 'Название',
            'value' => '$data->label',
        ),
		array(
			'class'=>'CButtonColumn',
            'template' => '{update}',
		),
	),
)); ?>
