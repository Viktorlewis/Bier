"use strict";

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("reg-pw").addEventListener("input", checkPw);
    document.getElementById("reg-pw-second").addEventListener("input", checkPw);
});

function checkPw(){
    let pw = document.getElementById("reg-pw").value;
    let pwSecond = document.getElementById("reg-pw-second").value;
    
    //Later nog extra controle toevoegen (apparte functie enkel op reg-pw uitvoeren) --> Grote letter, kleine letter, cijfer, teken.
    if (pw === "" && pwSecond === ""){
        displayMessage("");
    }
    if(pw === pwSecond){
        displayMessage("Wachtwoorden komen overeen");
    } else {
        displayMessage("Wachtwoorden komen niet overeen");
    }
}

function displayMessage(message){
    document.getElementById("pw-notice").innerHTML = message;
}