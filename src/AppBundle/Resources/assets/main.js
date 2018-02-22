// var moment = require('moment');
import 'bootstrap';
// si potrebbero anche importare in plugin indivuidualmente come:
// import 'bootstrap/js/dist/util';

import React from 'react';
import ReactDOM from 'react-dom';
import GridButtons from './grid-buttons.jsx';

import './index.scss'; // Entry point css. Dentro importa gli stili di boostrap.

$(document).ready(function() { console.log('jQuery works!'); } );

$('[data-react-id="grid-row-buttons"]').each(function(i, el){
	let rowId = $(el).attr('data-sql-id');
	let entityUrl = $(el).attr('data-entity-url');
	let saveUrl = $(el).attr('data-save-url');
	ReactDOM.render(<GridButtons id={rowId} entityUrl={entityUrl} saveUrl={saveUrl} />, el);
});