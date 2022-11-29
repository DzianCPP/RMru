<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	'Страны',
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Countries', 'url'=>array('index')),
	array('label'=>'Создать страну', 'url'=>array('create')),
);?>

<h1>Управление Странами</h1>

<p>
Вы можете вводить символы сравнения(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале каждого численного поля поиска, для уточнения результатов.
</p>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'countries-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		//'is_active',
		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
		     'deleteConfirmation'=>'Вы уверены? Удаление данного элемента повлечет удаление всех дочерних курортов и отелей.'
		),
	),
)); ?>
