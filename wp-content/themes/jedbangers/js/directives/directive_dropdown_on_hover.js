(function(){
  'use strict';

  var app = angular.module('jeds');

  app.directive('dropdownOnHover', function () {
    return {
      restrict: 'A',
      link: function(scope, element, attrs) {
        element.bind('mouseenter', function(){
          element.addClass('open');
        });
        element.bind('mouseleave', function(){
          element.removeClass('open');
        });
      }
    };
  });

})();