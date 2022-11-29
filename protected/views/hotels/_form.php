<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hotels-form',
	'enableAjaxValidation'=>false,
)); 
Yii::app()->getClientScript()->registerCoreScript('jquery');?>

	<p class="note">Поля помеченые <span class="required">*</span> обязательны для заполнения</p>

	<?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Страна','') ?>
		<?php //echo $form->textField($model,'resorts_id'); 
		 echo CHtml::dropDownList('country_id','', Countries::getOptions(), array('empty'=>'') );
		?>
		<?php echo $form->error($model,'resorts_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'resorts_id'); ?>
		<?php //echo $form->textField($model,'resorts_id'); 
		 echo $form->dropDownList($model,'resorts_id', Resorts::getOptions(), array('empty'=>'') );
		?>
		<?php echo $form->error($model,'resorts_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_of_hotel'); ?>
		<?php echo $form->textField($model,'address_of_hotel',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'address_of_hotel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->textField($model,'area',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'beatch'); ?>
		<?php echo $form->textField($model,'beatch',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'beatch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textField($model,'body',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>3100)); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'water'); ?>
		<?php echo $form->textField($model,'water',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'water'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'food'); ?>
		<?php echo $form->textField($model,'food',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'food'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'features'); ?>
		<?php echo $form->textField($model,'features',array('size'=>60,'maxlength'=>3100)); ?>
		<?php echo $form->error($model,'features'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>3100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'is_active'); */?>
		<?php /*echo $form->checkBox($model,'is_active'); */?>
		<?php /*echo $form->error($model,'is_active'); */?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
     $('#country_id').change(function () {
        var country_id = $(this).val();
        if (country_id == '0') {
            $('#Hotels_resorts_id').html('');
            $('#Hotels_resorts_id').attr('disabled', true);
            return(false);
        }
        $('#Hotels_resorts_id').attr('disabled', true);
        $('#Hotels_resorts_id').html('<option>загрузка...</option>');
        var url = 'index.php?r=tour/getresorts';
        $.get(
            url,
            "country_id=" + country_id,
            function (result) {
                if (result.type == 'error') {
                    alert('error');
                    return(false);
                }
                else {
                    /*
                     * проходимся по пришедшему от бэк-энда массиву циклом
                     */
                     var options = '';
                     if($(result.resorts).length == 0){
                        $('#Hotels_resorts_id').html('<option>выберите другую страну</option>');
                     }
                     else {
                        $(result.resorts).each(function() {
                            /*
                             * и добавляем в селект по региону
                             */
                             options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('title') + '</option>';
                         });
                        $('#Hotels_resorts_id').html(options);
                        $('#Hotels_resorts_id').attr('disabled', false);
                     }
                 }
               
             },
             "json"
             );
    });

    
    </script>