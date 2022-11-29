<?php
/* @var $this TourController */
/* @var $model Tour */
/* @var $form CActiveForm */
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/js/jquery-ui-i18n.min.js');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/jquery-ui.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/validator/jquery.validate.min.js');
//Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui.min.js');
//Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui-i18n.min.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl. '/js/validator/additional-methods.min.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/validator/messages_ru.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseurl .'/js/tour.js');
Yii::app()->getClientScript()->registerScript('', "
$(document).ready(function(){
    initialize();

});
", CClientScript::POS_LOAD );

?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tour-form',
		'enableAjaxValidation'=>false,
		)); ?>
  <?php if(!$model->isNewRecord):?>
      <input type="hidden" id='upd' name="update" value="1">
  <?php endif ?> 
		<p class="note">Поля помеченые <span class="required">*</span> обязательны к заполнению.</p>

		<?php echo $form->errorSummary($model, 'Пожалуйста, правильно заполните поля: '); ?>
		
		<table  border=1>
			<tbody  verticalalight>
				<tr>
					<td width="30%">
						<div class="row">
							<?php echo $form->labelEx($model,'manager_id'); ?>
							<?php echo $form->dropDownList($model, 'manager_id', Managers::getOptions() ); ?>
							<?php echo $form->error($model,'manager_id'); ?>
						</div>
						<div class="row">
							<?php echo $form->labelEx($model,'created'); ?>
                            <?php echo $form->textField($model, 'created', array('class'=>"required date"));?>
					        <?php echo $form->error($model,'created'); ?>
					    </div>
					</td>
					<td rowspan="5">
						<table  border=1 id='people_table'>
							<tbody >
								<tr id='owner'>
									<td>
										<div class="row">
											<?php echo $form->labelEx($model,'owner_name'); ?>
											<?php echo $form->textField($model,'owner_name',array('maxlength'=>1000,'class'=>'required name')); ?>
											<?php echo $form->error($model,'owner_name'); ?>
										</div>
									</td>
									<td>
										<div class="row">
											<?php echo $form->labelEx($model,'owner_tel1'); ?>
											<?php echo $form->textField($model,'owner_tel1',array('maxlength'=>20,'class'=>'required phoneby')); ?>
											<?php echo $form->error($model,'owner_tel1'); ?>
										</div>


										<div class="row">
											<?php echo $form->labelEx($model,'owner_tel2'); ?>
											<?php echo $form->textField($model,'owner_tel2',array('maxlength'=>20,'class'=>'phoneby')); ?>
											<?php echo $form->error($model,'owner_tel2'); ?>
										</div>

										<div class="row">
											<?php echo $form->labelEx($model,'owner_passport'); ?>
											<?php echo $form->textField($model,'owner_passport',array('maxlength'=>1000,'class'=>'required passport')); ?>
											<?php echo $form->error($model,'owner_passport'); ?>
										</div>

										<div class="row">
											<?php echo $form->labelEx($model,'owner_birthday'); ?>
											<?php echo $form->textField($model,'owner_birthday', array('class'=>'required date')); ?>
											<?php echo $form->error($model,'owner_birthday'); ?>
										</div>
									</td>
									<td>
										<div class="row">
											<?php echo $form->labelEx($model,'owner_travel_service'); ?>
											<?php echo $form->textField($model,'owner_travel_service', array('class'=>'required cost1')); ?>
											<?php echo $form->error($model,'owner_travel_service'); ?>
										</div>

										<div class="row">
											<?php echo $form->labelEx($model,'owner_travel_cost'); ?>
											<?php echo $form->textField($model,'owner_travel_cost', array('class'=>'required cost2')); ?>
											<?php echo $form->error($model,'owner_travel_cost'); ?>
										</div>
									</td>
								</tr>



								<tr>
									<td colspan=3>
										<button type="button" id='button_add' width='100%' onclick="addRowPeopleTable()" > Добавить клиента</button>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<div class="row">
											<?php echo $form->labelEx($model,'count_of_childs'); ?>
											<?php echo $form->textField($model,'count_of_childs'); ?>
											<?php echo $form->error($model,'count_of_childs'); ?>
										</div>

										<div class="row">
											<?php echo $form->labelEx($model,'ages'); ?>
											<?php echo $form->textField($model,'ages',array('maxlength'=>255)); ?>
											<?php echo $form->error($model,'ages'); ?>
										</div>
									</td>
									<td >
										<div class="row">
											<?php echo $form->labelEx($model,'total_travel_service'); ?>
											<?php echo $form->textField($model,'total_travel_service'); ?>
											<?php echo $form->error($model,'total_travel_service'); ?>
										</div>

										<div class="row">
											<?php echo $form->labelEx($model,'total_travel_cost'); ?>
											<?php echo $form->textField($model,'total_travel_cost'); ?>
											<?php echo $form->error($model,'total_travel_cost'); ?>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<div class="row buttons">
											<?php 
											echo CHtml::Button($model->isNewRecord ? 'Оформить' : 'Сохранить изменения',array('id'=>'saveb')); 
                                            echo CHtml::submitButton($model->isNewRecord ? 'Оформить' : 'Сохранить изменения',array('style'=>'display:none;')); 
											$CreateTourUrl = Yii::app()->createUrl('tour/create');
											echo CHtml::button('Новый договор', array('onclick'=>"window.location = '$CreateTourUrl';")); 
											if(!$model->isNewRecord)
											{
												$PrintContractUrl = Yii::app()->createUrl('template/printtemplate', array('id'=>$model->id, 'type'=>'contract'));
												echo CHtml::button('Печать договора', array('onclick'=>"window.open('$PrintContractUrl','_blank' );"));
												$PrintContractAdd2Url = Yii::app()->createUrl('template/printtemplate', array('id'=>$model->id, 'type'=>'contract_add2'));
												echo CHtml::button('Печать приложения 2', array('onclick'=>"window.open('$PrintContractAdd2Url','_blank');")); 
											}
											?>
										</div>
									</td>
								</tr>
							</tbody> 
						</table>
					</td>
				</tr>
				<tr>
					<td> Куда:

						<div class="row">
							<label for="country_id" class="required">Страна <span class="required">*</span></label>
							<?php echo CHtml::dropDownList('country_id','Пожалуйста, выберите страну',Countries::getOptions() ); ?>
						</div>
						<div class="row">
							<?php echo $form->labelEx($model,'resort_id'); ?>
							<?php echo $form->dropDownList($model,'resort_id', Resorts::getOptions() ); ?>
							<?php echo $form->error($model,'resort_id'); ?>
						</div>
						<div class="row">
							<?php echo $form->labelEx($model,'is_only_transit'); ?>
							<?php echo $form->checkBox($model,'is_only_transit'); ?>
							<?php echo $form->error($model,'is_only_transit'); ?>
						</div>
						<div class="row">
							<?php echo $form->labelEx($model,'hotel_id'); ?>
							<?php echo $form->dropDownList($model, 'hotel_id', Hotels::getOptions()  ); ?>
							<?php echo $form->error($model,'hotel_id'); ?>
						</div>
						
					</td>
				</tr>
				<tr>
					<td>
						<div class="row">
							<?php echo $form->labelEx($model,'transit'); ?>
							<?php echo $form->dropDownList($model,'transit',Transittype::getOptions()); ?>
							<?php echo $form->error($model,'transit'); ?>
						</div>

						<div id="bus_info" >
						 
							<div class="row">
								<?php echo $form->labelEx($model,'bus'); ?>
								<?php echo $form->dropDownList($model,'bus',Buses::getOptions()); ?>
								<?php echo $form->error($model,'bus'); ?>
							</div>
						    
						   
						    
							<div class="row" id="there_transit" >
							<?php echo $form->labelEx($model,'period_id'); ?>
							<?php echo CHtml::dropDownList('date_start',date('m',strtotime(Period::model()->findByPk($model->period_id)->date)), array('01'=>'январь','02'=>'февраль','03'=>'март','04'=>'апрель','05'=>'май','06'=>'июнь','07'=>'июль','08'=>'август','09'=>'сентябрь',10=>'октябрь',11=>'ноябрь',12=>'декабрь',),array('empty'=>'')); ?>
                          	<div class="period_id_sel">
							<?php echo $form->dropDownList($model,'period_id', Period::getOptions()); ?>
							</div>
							<?php echo $form->error($model,'period_id'); ?>
							
						</div>
						<div class="row">
                                <?php echo $form->labelEx($model,'bus_back'); ?>
                                <?php echo $form->dropDownList($model,'bus_back',Buses::getOptions()); ?>
                                <?php echo $form->error($model,'bus_back'); ?>
                            </div>
						<div class="row" id="back_transit" >
							<?php echo $form->labelEx($model,'period_back_id'); ?>
							 <?php echo CHtml::dropDownList('date_to',date('m',strtotime(Period::model()->findByPk($model->period_back_id)->date)), array('01'=>'январь','02'=>'февраль','03'=>'март','04'=>'апрель','05'=>'май','06'=>'июнь','07'=>'июль','08'=>'август','09'=>'сентябрь',10=>'октябрь',11=>'ноябрь',12=>'декабрь',),array('empty'=>'')); ?>
                               
							<div class="period_id_back_sel">
							<?php echo $form->dropDownList($model,'period_back_id', Period::getBackOptions()); ?>
							</div>
							<?php echo $form->error($model,'period_back_id'); ?>
						</div>
						    
							<div class="row" id="div_plased">
							    <div><?php echo CHtml::button('Применить',array('id'=>'getplaces')) ?></div>
								<label>Свободно мест</label>
								<div><label>туда:</label> <span id="plased_there"></span></div>
								<div><label>обратно:</label> <span id="plased_back"></span> </div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div class="row" id='begin_transit'>
							<?php echo $form->labelEx($model,'begin_date'); ?>
                            <?php echo $form->textField($model, 'begin_date', array('class'=>"required date"));?>
							<?php echo $form->error($model,'begin_date'); ?>
						</div>
						
						<div class="row" id="count_of_day">
							<?php echo $form->labelEx($model,'count_of_day'); ?>
							<?php echo $form->textField($model,'count_of_day', array('class'=>'number required ')); ?>
							<?php echo $form->error($model,'count_of_day'); ?>
						</div>
					</td>
				</tr>
				
			</tbody>
		</table>

	<?php $this->endWidget(); ?>

