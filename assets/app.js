/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap.js';
const $ = require('jquery');
// var dt = require( 'datatables.net' )();

// require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/popover');
require('bootstrap/js/dist/dropdown');

// require( 'jszip' );
// require( 'pdfmake' );
require( 'datatables.net-dt' )();
require( 'datatables.net-buttons-dt' )();
require( 'datatables.net-buttons/js/buttons.html5.js' )();
require( 'datatables.net-buttons/js/buttons.print.js' )();

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});






