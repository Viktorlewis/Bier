"use strict";

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("reg-pw").addEventListener("input", checkPw);
    document.getElementById("reg-pw-second").addEventListener("input", checkPw);
    document.getElementById("age").addEventListener("input", calculateDob);
});

function checkPw(){
    let pw = document.getElementById("reg-pw").value;
    let pwSecond = document.getElementById("reg-pw-second").value;
    
    if(pwConditionCheck(pw) === true){
        pwRepeatCheck(pw, pwSecond);
    } else {
        displayMessage("pw-notice", "Zorg ervoor dat het wachtwoord minstens\n1 kleine letter\n1 hoofdletter\n1 cijfer bevat.");
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
        displayMessage("pw-notice", "Wachtwoorden komen overeen");
    } else {
        displayMessage("pw-notice", "Wachtwoorden komen niet overeen");
    }
}

function displayMessage(elementId, message){
    document.getElementById(elementId).innerHTML = "";
    document.getElementById(elementId).innerHTML = message;
}


function calculateDob(){
    let test = document.getElementById("age").value;
    getAge(test);
}

function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    console.log(age);
    showAgeMessage(age);
}

function showAgeMessage(age){
    if (age >= 16){
        displayMessage("age-notice", "U bent oud genoeg");
    } else {
        displayMessage("age-notice", "U bent te jong");
    }
}