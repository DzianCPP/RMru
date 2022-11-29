<?php
/* @var $this BusesController */
/* @var $model Buses */

$this->breadcrumbs=array(
	'Автобусы',
	'Управление',
);

$this->menu=array(
	/*array('label'=>'List Buses', 'url'=>array('index')),*/
	array('label'=>'Создать автобус', 'url'=>array('create')),
);

?>

<h1>Управление Автобусами</h1>

<p>
Вы можете вводить символы сравнения(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале каждого численного поля поиска, для уточнения результатов.
</p>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */?>
<!--<div class="search-form" style="display:none">
    <?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div>-->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'buses-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'route',
		'count_of_plases',
		
		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
		    'deleteConfirmation'=>'Вы уверены? Удаление данного элемента повлечет удаление всех периодов этого автобуса.'
		),
	),
)); ?>
