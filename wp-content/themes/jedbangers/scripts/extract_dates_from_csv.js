/* jslint node: true */
'use strict';

var _      = require('lodash');
var bb     = require('bluebird');
var fs     = require('fs');
var parser = require('csv').parse;
var moment = require('moment');

parser = bb.promisify(parser);
bb.promisifyAll(fs);

var RADIX         = 10;
var COLUMN_NUMBER = 0;
var COLUMN_DATE   = 1;
var SKIP_FIRST    = 2;
var BASE_YEAR     = 2000;

var input  = process.argv[2];
var output = process.argv[3];

fs.readFileAsync(input, 'utf8')
.then(function(data){
  return parser(data);
})
.then(function(data){
  return _.times(data[COLUMN_NUMBER].length - SKIP_FIRST, function(i){
    var numberValue = data[COLUMN_NUMBER][i + SKIP_FIRST];
    var dateValue   = data[COLUMN_DATE][i + SKIP_FIRST];
    var month = dateValue.substring(0, dateValue.indexOf('-'));
    var year  = BASE_YEAR + parseInt(dateValue.substring(dateValue.indexOf('-') + 1), RADIX);

    var number = _.parseInt(numberValue);
    var date = moment().month(month).year(year).startOf('month');

    if (date.isValid() && !_.isNaN(number)){
      return {
        number : number,
        date   : date.toDate().toString()
      };
    } else {
      console.log('Invalid entry: ' + numberValue + ' - ' + dateValue);
      console.log(' Parsed as --> month: ' + month + '  - year: ' + year);
    }

  });
})
.then(_.compact)
.then(_.partialRight(JSON.stringify, null, 2))
.then(function(data){
  return fs.writeFileAsync(output, data);
})
.then(function(result){
  console.log('Done.');
  process.exit(0);
})
.catch(function(err){
  console.error(err);
  process.exit(1);
});
