/*jslint browser:true, node: true */
/*jslint indent: 4 */
/*global $, alert */
/*jshint strict: true */
"use strict";

function checkConnection(e) {
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/,
        mail = $("input[name=email]"),
        passwd = $('input[name=pwd]');
    if (mail.val() === "" || !regex.test(mail.val())) {
        mail.attr('placeholder', 'Entrez un email valide !');
        e.preventDefault();
    }
    if (passwd.val() === "") {
        alert('Entrez votre mot de passe !');
        e.preventDefault();
    }
}

function checkRegister(e) {
    var regex = /^[a-zA-Z0-9._\-]+@[a-z0-9._\-]{2,}\.[a-z]{2,4}$/;
    var name = $('input[name=nom]');
    var pseudo = $('input[name=pseudo]');
    var email = $('input[name=mail]');
    var passwd = $('input[name=pass]');
    var passwd2 = $('input[name=pass2]');

    if (name.val() === "" || name.val() < 6) {
        name.attr('placeholder', "Entrez votre vrai nom/prénom !");
        e.preventDefault();
    }
    if (pseudo.val() < 4) {
        pseudo.attr('placeholder', 'Entrez un pseudo de 4 charactère mini.');
        e.preventDefault();
    }
    if (!regex.test(email.val())) {
        email.attr('placeholder', 'Entrez un email valide !');
        e.preventDefault();
    }
    if (passwd.attr('val').length < 6) {
        alert('Entrez un MdP de 6 char mini.');
        e.preventDefault();
    }
    if (passwd.attr('val') !== passwd2.attr('val') || passwd2.val() === "") {
        alert('Les 2 mot des passes sont différents !');
        e.preventDefault();
    }
}

$(document).ready(function () {
    $('input[name=connexion]').on('click', checkConnection);
    $('input[name=inscription]').on('click', checkRegister);
});