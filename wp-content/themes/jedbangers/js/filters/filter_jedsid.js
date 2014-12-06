(function(){
  'use strict';

  var app = angular.module('jeds');

  // src: https://gist.github.com/noeticpenguin/7948426
  app.filter('jedsId', function(){
    return function(id) {
      var str = id;
      if (id < 100) {
        str = '0' + str;
        if (id < 10) {
          str = '0' + str;
        }
      }
      return 'jeds' + str;
    };
  });

})();