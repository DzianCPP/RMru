<?php
/* @var $this ManagersController */
/* @var $model Managers */

$this->breadcrumbs=array(
	'Менеджеры'=>array('admin'),
	'Управление',
);

$this->menu=array(
	/*array('label'=>'Список Менеджеров', 'url'=>array('index')),*/
	array('label'=>'Создать Менеджера', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('managers-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Менеджерами</h1>

<p>
Можно ввести оператор сравнения(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) в начале каждого из значений списка, чтобы уточнить поиск.
</p>

<?php //echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'managers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
		),
	),
)); ?>
