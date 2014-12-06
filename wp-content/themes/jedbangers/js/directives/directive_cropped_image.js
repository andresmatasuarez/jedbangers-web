(function(){
  'use strict';

  var app = angular.module('jeds');

  app.directive('croppedImage', function () {
    return {
      restrict: 'E',
      replace: true,
      template: "<div class='center-cropped'></div>",
      link: function(scope, element, attrs) {
        element.css('width', attrs.width || '100%');
        element.css('height', attrs.height || '100%');
        element.css('background-position', (attrs.valign || 'center') + ' ' + (attrs.halign || 'center'));
        element.css('background-repeat', 'no-repeat');
        element.css('background-size', 'cover');
        element.css('background-image', "url('" + attrs.src + "')");
      }
    };
  });

})();