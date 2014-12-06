(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('IssuesController', ['$scope', '$modal', 'templates', 'API', function($scope, $modal, templates, API){

    API.magazines.all()
    .then(function(issues){
      $scope.issues = _.sortBy(issues, _.property('number')).reverse();
    });

    $scope.emptyIssue = function(issue){
      return _.isUndefined(issue.number) || _.isEmpty(issue.title) || _.isEmpty(issue.content) || _.isEmpty(issue.content.main);
    };

    $scope.readBeforeBuyingModal = function(linkMP, linkJeds){
      var modal = $modal.open({
        templateUrl: templates.label.read_before_buying,
        scope: _.merge($scope.$new(true), {
          ok: function (link){
            $window.open(link);
            modal.dismiss('ok');
          },
          linkToMP: function(){
            ok(linkMP);
          },
          linkToJeds: function(){
            ok(linkJeds);
          },
          cancel: function(){
            modal.dismiss('cancel');
          }
        })
      });
    };

  }]);

})();
