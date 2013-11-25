/**
 * Created by blaz on 19/11/13.
 */


//Check for errors in telephone number and dont allow to submit
function chkTel() {

    //var tel = event.currentTarget;
    var tel = $("#tel").val();

    var regex = /^\d{3}\s\d{3}-\d{3}$/;

    //if(!regex.test(tel.value) || tel.value==null || tel.value ==''){
    if(!regex.test(tel) || tel==null || tel ==''){
        $("#tel").attr('class', 'error');
        document.getElementById('tel_error').innerHTML="Telefonska številka ni prave oblike";
        return false;
    }

    else{
        $("#tel").attr('class', 'normal');
        document.getElementById('tel_error').innerHTML="";
        return true;
    }
}

function chkOpis() {

    var error_string="Vnesite podroben opis uporabnikove težave";
    var element_id = "opis";

    var value = $("#"+element_id).val();
    var error_id = element_id+"_error";

    if(value==null || value ==''){
        $("#"+element_id).attr('class', 'error');
        document.getElementById(error_id).innerHTML=error_string;
        return false;
    }

    else{
        $("#"+element_id).attr('class', 'normal');
        document.getElementById(error_id).innerHTML="";
        return true;
    }
}

function chkPodrocje() {

    var error_string="Vnesite področje, na katerem ima uporabnik težavo";
    var element_id = "podrocje";

    //Dont change
    var value = $("#"+element_id).val();
    var error_id = element_id+"_error";

    if(value==null || value ==''){
        $("#"+element_id).attr('class', 'error');
        document.getElementById(error_id).innerHTML=error_string;
        return false;
    }

    else{
        $("#"+element_id).attr('class', 'normal');
        document.getElementById(error_id).innerHTML="";
        return true;
    }
}

function chkDate() {

    var error_string="Izberite datum";
    var element_id = "datepicker";
    var regex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

    //Dont change
    var value = $("#"+element_id).val();
    var error_id = element_id+"_error";

    if(!regex.test(value) || value==null || value ==''){
        $("#"+element_id).attr('class', 'error');
        document.getElementById(error_id).innerHTML=error_string;
        return false;
    }

    else{
        $("#"+element_id).attr('class', 'normal');
        document.getElementById(error_id).innerHTML="";
        return true;
    }
}

function chkNaslov() {

    var error_string="Vnesite naslov težave";
    var element_id = "kratek_opis";

    //Dont change
    var value = $("#"+element_id).val();
    var error_id = element_id+"_error";

    if(value==null || value ==''){
        $("#"+element_id).attr('class', 'error');
        document.getElementById(error_id).innerHTML=error_string;
        return false;
    }

    else{
        $("#"+element_id).attr('class', 'normal');
        document.getElementById(error_id).innerHTML="";
        return true;
    }
}

function chkUsername() {

    var error_string="Vnesite uporabniško ime klicatelja";
    var element_id = "username";

    //Dont change
    var value = $("#"+element_id).val();
    var error_id = element_id+"_error";

    if(value==null || value ==''){
        $("#"+element_id).attr('class', 'error');
        document.getElementById(error_id).innerHTML=error_string;
        return false;
    }

    else{
        $("#"+element_id).attr('class', 'normal');
        document.getElementById(error_id).innerHTML="";
        return true;
    }
}

//Check for errors in form and dont allow to submit
function chkSubmit(event){

    var formNotValid = false;

    if(!chkUsername()){
        formNotValid = true;
    }

    if(!chkNaslov()){
        formNotValid = true;
    }
    if(!chkDate()){
        formNotValid = true;
    }

    if(!chkPodrocje()){
        formNotValid = true;
    }

    if(!chkOpis()){
        formNotValid = true;
    }

    if(!chkTel()){
        formNotValid = true;
    }

    if(formNotValid){
        event.preventDefault();

    }
}

//Register events and execute handlers
document.getElementById('tel').addEventListener('change', chkTel, false);
document.getElementById('opis').addEventListener('change', chkOpis, false);
document.getElementById('podrocje').addEventListener('change', chkPodrocje, false);
document.getElementById('kratek_opis').addEventListener('change', chkNaslov, false);
document.getElementById('datepicker').addEventListener('change', chkDate, false);
document.getElementById('username').addEventListener('change', chkUsername, false);
document.getElementById('submit').addEventListener('click', chkSubmit, false);
