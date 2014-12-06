'use strict';

var _  = require('lodash');
var bb = require('bluebird');
var fs = require('fs');

bb.promisifyAll(fs);

var file = process.argv[2];

fs.readFileAsync(file, 'utf8')
.then(JSON.parse)
.then(function(cities){
  return bb.all(_(cities)
  .groupBy('province_code')
  .map(function(group, key){
    return fs.writeFileAsync(key + '.json', JSON.stringify(_.uniq(group, 'name')));
  })
  .value());
})
.then(function(){
  process.exit(0);
})
.catch(function(err){
  console.error(err);
  process.exit(1);
});