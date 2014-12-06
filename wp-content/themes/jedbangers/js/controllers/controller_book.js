(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('BookController', ['$scope', '$modal', 'templates', function($scope, $modal, templates){
    $scope.gallery_id = 'gallery_' + $scope.book.b_id;

    $scope.openPurchaseModal = function(){
      var modal = $modal.open({
        templateUrl: templates.books.read_before_buying,
        controller: ['$scope', '$window', function($modalScope, $window){
          function ok(link){
            $window.open(link);
            modal.dismiss('ok');
          }

          $modalScope.cancel = function () {
            modal.dismiss('cancel');
          };
        }]
      });
    };

  }]);

})();