// var moment = require('moment');
import 'bootstrap';
// si potrebbero anche importare in plugin indivuidualmente come:
// import 'bootstrap/js/dist/util';

import React from 'react';
import ReactDOM from 'react-dom';
import GridButtons from './grid-buttons.jsx';
import ArtistForm from './artist-form.jsx';

import moment from 'moment';

import './index.scss'; // Entry point css. Dentro importa gli stili di boostrap.

$(document).ready(function() { console.log('jQuery works!'); } );

console.log(moment().startOf('day').fromNow());

$('[data-react-id="grid-row-buttons"]').each(function(i, el){
	ReactDOM.render(<GridButtons/>, el);
});

$('[data-react-id="form"]').each(function(i, el){
	ReactDOM.render(<ArtistForm/>, el);
});