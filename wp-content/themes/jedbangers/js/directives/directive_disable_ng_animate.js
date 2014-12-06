/**
 * Bug: UI-Bootstrap's carousel not working.
 * src: https://github.com/angular-ui/bootstrap/issues/1350
 */

(function(){
  'use strict';

  var app = angular.module('jeds');

  app.directive('disableNgAnimate', ['$animate', function($animate) {
    return {
      restrict: 'A',
      link: function(scope, element) {
        $animate.enabled(false, element);
      }
    };
  }]);

})();
