(function(){
  'use strict';

  var app = angular.module('jeds');

  app.filter('sectionLabel', ['sections', function(sections){
    return function(section) {
      return sections[section];
    };
  }]);

})();