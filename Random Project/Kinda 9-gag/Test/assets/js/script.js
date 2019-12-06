"use strict";

document.addEventListener('DOMContentLoaded', init);

function init() {
    document.getElementById('registerLink').addEventListener('click', function() {
        showFormLogin('hidden', '')
    });
    document.getElementById('loginLink').addEventListener('click', function() {
        showFormLogin('', 'hidden')
    });
}

function showFormLogin(cssClassLogin, cssClassRegister) {
    document.getElementById('loginSection').className = cssClassLogin;
    document.getElementById('registerSection').className = cssClassRegister;
}