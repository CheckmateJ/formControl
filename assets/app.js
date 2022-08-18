import * as bootstrap from 'bootstrap';
import './fontawesome/fontawesome'
$('.name-field').on('keydown', function (){
    return /[a-z]/i.test(event.key)
})

// check if the correspondence contact fields are the same as contact address after submit
$(document).ready(function() {
    $('#form_panel_role').trigger('change');
    if(!$('#check_correspondence_address')[0].checked && $correspondenceAddress.val() != '' ){
        const $checkCheckbox = $correspondenceAddress.val() == $streetAddress.val() && $correspondenceLocalNumber.val() == $localNumber.val() && $correspondenceZipCode.val() == $zipCode.val()
        $('#check_correspondence_address').prop('checked', $checkCheckbox )
    }
});

const $pesel = $('#form_panel_pesel')
const $nip =$('#form_panel_nip')
const $correspondenceAddress = $('#form_panel_correspondenceAddress');
const $correspondenceLocalNumber = $('#form_panel_correspondenceLocalNumber');
const $correspondenceZipCode = $('#form_panel_correspondenceZipCode');
const $streetAddress = $('#form_panel_streetAddress');
const $localNumber = $('#form_panel_localNumber');
const $zipCode = $('#form_panel_zipCode')

$zipCode.on('keyup', function(){
    addDash(this.value.length, $zipCode)
})
$correspondenceZipCode.on('keyup', function(){
    addDash(this.value.length, $correspondenceZipCode)
})

// add dash after two numbers to field zip code
function addDash(length, $code){
    if(length === 2){
        $code.val($code.val() + '-')
    }
}

// show Nip or pesel
$('#form_panel_role').on('change', function(e){
    if(e.target.value == 'Company'){
        $pesel.parent().css('display', 'none');
        $pesel.attr('required', false)
        $pesel.val('')
        $nip.parent().css('display', 'block');
        $nip.attr('required', true)
    }else{
        $pesel.parent().css('display', 'block');
        $pesel.attr('required', true)
        $nip.parent().css('display', 'none');
        $nip.attr('required', false)
        $nip.val('')
    }
})

$('form').on("submit",function(){

    //add class to the invalid fields
    if(!(/(^\d{2}-\d{3}$)/.test($zipCode.val()))){
       $zipCode.attr('class', 'border-field')
        return false;
    }else{
       $zipCode.attr('class', 'unbordered-field')
    }

    if(!(/(^\d{2}-\d{3}$)/.test($correspondenceZipCode.val()))){
        $correspondenceZipCode.attr('class', 'border-field');
        return false;
    }else{
        $correspondenceZipCode.attr('class', 'unbordered-field');
    }

    if($pesel.parent().css('display') == 'block'){
       if(!isValidNumber($pesel.val())){
           $pesel.attr('class', 'border-field');
           return false;
       }
        $pesel.attr('class', 'unbordered-field');
       return true;
    }
    if(!isValidNumber($nip.val())){
        $nip.attr('class', 'border-field');
        return false;
    }
   $nip.attr('class', 'unbordered-field');
    return isValidNumber($nip.val());
})

//check correspondence address vs address
$('#check_correspondence_address').on("change", function(){
    if($('#check_correspondence_address')[0].checked){
        // set the same address
        $correspondenceAddress.val($streetAddress.val());
        $correspondenceLocalNumber.val($localNumber.val());
        $correspondenceZipCode.val($zipCode.val());
    }else{
        // clear correspondence address
        $correspondenceAddress.val('');
        $correspondenceLocalNumber.val('');
        $correspondenceZipCode.val('');
    }
});


/*Check if nip/pesel is valid number
    Pesel -> each number * weight. After Subtract 10 - the last number and if the same as control number return true
    NIP -> each number * weight. After that Divide Result by 11 if the modulo == control number return true
 */
function isValidNumber(number){
    let weight, controlNumber, weightCount
    let sum = 0;

    number = number.replaceAll('-', '');

    if($pesel.parent().css('display') == 'block'){
        if(number.length != 11){
            return false;
        }
        $pesel.val(number);
        weight  = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        controlNumber = parseInt(number.substring(10, 11));
        weightCount = weight.length;
    }else{
        if(number.length != 10){
            return false;
        }
        $nip.val(number);
        weight = [6, 5, 7, 2, 3, 4 , 5, 6, 7];
        weightCount = weight.length;
        controlNumber = parseInt(number.substring(9, 10));
    }

    for (let i = 0; i < weightCount; i++) {
        sum += (parseInt(number.substr(i, 1)) * weight[i]);
    }

    if($pesel.parent().css('display') == 'block'){
        sum = sum % 10;
        return (10 - sum) % 10 === controlNumber;
    }

    return sum % 11 === controlNumber;
}

