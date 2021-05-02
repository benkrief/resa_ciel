/*! jQuery Validation Plugin - v1.13.0 - 7/1/2014
 * http://jqueryvalidation.org/
 * Copyright (c) 2014 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery","../jquery.validate.min"],a):a(jQuery)}(function(a){a.extend(a.validator.messages,{required:"Dieses Feld ist ein Pflichtfeld.",maxlength:a.validator.format("Geben Sie bitte maximal {0} Zeichen ein."),minlength:a.validator.format("Geben Sie bitte mindestens {0} Zeichen ein."),rangelength:a.validator.format("Geben Sie bitte mindestens {0} und maximal {1} Zeichen ein."),email:"Geben Sie bitte eine gültige E-Mail Adresse ein.",url:"Geben Sie bitte eine gültige URL ein.",date:"Bitte geben Sie ein gültiges Datum ein.",number:"Geben Sie bitte eine Nummer ein.",digits:"Geben Sie bitte nur Ziffern ein.",equalTo:"Bitte denselben Wert wiederholen.",range:a.validator.format("Geben Sie bitte einen Wert zwischen {0} und {1} ein."),max:a.validator.format("Geben Sie bitte einen Wert kleiner oder gleich {0} ein."),min:a.validator.format("Geben Sie bitte einen Wert größer oder gleich {0} ein."),creditcard:"Geben Sie bitte eine gültige Kreditkarten-Nummer ein."})});