"use strict";

document.addEventListener('DOMContentLoaded', init);

function init() {{}
    if( document.getElementById('registerLink')){
        document.getElementById('registerLink').addEventListener('click', function() {
            showFormLogin('hidden', '')
        });
    }
    if(document.getElementById('loginLink')){
        document.getElementById('loginLink').addEventListener('click', function() {
            showFormLogin('', 'hidden')
        });
    }

    if (document.getElementById('memeOpen')){
    document.getElementById('memeOpen').addEventListener('click', function () {
        document.getElementById('uploadMeme').className = "";
    });
}
    if (document.getElementById('issueOpen')){
        document.getElementById('issueOpen').addEventListener('click', function () {
            document.getElementById('uploadIssue').className = "";
        });
    }

    if (document.getElementById('memeClose')){
        document.getElementById('memeClose').addEventListener('click', function () {
            document.getElementById('uploadMeme').className = "hidden";
        });
    }

    if (document.getElementById('issueClose')) {
        document.getElementById('issueClose').addEventListener('click', function () {
            document.getElementById('uploadIssue').className = "hidden";
        });
    }
}

function showFormLogin(cssClassLogin, cssClassRegister) {
    document.getElementById('loginSection').className = cssClassLogin;
    document.getElementById('registerSection').className = cssClassRegister;
}