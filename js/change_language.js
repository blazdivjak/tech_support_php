/* Read a file  using xmlhttprequest  */

function loadXMLDoc(dname)
{
    if (window.XMLHttpRequest)
    {
        xhttp=new XMLHttpRequest();
    }
    else
    {
        xhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.open("GET",dname,false);
    xhttp.send();
    return xhttp.responseXML;
}

//change language with this function, and load translation
function changeLanguage(){

    var lang=event.currentTarget;

    //load XML
    xmlDoc=loadXMLDoc("static/translations/translations.xml");

    //test
    //alert(lang.id);

    //Iterate over all translations for this page and change lang

    //change element value
    var element=document.getElementById("title").childNodes[0];
    element.nodeValue="Test";

    var element=document.getElementById("header").childNodes[0];
    element.nodeValue="Test";

    //Set language cookie

}


document.getElementById('english').addEventListener('click', changeLanguage, false);
document.getElementById('slovenian').addEventListener('click', changeLanguage, false);