"use strict";

document.addEventListener('DOMContentLoaded', function () {
    //Toont de huidig geselecteerde score op profiles.php in de formulieren
    document.getElementById("score-b").addEventListener("input", showSelectedScore);
    document.getElementById("score-c").addEventListener("input", showSelectedScore);
    document.getElementById("score-s").addEventListener("input", showSelectedScore);
    document.getElementById("score-d").addEventListener("input", showSelectedScore);
    document.getElementById("score-e").addEventListener("input", showSelectedScore);

    //gaat de forms gaan openklappen en dichtklappen
    document.getElementById("bier-header").addEventListener("click", showForm);
    document.getElementById("cafe-header").addEventListener("click", showForm);
});


function showSelectedScore(e){
    let amount = " (Huidig: " + document.getElementById(getID(e)).value +")";
    document.getElementById(getID(e)+"-js").innerHTML = amount;
}

function getID(e){
    return e.target.id;
}

function splitID(id){
    let newID = id.split("-");
    return newID[0] + "-review-form";
}

function showForm(e){
    if(document.getElementById(splitID(getID(e))).classList.contains("hidden")){
        document.getElementById(splitID(getID(e))).classList.remove("hidden");
        document.getElementById(getID(e)+"-status").innerHTML="OPEN";
    } else {
        document.getElementById(splitID(getID(e))).classList.add("hidden");
        document.getElementById(getID(e)+"-status").innerHTML="GESLOTEN";
    }
}


