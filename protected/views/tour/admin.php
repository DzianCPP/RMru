<?php
/* @var $this TourController */
/* @var $model Tour */





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

<h1>Поиск туров</h1>
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
   'sortable'  => true,
  ),*/
  array(
   'header'=>$labels['manager_id'],
   'value'=>'$data->managers->name',
   'name'=> 'manager_id',
   'sortable'  => true,
            'filter' => CHtml::activeDropDownList($model, 'manager_id',Managers::getOptions(), array('empty'=>'') ),
  ),
  array(
   'class'=>'CCheckBoxColumn',
   'header'=>$labels['is_only_transit'],
   'checked'=>'$data->is_only_transit',
   'selectableRows'=>0,
   'name'=> 'is_only_transit',
   //'filter'=> CHtml::activeCheckBox($model, 'is_only_transit'),
  ),
  array(
   'header'  => $labels['hotel_id'],  
   'value'  => '$data->is_only_transit? "": $data->hotel->name',
   'name'=> 'hotel_id',
   'sortable'  => true,
            'filter' => CHtml::activeDropDownList($model, 'hotel_id',Hotels::getOptions(), array('empty'=>'') ),
  ),
  array(
   'header'=>$labels['transit'],
   'value'=>'$data->transit_name',
   'name'=> 'transit',
   'sortable'  => true,
            'filter' => CHtml::activeDropDownList($model, 'transit', Transittype::getOptions(), array('empty'=>'')),
  ),
  array(
   'header'=>$labels['period_id'],
   'value'=> '$data->transit == Transittype::THERE || $data->transit == Transittype::TWO_SIDE ? $data->period->date:""',
   'name'=> 'period_id',
   'sortable'  => true,
            'filter' => CHtml::activeDropDownList($model, 'period_id', Period::getOptions($_GET['Tour']['bus']), array('empty'=>'')),
  ),
  array(
   'header'=>$labels['period_back_id'],
   'value'=> '($data->transit == Transittype::BACK || $data->transit == Transittype::TWO_SIDE) ? $data->period_back->date : ""',
   'name'=> 'period_back_id',
   'sortable'  => true,
            'filter' => CHtml::activeDropDownList($model, 'period_back_id', Period::getBackOptions($_GET['Tour']['bus_back']), array('empty'=>'')),
  ),
  array(
   'header'=> $labels['begin_date'],
   'value'=> '($data->transit == Transittype::NO_TRANSIT) ? $data->begin_date:""',
    
   'name'=> 'begin_date',
   'sortable'  => true,
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
   'sortable'  => true,
            'filter' => CHtml::activeDropDownList($model, 'bus', Buses::getOptions(), array('empty'=>'')),
  ),
  array(
            'header'=>$labels['bus_back'],
            'value'=>'$data->buses_back->name',
            'name'=> 'bus_back',
            'sortable'  => true,
            'filter' => CHtml::activeDropDownList($model, 'bus_back', Buses::getOptions(), array('empty'=>'')),
        ),

  array(
   'header' => $labels['owner_name'],
   'value'  => '$data->owner_name',
   'name'  => 'owner_name',
   'sortable'  => true,
            //'filter' => false,
  ),
  array(
   'header'  => 'Всего человек',
   'value'  => '$data->getCountPiple()',
   'sortable'  => true,
            //'filter' => false,
  ),
  array(
   'header'  =>  $labels['total_travel_service'], 
   'value'  => '$data->total_travel_service',
   'headerHtmlOptions' =>  array(
    'width' => '20px', 
   ),
   'name'  => 'total_travel_service',
   'sortable'  => true,
            //'filter' => false,
  ),
  array(
   'header'  =>  $labels['total_travel_cost'], 
   'value'  => '$data->total_travel_cost',
   'headerHtmlOptions' =>  array(
    'width' => '20px', 
   ),
   'name'  => 'total_travel_cost',
   'sortable'  => true,

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