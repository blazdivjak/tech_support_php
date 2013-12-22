/**
 * Created by blaz on 19/11/13.
 */

//date picker for forms, some browsers do not support HTML5
$(function() {
    $( "#datepicker" ).datepicker();
    });

//type ahead with availiable users, replacment for HTML5 type ahead (bad support in IE, Safari)
$(function() {
    var availableTags = [
        "Virtualni strežniki",
        "Internetna povezava",
        "E-Pošta",
        "Varnostni incident",
        "Drugo"
    ];
    $( "#podrocje" ).autocomplete({
        source: availableTags
    });
});

//type ahead with availiable users, replacment for HTML5 type ahead (bad support in IE, Safari)
$(function() {
    var users = [
        "janez",
        "mirko",
        "test",
        "katja",
        "zoki",
        "domen",
        "kaja"
    ];
    $( "#username" ).autocomplete({
        source: users
    });
});

//tooltip for displaying extra information for users
$(function() {
    $( document ).tooltip({ position: { my: "left+15 center", at: "right center" } });
});


//Display search tutorial and make search form stand out
function searchTutorialOn(event){

    //make search box standout
    var search=event.currentTarget;
    search.className='standout';

    //create new element and display search hint
    var p=document.createElement("p");
    p.className="search-hint";
    var node=document.createTextNode("Iskalnik je, lahko bi rekli umetno inteligenten, saj omogoča iskanje po: ID, nazivu težave, datumu prijave, področju, agentu ali statusu.");
    p.appendChild(node);
    p.setAttribute( "id", "search-hint" );

    //append it to searchBox
    var element=document.getElementById("searchbox");
    element.appendChild(p);

}

function searchTutorialOff(event){

    //remove standout from search form
    var search=event.currentTarget;
    search.classList.remove('standout');

    //remove search hint
    var element=document.getElementById("searchbox");
    element.removeChild(document.getElementById("search-hint"));
}

document.getElementById('search').addEventListener('focus', searchTutorialOn, false);
document.getElementById('search').addEventListener('blur', searchTutorialOff, false);
//document.getElementById('search').addEventListener('mouseover', searchTutorialOn, false);
//document.getElementById('search').addEventListener('mouseout', searchTutorialOff, false);