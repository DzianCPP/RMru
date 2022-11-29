<?php
/* @var $this ResortsController */
/* @var $model Resorts */

$this->breadcrumbs=array(
	'Курорты',
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Resorts', 'url'=>array('index')),
	array('label'=>'Создать курорт', 'url'=>array('create')),
);

?>

<h1>Управление курортами</h1>

<p>
    Вы можете вводить символы сравнения(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) в начале каждого численного поля поиска, для уточнения результатов.
</p>


<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */?><!--
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div>--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'resorts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		//'country_id',
        array(
            'header'=> $model->getAttributeLabel('country_id'),
            'filter'=> CHtml::dropDownList('Resorts[country_id]',$model->country_id, Countries::getOptions(), array('empty'=>'') ),
            'value'=>'$data->country->name',

        ),
		//'is_active',
		array(
			'class'=>'CButtonColumn',
            'template' => '{update} {delete}',
		     'deleteConfirmation'=>'Вы уверены? Удаление данного элемента повлечет удаление всех отелей курорта.'
		),
	),
)); ?>
