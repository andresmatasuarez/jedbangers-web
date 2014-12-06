/* jslint node: true */
'use strict';

var cloudinary = require('cloudinary');

cloudinary.config({
  cloud_name : 'jedbangers',
  api_key    : '118968316898979',
  api_secret : 'bVKthVhrBZgEW4vb5vChK9m-wXQ'
});

cloudinary.api.delete_all_resources(function(result){
  console.log('Done.');
  process.exit(0);
}, {
  type: 'upload'
});