</div><!-- form -->
<div style="display:none">
	<table>
		<tr id='example' style="display:none">
			<td>
				NUMBER___	
				<input name="Tour[tourist][NUMBER___][id]" id="Tourist_NUMBER____id" type="hidden" value="">
				<div class="row">
					<button type="button" onclick='deleteRowPeopleTable(this)'>Удалить клиента</button>
				</div>
				<div class="row">
					<label for="Tour_owner_name" class="required">ФИО <span class="required">*</span></label>
					<input maxlength="1000" name="Tour[tourist][NUMBER___][name]" id="Tourist_NUMBER____name" type="text" value="" class="required name">
				</div>
			</td>
			<td>
				<div class="row">
					<label for="Tour_owner_passport" class="required">Паспортные данные <span class="required">*</span></label>
					<input maxlength="1000" name="Tour[tourist][NUMBER___][passport]" id="Tourist_NUMBER____passport" type="text" value="" class="required passport">
				</div>


				<div class="row">
					<label for="Tour_owner_birthday" class="required">Дата рождения <span class="required">*</span></label>
					<input name="Tour[tourist][NUMBER___][birthday]" id="Tourist_NUMBER____birthday" type="text" value="" class="required date">
				</div>
			</td>
			<td>
				<div class="row">
					<label for="Tour_owner_travel_service" class="required">Тур услуга <span class="required">*</span></label>
					<input name="Tour[tourist][NUMBER___][travel_service]" id="Tourist_NUMBER____travel_service" type="text" value="" class="required cost1">
				</div>
				<div class="row">
					<label for="Tour_owner_travel_cost" class="required">Стоимость тура <span class="required">*</span></label>
					<input name="Tour[tourist][NUMBER___][travel_cost]" id="Tourist_NUMBER____travel_cost" type="text" value="" class="required cost2">
				</div>
			</td>
		</tr>
	</table>
