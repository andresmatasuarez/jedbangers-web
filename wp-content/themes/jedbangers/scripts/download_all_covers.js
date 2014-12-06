/* jslint node: true */
'use strict';

var _    = require('lodash');
var bb   = require('bluebird');
var fs   = require('q-io/fs');
var http = require('q-io/http');

var input = require('./covers_and_store_links');

var OUTPUT_DIR = 'scripts/img/cover/';
var EXTS = {
  'image/jpeg' : 'jpg',
  'image/png'  : 'png',
  'image/gif'  : 'gif'
};

fs.makeDirectory(OUTPUT_DIR)
.catch(function(){
  console.log('Directory already exists. Proceeding with execution...');
})
.then(function(){
  return bb.resolve(_.filter(input, function(item){
    return !_.isEmpty(item.cover);
  }))
  .map(function(item){
    console.log('Downloading ' + item.cover + '...');
    return http.request(item.cover)
    .then(function(res){
      return res.body.read()
      .then(function(data){
        var ext = EXTS[res.headers['content-type']];
        return fs.write(OUTPUT_DIR + item.number + '.' + ext, data);
      });
    })
    .then(function(){
      console.log('File ' + OUTPUT_DIR + item.number + ' downloaded successfully.');
    });
  });
})
.then(function(){
  console.log('Done.');
  process.exit(0);
});