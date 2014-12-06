(function(){
  'use strict';

  var app = angular.module('jeds', [
    'ngAnimate',
    'ngSanitize',
    'ui.bootstrap',
    'restangular',
    'vcRecaptcha'
  ]);

  // Set global configuration
  app.run(['$rootScope', '$modal', 'templates', function($rootScope, $modal, templates){

    // Set locale
    moment.locale('es');

    // Add as global objects
    $rootScope._ = _;
    $rootScope.moment = moment;
    $rootScope.Date = Date;

    $rootScope.paths = {
      getImagePath: function(imagePath){
        return App.template_url + '/img/' + (_.isEmpty(imagePath) ? '' : imagePath);
      }
    };

    // Global functions
    $rootScope.responseModal = function(data, is_error){
      return $modal.open({
        templateUrl: templates.modals.response,
        size: 'sm',
        controller: ['$scope', function($modalScope){
          $modalScope.params = {
            is_error: is_error,
            message: data
          };
        }]
      });
    };

    $rootScope.openModal = function(tpl, params){
      return $modal.open({
        templateUrl: tpl,
        size: 'lg',
        controller: ['$scope', function($modalScope){
          $modalScope.params = _.isEmpty(params) ? {} : params;
        }]
      });
    };

    $rootScope.openIssueModal = function(number){
      var modal = $modal.open({
        templateUrl: templates.modals.issue,
        size: 'lg',
        resolve: {
          issue: ['API', function(API){
            return API.magazines.getOneByNumber(number);
          }]
        },
        controller: ['$scope', '$window', 'issue', function($modalScope, $window, issue){
          $modalScope.issue = issue;
          $modalScope.cancel = function(){
            modal.dismiss('cancel');
          };
        }]
      });
    };

  }]);

})();
