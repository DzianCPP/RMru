<?php
/* @var $this TourController */
/* @var $model Tour */

$this->breadcrumbs=array(
	'Главная',
	
	);

$this->menu=array(
	//array('label'=>'List Tour', 'url'=>array('index')),
	array('label'=>'Добавить(создать)', 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tour-grid', {
		data: $(this).serialize()
	});
return false;
});
");
?>

<h1>Главная</h1>
<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Действия',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
<!-- <p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div> --><!-- search-form -->

<?php 
$labels = $model->attributeLabels();
$l_transit = Transittype::getOptions();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tour-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'enableSorting'=>true,
	
	'selectableRows'=>0,

	'columns'=>array(
		/*array(
			'header'=>$labels['id'],
			'headerHtmlOptions'=>array(
				'width' => '30px',
				),
			'name'=> 'id',
			'value'=>'$data->id',
			'sortable' 	=> true,
		),*/
		
		array(
			'header' 	=> $labels['hotel_id'],  
			'value'		=> function($data){
				if($data->is_only_transit){
					return '';
				}else{
					return $data->hotel->name;
				}
			},
			'name'=> 'hotel_id',
			'sortable' 	=> true,
            'filter' => CHtml::activeDropDownList($model, 'hotel_id',Hotels::getOptions(), array('empty'=>'') ),
		),
		array(
			'header'=>$labels['transit'],
			'value'=>function($data, $row) use ($l_transit){
				return $l_transit[$data->transit];
			},
			'name'=> 'transit',
			'sortable' 	=> true,
            'filter' => CHtml::activeDropDownList($model, 'transit', Transittype::getOptions(), array('empty'=>'')),
		),
		array(
			'header'=>$labels['period_id'],
			'value'=> function($data){
				if($data->transit == Transittype::THERE or $data->transit == Transittype::TWO_SIDE){
					return $data->period->date;	
				}else{
					return "";
				}
			},
			'name'=> 'period_id',
			'sortable' 	=> true,
            'filter' => CHtml::activeDropDownList($model, 'period_id', Period::getOptions(), array('empty'=>'')),
		),
		array(
			'header'=>$labels['period_back_id'],
			'value'=> function($data){
				if($data->transit == Transittype::BACK or $data->transit == Transittype::TWO_SIDE){
					return $data->period_back->date;	
				}else{
					return "";
				}
			},
			'name'=> 'period_back_id',
			'sortable' 	=> true,
            'filter' => CHtml::activeDropDownList($model, 'period_back_id', Period::getOptions(), array('empty'=>'')),
		),
		array(
			'header'=> $labels['begin_date'],
			'value'=> function($data){
                //return $data->begin_date;
				if($data->transit == Transittype::NO_TRANSIT){
					return $data->begin_date;	
				}else{
					return "";
				}
			},
			'name'=> 'begin_date',
			'sortable' 	=> true,
            'filter' => false,
            /*'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'none',
                    'dateFormat'=> "yy-mm-dd"
                ),
                'name'=>'begin_date',
                'attribute'=>'begin_date', // Model attribute filed which hold user input
                'model'=>$model,            // Model name
                'language'=>'ru',
                'value'=>date('Y-m-d'),
                'htmlOptions'=>array('size'=>15),

            )),*/
		),

		array(
			'header'=>$labels['bus'],
			'value'=>'$data->buses->name',
			'name'=> 'bus',
			'sortable' 	=> true,
            'filter' => CHtml::activeDropDownList($model, 'bus', Buses::getOptions(), array('empty'=>'')),
		),

		array(
			'header'	=> 'ФИО РЕГ',
			'value'		=> '$data->owner_name',
			'name'		=> 'owner_name',
			'sortable' 	=> true,
            //'filter' => false,
		),
		array(
			'header'	=> 'ФИО',
			'value'		=> '$data->tourists[0]->name',
			//'name'		=> 'tr.name',
			'sortable' 	=> true,
            //'filter' => false,
		),
		

		
		array(
			'class'=>'CButtonColumn',
			'template' => '{update}{delete}',
			'header' => 'Действия',
			'updateButtonLabel'=> 'Редактировать\\Просмотреть',
			'deleteButtonLabel'=> 'Удалить',
		),
	),
)); ?>
