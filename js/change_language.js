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
function changeLanguage(event){

    //prevent page from refreshing
    event.preventDefault();

    var lang=$(this).attr("id");
    //alert(lang);

    //load XML
    xml=loadXMLDoc("static/translations/translations.xml");

    //test
    //alert(lang.id);

    /* TEST XML PARSING
    var xml='<cards>\
        <card id="3">\
          <name lang="es">test</name>\
          <description lang="es">test</description>\
          <name lang="en">test</name>\
          <description lang="en">test</description>\
        </card></cards>';

    $(xml).find('card').each(function () {
        var id, name, description;
        id          = $(this).attr('id'); // or just `this.id`
        name        = $(this).children('name[lang="en"]').text();
        description = $(this).children('description[lang="en"]').text();
        // do something with the id, name, and description

        //alert(name);

    });*/

    $(xml).find('page').each(function() {
        var id;
        id = $(this).attr('id'); // or just `this.id`

        //get current page url (index.html -> index)
        var currentPage = window.location.pathname.split('/');
        currentPage=currentPage[currentPage.length-1].split('.')[0];

        //alert(currentPage);

        if(id==currentPage){
            //get a specific translation
            //value = $(this).children('translation[id="title"]').children('english').text();
            //change element value
            //var element=document.getElementById("title").childNodes[0];
            //element.nodeValue=value;

            //get all in language
            $(this).find('translation').each(function(){
                element_id=$(this).attr('id');
                value=$(this).children(lang).text();
                var element=document.getElementById(element_id).childNodes[0];
                element.nodeValue=value;
            });

            //description = $(this).children('description[lang="en"]').text();
        }
    });
    //Set language cookie
}

document.getElementById('english').addEventListener('click', changeLanguage, false);
document.getElementById('slovenian').addEventListener('click', changeLanguage, false);