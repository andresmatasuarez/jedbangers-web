(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('RecordController', [
    '$scope', '$modal', 'templates',
    function($scope, $modal, templates){

      $scope.readBeforeBuyingModal = function(linkMP, linkJeds){
        var modal = $modal.open({
          templateUrl: templates.label.read_before_buying,
          controller: ['$scope', '$window', function($modalScope, $window){
            function ok(link){
              $window.open(link);
              modal.dismiss('ok');
            }

            $modalScope.linkToMP = function(){
              ok(linkMP);
            };

            $modalScope.linkToJeds = function(){
              ok(linkJeds);
            };

            $modalScope.cancel = function () {
              modal.dismiss('cancel');
            };
          }]
        });
      };

    }
  ]);

})();