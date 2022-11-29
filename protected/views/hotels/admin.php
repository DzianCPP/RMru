<?php
/* @var $this HotelsController */
/* @var $model Hotels */

$this->breadcrumbs=array(
	'Гостиница',
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Hotels', 'url'=>array('index')),
	array('label'=>'Создать Гостиницу', 'url'=>array('create')),
);

?>

<h1>Управление Гостиницами</h1>
<p>
    Вы можете вводить символы сравнения(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) в начале каждого численного поля поиска, для уточнения результатов.
</p>

<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'hotels-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
        array(
            'header'=> $model->getAttributeLabel('resorts_id'),
            'filter'=> CHtml::dropDownList('Hotels[resorts_id]', $model->resorts_id, Resorts::getOptions(), array('empty'=>'')),
            'value'=>'$data->resorts->name',
        ),
	//	'resorts_id',
		'address_of_hotel',
		'area',
		'beatch',
		/*
		'body',
		'number',
		'water',
		'food',
		'features',
		'description',
		'is_active',
		*/
		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
		),
	),
)); ?>
