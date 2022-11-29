<?php
/* @var $this BusesController */
/* @var $model ListTourist */

$this->breadcrumbs=array(
	'Buses'=>array('index'),
	'Список пасссажиров',
);



?>

<h1>Сформировать список</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ListTourist',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('target'=>'_self'),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_id'); ?>
		<?php echo $form->dropDownList($model,'bus_id', Buses::getOptions()); ?>
		<?php echo $form->error($model,'bus_id'); ?>
	</div>
<div class="row">
        <?php echo $form->labelEx($model,'transit_type'); ?>
        <?php echo $form->dropDownList($model,'transit_type', Transittype::getShortListOptions()); ?>
        <?php echo $form->error($model,'transit_type'); ?>
    </div>
        <?php echo CHtml::dropDownList('date_start',date('m',strtotime(Period::model()->findByPk($model->period_id)->date)), array('01'=>'январь','02'=>'февраль','03'=>'март','04'=>'апрель','05'=>'май','06'=>'июнь','07'=>'июль','08'=>'август','09'=>'сентябрь',10=>'октябрь',11=>'ноябрь',12=>'декабрь'),array('class'=>'there','empty'=>'')); ?>
  
   	<div class="row there"  id="there_transit" style="display:<?php echo (is_null($model->transit_type) or $model->transit_type == Transittype::THERE )?'block':'none' ?>">
		<?php echo $form->labelEx($model,'period_id'); ?>
	   	<?php echo $form->dropDownList($model,'period_id', Period::getOptions(),array('class'=>'period_change valid')); ?>
		<?php echo $form->error($model,'period_id'); ?>
	</div> 
	   <?php echo CHtml::dropDownList('date_to',date('m',strtotime(Period::model()->findByPk($model->period_back_id)->date)), array('01'=>'январь','02'=>'февраль','03'=>'март','04'=>'апрель','05'=>'май','06'=>'июнь','07'=>'июль','08'=>'август','09'=>'сентябрь',10=>'октябрь',11=>'ноябрь',12=>'декабрь',),array('class'=>'back', 'style'=>'display:none;','empty'=>'')); ?>
      
	<div class="row back" id="back_transit" style="display:<?php echo ($model->transit_type == Transittype::BACK /*or $model->transit_type == Transittype::TWO_SIDE*/)?'block':'none' ?>">
		<?php echo $form->labelEx($model,'period_back_id'); ?>
		<?php echo $form->dropDownList($model,'period_back_id', Period::getBackOptions(),array('class'=>'period_change valid')); ?>
		<?php echo $form->error($model,'period_back_id'); ?>
	</div>
	
	
<div class="row" id="div_plased">
							   
								<label>Свободно мест</label>
								<div><label>туда:</label> <span id="plased_there"></span></div>
								<div><label>обратно:</label> <span id="plased_back"></span> </div>
							</div>
	<div class="row buttons">
		<button type="submit" class="but" disabled="disabled" name="action" value="search" onclick="$('form').attr('target','_self'); return true;"> Поиск</button>
		<button type="submit" class="but" disabled="disabled" name="action" value="print" onclick="$('form').attr('target','_blank'); return true;"> Печать</button>
		

		<?php //echo CHtml::submitButton('Печать списка'); ?>
	</div>
<script>
<?php if(!$_POST){ ?>
    $(document).ready(function(){$('#ListTourist_bus_id').change();});
    <?php } else { ?>
          $(document).ready(function(){
            
              $('#ListTourist_bus_id').change()
			  $('#ListTourist_transit_type').change();
                $('.period_change').change();
        if($('#ListTourist_period_id').val()||$('#ListTourist_period_back_id').val())
                $('.but').attr('disabled',false);
                else{
                     $('.but').attr('disabled',true);
                }
             });
        
        
       <?php } ?>
