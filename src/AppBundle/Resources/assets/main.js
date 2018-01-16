// var moment = require('moment');
import 'bootstrap';
// si potrebbero anche importare in plugin indivuidualmente come:
// import 'bootstrap/js/dist/util';

import moment from 'moment';

import './index.scss'; // Entry point css. Dentro importa gli stili di boostrap.

console.log(moment().startOf('day').fromNow());