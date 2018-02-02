// var moment = require('moment');
import 'bootstrap';
// si potrebbero anche importare in plugin indivuidualmente come:
// import 'bootstrap/js/dist/util';

import Test from './grid-buttons.jsx';

import moment from 'moment';

import './index.scss'; // Entry point css. Dentro importa gli stili di boostrap.

$(document).ready(function() { console.log('jQuery works!'); } );

console.log(moment().startOf('day').fromNow());