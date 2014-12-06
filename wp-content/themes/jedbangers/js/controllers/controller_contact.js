(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('ContactController', ['$scope', '$http', 'vcRecaptchaService', 'templates', 'forms', 'contact', function($scope, $http, vcRecaptchaService, templates, forms, contact){
    $scope.model = {
      reasons      : contact.reasons,
      formTemplate : templates.forms.contact
    };

    $scope.init = function(token, recatchaPublicKey){
      $scope.model.key = recatchaPublicKey;
      $scope.model.form = {
        token: token
      };
    };

    $scope.submit = function(){
      $scope.model.sending = true;
      $http({
        method  : 'POST',
        url     : forms.contact,
        data    : jQuery.param({
          token     : $scope.model.form.token,
          recaptcha : vcRecaptchaService.data(),
          full_name : $scope.model.form.full_name,
          email     : $scope.model.form.email,
          reason    : $scope.model.form.reason,
          subject   : $scope.model.form.subject,
          message   : $scope.model.form.message
        }),

        // Set the headers so angular passes info as form data (not request payload)
        headers : {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        }
      })
      .success(function(data, status, headers, config, statusText){
        $scope.model.sending = false;
        $scope.responseModal(data.message, false).result
        .then(undefined, function(){
          $scope.model.form.successfullySent = data.message;
        });
      })
      .error(function(data, status, headers, config, statusText) {
        $scope.model.sending = false;
        $scope.responseModal(data.message, true);
        vcRecaptchaService.reload();
      });
    };

  }]);

})();
