"use strict";

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("reg-pw").addEventListener("input", checkPw);
    document.getElementById("reg-pw-second").addEventListener("input", checkPw);
    document.getElementById("age").addEventListener("input", calculateDob);
    document.getElementById("noLogin").addEventListener("click", switchFormsReg);
    document.getElementById("yesLogin").addEventListener("click", switchFormsLog);
    document.getElementById("login").addEventListener("click", checkFormLog);
    document.getElementById("register").addEventListener("click", checkFormReg);
});

function checkPw(){
    let pw = document.getElementById("reg-pw").value;
    let pwSecond = document.getElementById("reg-pw-second").value;
    if(pwConditionCheck(pw) === true){
        pwRepeatCheck(pw, pwSecond);
    } else {
        displayMessage("pw-notice", "Zorg ervoor dat het wachtwoord minstens 1 kleine letter 1 hoofdletter 1 cijfer bevat.");
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

function disableButton(elementId, value){
    document.getElementById(elementId).disabled = value;
}

function hideShowItems(elementId, showOrHide){
    switch(showOrHide){
        case "hide":
            document.getElementById(elementId).classList.add("hidden");
            break;
        case "show":
            document.getElementById(elementId).classList.remove("hidden");
    }
}

function switchFormsReg(){
    hideShowItems("login-form", "hide");
    hideShowItems("register-form", "show");
}

function switchFormsLog(){
    hideShowItems("login-form", "show");
    hideShowItems("register-form", "hide");
}


function calculateDob(){
    let test = document.getElementById("age").value;
    getAge(test);
    getCheckboxState("acceptTC");
}

function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    showAgeMessage(age);
}

function showAgeMessage(age){
    if (age >= 16){
        displayMessage("age-notice", "U bent oud genoeg");
        disableButton("register", false);
    } else {
        displayMessage("age-notice", "U bent te jong");
        disableButton("register", true);
    }
}

function checkFormLog(){
    if(getValue("username") === "" || getValue("password") === ""){
        displayMessage("login-notice","Gelieve alle gegevens in te vullen");
    }
}

function checkFormReg(){
    //reg-name, reg-username, reg-pw, reg-pw-second, age, acceptTC
    if(getValue("reg-name") === "" || getValue("reg-username") === "" || getValue("reg-pw") === "" || getValue("reg-pw-second") === "" || getValue("age") === "" || getValue("acceptTC") === false){
        displayMessage("register-notice", "Gelieve alle gegevens in te vullen aub.");
    }
}

function getValue(elementId){
    return document.getElementById(elementId).value;
}

function getCheckboxState(elementId){
    return document.getElementById(elementId).checked;
}