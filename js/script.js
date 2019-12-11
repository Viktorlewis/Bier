"use strict";

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("reg-pw").addEventListener("input", checkPw);
    document.getElementById("reg-pw-second").addEventListener("input", checkPw);
});

function checkPw(){
    let pw = document.getElementById("reg-pw").value;
    let pwSecond = document.getElementById("reg-pw-second").value;
    
    if(pwConditionCheck(pw) === true){
        pwRepeatCheck(pw, pwSecond);
    } else {
        displayMessage("Zorg ervoor dat het wachtwoord minstens\n1 kleine letter\n1 hoofdletter\n1 cijfer bevat.");
    }
}

function pwConditionCheck(pw){
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    return re.test(pw);
}

function pwRepeatCheck(pw, pwSecond){
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