(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('LabelController', [
    '$scope', 'API', 'templates',
    function($scope, API, templates){

      $scope.model = {
        recordTemplate: templates.label.record
      };

      API.records.get()
      .then(function(records){
        $scope.records = _.sortBy(records, 'r_id').reverse();
      });

    }
  ]);

})();