</div>
<span style="display:none" id='sval'></span>
<script type="text/javascript">
    function initialize(){

        <?php if(!$model->isNewRecord):?>
            addTourists();
            /*
            Установим корректную страну
            */
            $('#Tour_bus').change();
        $('#Tour_bus_back').change();
            $('#country_id option[selected="selected"]').attr('selected', false);

            $('#country_id option[value="<?php echo $model->resort->country->id ?>"]').attr('selected', true);
             current_tourist2=-1;
        <?php else: ?>
      
        $("#country_id").change();
        $('#Tour_transit').change();

        $('#Tour_bus').change();
        $('#Tour_bus_back').change();
         <?php endif?>
           $("form").validate();
        createDataPicker('#Tour_created');
        createDataPicker('#Tour_begin_date');
        createDataPickerbirthday('#Tour_owner_birthday');
		
       
     

       // $('#Tour_bus').change();
            
    }

	function addTourists()
	{
		<?php  
		$result = array();
		foreach ($model->tourists as $tourist) {
			if(is_array($tourist)){
				$result[] = $tourist;
			}else{
				$result[] = $tourist->attributes;
			}
		}
		?>
		var textTourist = '<?php print json_encode($result)?>';
		tourists = JSON.parse(textTourist);
		$(tourists).each(function(){
			addRowPeopleTable();
			i = current_tourist;
			$('#Tourist_'+i+'_name').val($(this).attr('name'));
			$('#Tourist_'+i+'_owner_id').val($(this).attr('owner_id'));
			$('#Tourist_'+i+'_id').val($(this).attr('id'));
			$('#Tourist_'+i+'_passport').val($(this).attr('passport'));
			$('#Tourist_'+i+'_birthday').val($(this).attr('birthday'));
			$('#Tourist_'+i+'_travel_service').val($(this).attr('travel_service'));
			$('#Tourist_'+i+'_travel_cost').val($(this).attr('travel_cost'));

		});
		 $("form").validate();
		 $('#getplaces').click();
		 $('#Tour_transit').change();
	}
  // $('.cost1').click(function(){ $('.cost1').change()});
    $('.cost1').change(function(){
        $('#Tour_total_travel_service').val(summValue('.cost1'));
    });
    $('.cost2').change(function(){
        $('#Tour_total_travel_cost').val(summValue('.cost2'));
    });

    $('#Tour_total_travel_service').keydown(function(e){
        e.preventDefault();
    });
    $('#Tour_total_travel_cost').keydown(function(e){
        e.preventDefault();
    });
    //$('$')
    $('#Tour_transit').change(function () {
        //alert(2);
        switch (parseInt($(this).val()))
        {
            case <?php echo Transittype::THERE ?>:
                $('#Tour_begin_date').attr('disabled', true);
                $('#Tour_period_id').attr('disabled', false);
                $('#Tour_period_back_id').attr('disabled', true);
                $('#Tour_count_of_day').attr('disabled', false);
		        $('#Tour_bus').attr('disabled', false);
		        $('#Tour_bus_back').attr('disabled', true);
                break;
            case <?php echo Transittype::BACK ?>:
                $('#Tour_begin_date').attr('disabled', false);
                $('#Tour_period_id').attr('disabled', true);
                $('#Tour_period_back_id').attr('disabled', false);
                $('#Tour_count_of_day').attr('disabled', true);
		$('#Tour_bus').attr('disabled', true);
		 $('#Tour_bus_back').attr('disabled', false);
                break;
            case <?php echo Transittype::TWO_SIDE ?>:
                $('#Tour_begin_date').attr('disabled', true);
                $('#Tour_period_id').attr('disabled', false);
                $('#Tour_period_back_id').attr('disabled', false);
                $('#Tour_count_of_day').attr('disabled', true);
		$('#Tour_bus').attr('disabled', false);
		$('#Tour_bus_back').attr('disabled', false);
                break;
            case <?php echo Transittype::NO_TRANSIT ?>:
                $('#Tour_begin_date').attr('disabled', false);
                $('#Tour_period_id').attr('disabled', true);
		$('#Tour_bus').attr('disabled', true);
		 $('#Tour_bus_back').attr('disabled', true);
                $('#Tour_period_back_id').attr('disabled', true);
                $('#Tour_count_of_day').attr('disabled', false);
                break;
        }

    });
    $('#country_id').change(function () {
        var country_id = $(this).val();
        if (country_id == '0') {
            $('#Tour_resort_id').html('');
            $('#Tour_resort_id').attr('disabled', true);
            return(false);
        }
        $('#Tour_resort_id').attr('disabled', true);
        $('#Tour_resort_id').html('<option>загрузка...</option>');
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
                        $('#Tour_resort_id').html('<option>выберите другую страну</option>');
                     }
                     else {
                        $(result.resorts).each(function() {
                            /*
                             * и добавляем в селект по региону
                             */
                             options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('title') + '</option>';
                         });
                        $('#Tour_resort_id').html(options);
                        $('#Tour_resort_id').attr('disabled', false);
                     }
                 }
                 $('#Tour_resort_id').change();
             },
             "json"
             );
    });
    $('#date_start').change(function(){$('#Tour_bus').change();});
    $('#date_to').change(function(){$('#Tour_bus_back').change();});

    $('#Tour_bus').change(function(){

        /*
         * url запроса регионов
         */
         var url = 'index.php?r=tour/getbusperiods';

         var params ="";
         params += "bus_id=" + $('#Tour_bus option:selected').val();

         var transit_type =  $('#Tour_transit option:selected').val();
         params += "&transit_type=" + transit_type;
	  var date_start =  $('#date_start option:selected').val();
         params += "&date_start=" + date_start;
	 var date_to =  $('#date_to option:selected').val();
         params += "&date_to=" + date_to;
         params += "&period_id=" + $('#Tour_period_id option:selected').val();
         params += "&period_back_id=" + $('#Tour_period_back_id option:selected').val();
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
            // $('#getplaces').click();
         });
	 $('#Tour_bus_back').change(function(){

        /*
         * url запроса регионов
         */
         var url = 'index.php?r=tour/getbusperiods';

         var params ="";
         params += "bus_id=" + $('#Tour_bus_back option:selected').val();

         var transit_type =  $('#Tour_transit option:selected').val();
         params += "&transit_type=" + transit_type;
     var date_to =  $('#date_to option:selected').val();
         params += "&date_to=" + date_to;
         params += "&period_id=" + $('#Tour_period_id option:selected').val();
         params += "&period_back_id=" + $('#Tour_period_back_id option:selected').val();
         $.get(
            url,
            params,
            function (result) {
                if (result.type == 'error') {
                     alert('error');
                     return(false);
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
           //  $('#getplaces').click();
         });
     

	 $('#Tour_period_id').live('change',function(){

        /*
         * url запроса регионов
         */
         var url = 'index.php?r=tour/getbusplaces';

         var params ="";
         params += "bus_id=" + $('#Tour_bus option:selected').val();

         var transit_type =  $('#Tour_transit option:selected').val();
         params += "&transit_type=" + transit_type;
$('#plased_there').html('');
         if(transit_type == "<?php echo Transittype::THERE ?>" || transit_type == "<?php echo Transittype::TWO_SIDE ?>"){
            params += "&period_id=" + $('#Tour_period_id option:selected').val();
            $('#plased_there').html('Загрузка.....');
            $('#plased_there').closest('div').show();
         }else{
            $('#plased_there').closest('div').hide();
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
           
            $('#saveb').attr('disabled',((result.there<1||result.back<1)&&!$('#upd').val()));
            if(result.there<1&&!$('#upd').val()){
                alert('Автобус в прямом направлении переполнен');
            }
            
                }
                if (typeof result.opt != 'undefined'){
                    $('.period_id_sel').html(result.opt);
                }
             },
             "json"
             );
         });
	
	
	$('#Tour_period_back_id').live('change',function(){

        /*
         * url запроса регионов
         */
         var url = 'index.php?r=tour/getbusplaces';

         var params ="";
         params += "bus_id=" + $('#Tour_bus_back option:selected').val();

         var transit_type =  $('#Tour_transit option:selected').val();
         params += "&transit_type=" + transit_type;
$('#plased_back').html('');
         if(transit_type == "<?php echo Transittype::BACK ?>" || transit_type == "<?php echo Transittype::TWO_SIDE ?>"){
            params += "&period_id=" + $('#Tour_period_back_id option:selected').val();
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
                if (typeof result.back != 'undefined'){
                    $('#plased_back').html(result.back);
           
            $('#saveb').attr('disabled',((result.there<1||result.back<1)&&!$('#upd').val()));
            if(result.there<1&&!$('#upd').val()){
                alert('Автобус в обратном направлении переполнен');
            }
            
                }
                if (typeof result.opt != 'undefined'){
                    $('.period_back_id_sel').html(result.backopt);
                }
             },
             "json"
             );
         });
    
	 
	 
	  $('#getplaces').click(function(){
        $('#Tour_period_id').change();
        $('#Tour_period_back_id').change();
         });
    //var complieteChangeHotel = false;
    var needChangeHotel = false;

    $('#Tour_resort_id').change(function () {

       /*
       * Если только проезд, то нам гостинницы менять не нужно, пока что!!!!
       *
       */
       needChangeHotel = true;
       if($('#Tour_is_only_transit').prop('checked')){


        return;
       }

       var resorts_id = $(this).val();

       if (resorts_id == '0') {
        $('#Tour_hotel_id').html('');
        $('#Tour_hotel_id').attr('disabled', true);
        return(false);
       }

       $('#Tour_hotel_id').attr('disabled', true);
       $('#Tour_hotel_id').html('<option>загрузка...</option>');

       var url = 'index.php?r=tour/gethotels';
       $.get(
        url,
        "resorts_id=" + resorts_id,
        function (result) {

            if (result.type == 'error') {

                alert('error');
                return(false);
            }
            else {
                var options = '';
                if($(result.resorts).length == 0){
                    $('#Tour_hotel_id').html('<option>выберите другую страну</option>');
                }
                else {
                    $(result.resorts).each(function() {
                        options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('title') + '</option>';
                    });
                    $('#Tour_hotel_id').html(options);
                    $('#Tour_hotel_id').attr('disabled', false);
                }
            }
        },
        "json"
        );
    });

    $('#Tour_is_only_transit').change(function () {
        //alert('asdf');
        $('#Tour_hotel_id').attr('disabled', $(this).prop('checked'));
        if(!$(this).prop('checked')){
            if(needChangeHotel){
                $('#Tour_resort_id').change();
            }
            //complieteChangeHotel = true;
        }
    });


    if($('#Tour_is_only_transit').prop('checked')){
        $('#Tour_hotel_id').attr('disabled', true);
    }

    $('#Tour_is_only_transit').click(function(){
        if($('#Tour_is_only_transit').attr('checked'))
        {
            $('#Tour_transit option[value=4]').attr('selected',false).attr('disabled','disabled')
        }
        else($('#Tour_transit option[value=4]').attr('disabled',false));
    })
    $('#saveb').click(function(){
        var url = 'index.php?r=tour/cansave';
        var vals;
      vals=$.get(
        url,
        "ctour=" + current_tourist2+"&bus=" + $('#Tour_bus option:selected').val()+"&period_id=" + $('#Tour_period_id option:selected').val()+"&bus_back=" + $('#Tour_bus_back option:selected').val()+"&period_back_id=" + $('#Tour_period_back_id option:selected').val(),
        function (result) {

         if(result.res==1) $('form').submit();
         else{alert('Автобус заполнен');$('#getplaces').click(); }
        },
        "json"
        );
      
       return false;
       
        
        
        
        
    });

</script>