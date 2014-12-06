/* jslint node: true */
'use strict';

var _     = require('lodash');
var fs    = require('fs');
var bb    = require('bluebird');
var merge = require('deepmerge');

bb.promisifyAll(fs);

var output = process.argv[4];

var whereNumber = function(number){ return function(item){ return String(item.number) === String(number); }; };
var issueKey = _.property('number');

bb.join(
  fs.readFileAsync(process.argv[2], 'utf8').then(JSON.parse),
  fs.readFileAsync(process.argv[3], 'utf8').then(JSON.parse),
  function(x, y){
    var merged = _(x)
    .map(issueKey)
    .concat(_.map(y, issueKey))
    .uniq()
    .map(function(item){
      var item_x = _.find(x, whereNumber(item));
      var item_y = _.find(y, whereNumber(item));
      if (!_.isEmpty(item_x) && !_.isEmpty(item_y)){
        return merge(item_x, item_y);
      } else {
        return _.isEmpty(item_x) ? item_y : item_x;
      }
    })
    .value();

    return fs.writeFileAsync(output, JSON.stringify(merged, null, 2));
  }
)
.then(function(){
  console.log('Done.');
  process.exit(0);

})
.catch(function(err){
  console.log(err);
  process.exit(1);
});
