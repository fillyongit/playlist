// var moment = require('moment');
import 'bootstrap';
//import './fontawesome-5.0.9/svg-with-js/js/fontawesome-all.min.js';
import './fontawesome-5.0.9/web-fonts-with-css/css/fontawesome-all.min.css';

// si potrebbero anche importare in plugin indivuidualmente come:
// import 'bootstrap/js/dist/util';

import React from 'react';
import ReactDOM from 'react-dom';

// Entry point css. Dentro importa gli stili di boostrap.
// Viene prima dell'importazione dei componenenti in modo
// che eventuali css specific dei componenenti possano
// sovrascrivere quelli del css base.
import './index.scss';

import GridButtons from './components/grid-buttons.jsx';

$(document).ready(function() { console.log('jQuery works!'); } );

$('[data-react-id="grid-row-buttons"]').each(function(i, el){
	let rowId = $(el).attr('data-sql-id');
	let token = $(el).attr('data-token');
	ReactDOM.render(<GridButtons id={rowId} token={token} />, el);
});