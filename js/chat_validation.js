/**
 * Created by blaz on 19/11/13.
 */

function chkChat() {

    var error_string="Ste mislili poslati, kar prazno sporočilo?";
    var element_id = "message";

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

    if(!chkChat()){
        formNotValid = true;
    }
    if(formNotValid){
        event.preventDefault();

    }
}

//Register events and execute handlers
document.getElementById('message').addEventListener('change', chkChat, false);
document.getElementById('submit').addEventListener('click', chkSubmit, false);
