/* jslint node: true */
'use strict';

var _          = require('lodash');
var bb         = require('bluebird');
var fs         = require('fs');
var path       = require('path');
var walk       = require('walk');
var cloudinary = require('cloudinary');

bb.promisifyAll(fs);

cloudinary.config({
  cloud_name : 'jedbangers',
  api_key    : '118968316898979',
  api_secret : 'bVKthVhrBZgEW4vb5vChK9m-wXQ'
});

var dimensions = {
  cover: {
    width  : 270,
    height : 380
  },
  standard: {
    width  : 200,
    height : 200
  }
};

var getDimensions = function getDimensions(key){
  return _.isUndefined(dimensions[key]) ? dimensions.standard : dimensions[key];
};

function dirStructuretoJSON(index, value, levels, output){
  var level = levels[index];
  if (index >= levels.length - 2){
    if (_.isArray(output[level])){
      output[level].push(value);
    } else if (!_.isUndefined(output[level]) && !_.isNull(output[level])){
      output[level] = [ output[level], value ];
    } else {
      if (_.isArray(output)){
        output.push(value);
      } else {
        output[level] = value;
      }
    }
  } else {
    if (_.isEmpty(output[level])){
      output[level] = {};
    }
    dirStructuretoJSON(index + 1, value, levels, output[level]);
  }
}

function postProcessOutput(output){
  _.forEach(output, function(item, index){
    if (!_.isUndefined(item.content) && !_.isUndefined(item.content.sections)){

      var sections = item.content.sections;

      var postProcessSection = function(key){
        if (!_.isUndefined(sections[key]) && !_.isUndefined(sections[key].cover) && _.isArray(sections[key].cover)){
          sections[key] = _.map(sections[key].cover, function(item){
            return {
              cover: item
            };
          });
        }
      };

      _.forEach([
        'main_album_review',
        'desde_la_tumba',
        'painting_blood',
        'gracias_por_la_magia'
      ], function(section){
        postProcessSection(section);
      });
    }
  });
}

var folder = process.argv[2];

var walker = walk.walk(folder, {
  followLinks: false
});

var output = [];

walker.on('file', function (root, stats, next) {

  if (root.indexOf('ccc') !== -1){
    return next();
  }

  var ext       = path.extname(stats.name);
  var filename  = path.basename(stats.name, ext);
  var filepath  = path.join(root, stats.name);
  var dir       = path.relative(folder, root).replace(/\\/g, '/');

  var number    = parseInt(filename.split('_')[0], 10);

  console.log('Processing file ' + path.join(dir, filename + ext) + ' ...');

  var dimension = getDimensions(dir);

  cloudinary.uploader.upload(filepath, function(result) {

    var issueIndex = _.findIndex(output, { number: number });
    if (issueIndex === -1){
      issueIndex = output.push({
        number: number
      }) - 1;
    }

    dirStructuretoJSON(0, result.secure_url, path.join(dir, filename).split(path.sep), output[issueIndex]);

    next();

  }, {
    use_filename: true,
    folder: dir,
    tags: [ dir ],
    transformation: [{
      width  : dimension.width,
      height : dimension.height,
      crop   : 'scale'
    }]
  });
});

walker.on('errors', function (root, nodeStatsArray, next) {
  console.log(nodeStatsArray);
  process.exit(1);
});

walker.on('end', function () {
  postProcessOutput(output);

  fs.writeFileAsync(process.argv[3], JSON.stringify(output, null, 2))
  .then(function(){
    console.log('Done walking');
    process.exit(0);
  })
  .catch(function(err){
    console.error(err);
  });

});
