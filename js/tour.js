jQuery.validator.addMethod("phoneby", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length == 11 &&
        phone_number.match(/(80[0-9]{9})/);
}, "Пожалуйста, введите правильный номер телефона (начиная с 80)");



jQuery.validator.addClassRules("phoneby", {
    phoneby:true
});
jQuery.validator.addClassRules("cost1", {
    number:true
});
jQuery.validator.addClassRules("cost2", {
    number:true
});
//jQuery.validator.addClassRules("passport", {
//    passport:true
//});
jQuery.validator.addClassRules("name", {
    minlength:5
});





function createDataPicker(query){
    jQuery(query).datepicker(
        jQuery.extend(
            {showMonthAfterYear:false},
            jQuery.datepicker.regional['ru'],
            {'dateFormat':'yy-mm-dd'}
        )
    );
}
function createDataPickerbirthday(query){
    jQuery(query).datepicker(
        jQuery.extend(
            {showMonthAfterYear:false},
            jQuery.datepicker.regional['ru'],
            {'dateFormat':'yy-mm-dd','changeMonth': true,'changeYear': true}
        )
    );
}

function deleteRowPeopleTable(obj){
    $(obj).closest('tr').remove();
	 $('#Tour_total_travel_service').val(summValue('.cost1'));
	  $('#Tour_total_travel_cost').val(summValue('.cost2'));
	  current_tourist2--;
}

var current_tourist=0;
var current_tourist2=0;
function addRowPeopleTable(){
    //alert('asdf');
    
    var example = $('#example').html();
    var str_replace_number = 'NUMBER___';
    var there;
    var back;
there=parseInt($('#plased_there').html());
back=parseInt($('#plased_back').html());
if(there>0||there==0){
	if(current_tourist2+1>there||current_tourist2+1==there)
	{
		alert('Автобус в прямом направлении переполнен');
		return false;
	}
}
if(back>0||back==0){
	if(current_tourist2+1>back||current_tourist2+1==back)
	{
		alert('Автобус в обратном направлении переполнен');
		return false;
	}
}

    example = '<tr class="tourist">'
        + example.replace(new RegExp(str_replace_number,'g'), ++current_tourist)
        + '</tr>';
    if ($('tr.tourist').length == 0 ){
        $('#owner').after(example);
    }else{
        $('tr.tourist').last().after(example);
    }
    current_tourist2++;
    createDataPickerbirthday('#Tourist_'+current_tourist+'_birthday ');
    $('#Tourist_'+current_tourist+'_travel_service').change(function(){
        $('#Tour_total_travel_service').val(summValue('.cost1'));
    });
    $('#Tourist_'+current_tourist+'_travel_cost').change(function(){
        $('#Tour_total_travel_cost').val(summValue('.cost2'));
    });
}

function summValue(query){
    var summa = 0;
    $(query).each(function() {
        if($(this).val() != ''){
            summa += parseInt($(this).val());

        }
    });
    return isNaN(summa)?'Проверьте данные':summa;

}