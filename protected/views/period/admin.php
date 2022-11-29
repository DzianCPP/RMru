<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Периоды',
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Period', 'url'=>array('index')),
	array('label'=>'Создать Период', 'url'=>array('create')),
);

?>

<h1>Управление Периодами</h1>

<p>
    Вы можете вводить символы сравнения(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) в начале каждого численного поля поиска, для уточнения результатов.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'period-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'date',
		//'bus.name',
		array(
			'header' => 'Название автобуса',
			'name'=>'bus_id',
			'value' => '$data->bus->name." По маршруту: ".$data->bus->route ' ,
			'type' => 'text',
			'filter'=> CHtml::activeDropDownList($model,'bus_id',Buses::getBuses(),array('empty'=>'')),
			),

		array(
			'header' => 'Направление', 
			'value' =>'$data->transit_type_name',
				
            'filter'=>CHtml::dropDownList('Period[transit_type]', $model->transit_type, Transittype::getShortListOptions(), array('empty'=>'')),
			//'filter' => CHtml::dropDownList('transit_type',false , Transittype::getShortListOptions())

			),
		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
		),
	),
)); ?>