$('#ListTourist_bus_id').change(function(){

        /*
         * url запроса регионов
         */
         var url = 'index.php?r=tour/getbusperiodsfbus';

         var params ="";
         params += "bus_id=" + $('#ListTourist_bus_id option:selected').val();

         var transit_type =  $('#ListTourist_transit_type option:selected').val();
         params += "&transit_type=1";
           var date_start =  $('#date_start option:selected').val();
         params += "&date_start=" + date_start;
     var date_to =  $('#date_to option:selected').val();
         params += "&date_to=" + date_to;
         params += "&period_id=" + $('#ListTourist_period_id option:selected').val();
         params += "&period_back_id=" + $('#ListTourist_period_back_id option:selected').val();
         $.get(
            url,
            params,
            function (result) {
                if (result.type == 'error') {
                     alert('error');
                     return(false);
                 }
                
		if (typeof result.opt != 'undefined'){
                    $('#there_transit').html(result.opt);
                }
               	if (typeof result.backopt != 'undefined'){
					$('#back_transit').html(result.backopt);
                }
                // $('#getplace').click();
                 if($('#ListTourist_period_id').val()||$('#ListTourist_period_back_id').val())
                $('.but').attr('disabled',false);
                else{
                     $('.but').attr('disabled',true);
                }
             },
             "json"
             );
             
            
         });
	 
	 
	 $('#date_start').live('change',function(){$('#ListTourist_bus_id').change();});
    $('#date_to').live('change',function(){$('#ListTourist_bus_id').change();});
	  $('#getplace').click(function(){

        /*
         * url запроса регионов
         */
         var url = 'index.php?r=tour/getbusplaces';

         var params ="";
         params += "bus_id=" + $('#ListTourist_bus_id option:selected').val();

         var transit_type =  $('#ListTourist_transit_type option:selected').val();
         params += "&transit_type=" + transit_type;

         if(transit_type == "<?php echo Transittype::THERE ?>"){
            params += "&period_id=" + $('#ListTourist_period_id option:selected').val();
            $('#plased_there').html('Загрузка.....');
            $('#plased_there').closest('div').show();
         }else{
            $('#plased_there').closest('div').hide();
         }
         if (transit_type == "<?php echo Transittype::BACK ?>") {
            params += "&period_id=" + $('#ListTourist_period_back_id option:selected').val();
            $('#plased_back').html('Загрузка.....');
            $('#plased_back').closest('div').show();
         }else{
            $('#plased_back').closest('div').hide();
        }
        


         $.get(
            url,
            params,
            function (result) {
                if (result.type == 'error') {
                     alert('error');
                     return(false);
                 }
                if (typeof result.there != 'undefined'){
                    $('#plased_there').html(result.there);
                }
				if (typeof result.opt != 'undefined'){
                    $('.period_id_sel').html(result.opt);
                }
                if (typeof result.back != 'undefined'){
                    $('#plased_back').html(result.back);
					
                }
				if (typeof result.backopt != 'undefined'){
					$('.period_id_back_sel').html(result.backopt);
                }
                 if($('#ListTourist_period_id').val()||$('#ListTourist_period_back_id').val())
                $('.but').attr('disabled',false);
                else{
                     $('.but').attr('disabled',true);
                }
             },
             "json"
             );
            
             
         });
         
         $('.period_change').live('change',function(){

        /*
         * url запроса регионов
         */
         var url = 'index.php?r=tour/getbusplaces';

         var params ="";
         params += "bus_id=" + $('#ListTourist_bus_id option:selected').val();

         var transit_type =  $('#ListTourist_transit_type option:selected').val();
         params += "&transit_type=" + transit_type;

         if(transit_type == "<?php echo Transittype::THERE ?>"){
            params += "&period_id=" + $('#ListTourist_period_id option:selected').val();
            $('#plased_there').html('Загрузка.....');
            $('#plased_there').closest('div').show();
         }else{
            $('#plased_there').closest('div').hide();
         }
         if (transit_type == "<?php echo Transittype::BACK ?>") {
            params += "&period_id=" + $('#ListTourist_period_back_id option:selected').val();
            $('#plased_back').html('Загрузка.....');
            $('#plased_back').closest('div').show();
         }else{
            $('#plased_back').closest('div').hide();
        }
        


         $.get(
            url,
            params,
            function (result) {
                if (result.type == 'error') {
                     alert('error');
                     return(false);
                 }
                if (typeof result.there != 'undefined'){
                    $('#plased_there').html(result.there);
                }
                if (typeof result.opt != 'undefined'){
                    $('.period_id_sel').html(result.opt);
                }
                if (typeof result.back != 'undefined'){
                    $('#plased_back').html(result.back);
                    
                }
                if (typeof result.backopt != 'undefined'){
                    $('.period_id_back_sel').html(result.backopt);
                }
             },
             "json"
             );
             if($('#ListTourist_period_id').val()||$('#ListTourist_period_back_id').val())
                $('.but').attr('disabled',false);
                else{
                     $('.but').attr('disabled',true);
                }
             
         });
		 $('#ListTourist_transit_type').change(function () {             
        	switch (parseInt($(this).val()))
	        {
	        	case 2:
	        		$('.there').show();
	        		$('.back').hide();
	        		break;
	        	case 3:
	        		$('.there').hide();
	        		$('.back').show();
	        		break;
	        	
        	}

		});
	 </script>
<?php $this->endWidget(); ?>
<?php Yii::app()->getClientScript()->registerCoreScript('jquery');	 ?>
</div>

<?php if(!isset($_POST['action']) or empty($_POST['action'])) return;?>
<?php if($_POST['action'] == 'search'):?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tourist-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array('name'=>'name',
	    'header'=>'ФИО'),
	    array('name'=>'resort',
	    'header'=>'Курорт'),
	    array('name'=>'birthday',
	    'header'=>'Дата рождения'),
	    array('name'=>'passport',
	    'header'=>'Паспорт'),
		
		
		
		/*'departure_with_minsk',
		'departure_with_resort',
		
		//'arrival_in_minsk',
		
		array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
<?php endif;?>
