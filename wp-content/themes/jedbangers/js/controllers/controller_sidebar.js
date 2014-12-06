(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('SidebarController', ['$scope', 'API', function($scope, API){

    API.magazines.getCurrent()
    .then(function(current){
      $scope.current = current;
    });

  }]);

})();
