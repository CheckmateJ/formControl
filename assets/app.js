import './bootstrap';
import $ from 'jquery';


$('.name-field').keydown(function (){
    return /[a-z]/i.test(event.key)
})

$(document).ready(function() {
    $('#form_panel_role').trigger('change');
});

$('#form_panel_role').change(function(e){
    if(e.target.value == 'Company'){
        $('#form_panel_pesel').parent().css('display', 'none');
        $('#form_panel_pesel').attr('required', false)
        $('#form_panel_pesel').val('')
        $('#form_panel_nip').parent().css('display', 'block');
        $('#form_panel_nip').attr('required', true)
    }else{
        $('#form_panel_pesel').parent().css('display', 'block');
        $('#form_panel_pesel').attr('required', true)
        $('#form_panel_nip').parent().css('display', 'none');
        $('#form_panel_nip').attr('required', false)
        $('#form_panel_nip').val('')
    }
})

$('form').on("submit",function(){
    if(!(/(^\d{2}-\d{3}$)/.test($('#form_panel_zipCode').val()))){
        $('#form_panel_zipCode').attr('class', 'border-field')
        return false;
    }else{
        $('#form_panel_zipCode').attr('class', 'unbordered-field')
    }

    if(!(/(^\d{2}-\d{3}$)/.test($('#form_panel_correspondenceZipCode').val()))){
        $('#form_panel_correspondenceZipCode').attr('class', 'border-field');
        return false;
    }else{
        $('#form_panel_correspondenceZipCode').attr('class', 'unbordered-field');
    }

    if($('#form_panel_pesel').parent().css('display') == 'block'){
       if(!isValidNumber($('#form_panel_pesel').val())){
           $('#form_panel_pesel').attr('class', 'border-field');
           return false;
       }
        $('#form_panel_pesel').attr('class', 'unbordered-field');
       return true;
    }
    if(!isValidNumber($('#form_panel_nip').val())){
        $('#form_panel_nip').attr('class', 'border-field');
        return false;
    }
    $('#form_panel_nip').attr('class', 'unbordered-field');
    return isValidNumber($('#form_panel_nip').val());
})

$('#check_correspondence_address').change(function(){
    if($('#check_correspondence_address')[0].checked){
        // set the same address
        $('#form_panel_correspondenceAddress').val($('#form_panel_streetAddress').val());
        $('#form_panel_correspondenceLocalNumber').val($('#form_panel_localNumber').val());
        $('#form_panel_correspondenceZipCode').val($('#form_panel_zipCode').val());
    }else{
        // clear correspondence address
        $('#form_panel_correspondenceAddress').val('');
        $('#form_panel_correspondenceLocalNumber').val('');
        $('#form_panel_correspondenceZipCode').val('');
    }

});

function isValidNumber(number){
    let weight, controlNumber, weightCount
    let sum = 0;

    if($('#form_panel_pesel').parent().css('display') == 'block'){
        weight  = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        controlNumber = parseInt(number.substring(10, 11));
        weightCount = weight.length;
    }else{
        weight = [6, 5, 7, 2, 3, 4 , 5, 6, 7];
        weightCount = weight.length;
        controlNumber = parseInt(number.substring(9, 10));
    }

    for (let i = 0; i < weightCount; i++) {
        sum += (parseInt(number.substr(i, 1)) * weight[i]);
    }

    if($('#form_panel_pesel').parent().css('display') == 'block'){
        sum = sum % 10;
        return (10 - sum) % 10 === controlNumber;
    }

    return sum % 11 === controlNumber;
}

