/**
 * Created by blaz on 19/11/13.
 */

function chkUsername() {

    var error_string="Vnesite uporabniško ime";
    var element_id = "username";

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

function chkPassword() {

    var error_string="Vnesite geslo";
    var element_id = "password";

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
    if(!chkPassword()){
        formNotValid = true;
    }
    if(formNotValid){
        event.preventDefault();

    }
}

//Register events and execute handlers
document.getElementById('username').addEventListener('change', chkUsername, false);
document.getElementById('password').addEventListener('change', chkPassword, false);

document.getElementById('submit').addEventListener('click', chkSubmit, false);
