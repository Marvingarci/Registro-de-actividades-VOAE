require('./bootstrap');

import Alpine from 'alpinejs';

window.Swal = require('sweetalert2');

window.Alpine = Alpine;

var Turbolinks = require("turbolinks");

Turbolinks.start();

Alpine.start();
