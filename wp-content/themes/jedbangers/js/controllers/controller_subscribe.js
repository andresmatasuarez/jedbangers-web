(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('SubscribeController', [ '$scope', '$http', 'vcRecaptchaService', 'API', 'templates', 'forms', 'contact', 'provinces', function($scope, $http, vcRecaptchaService, API, templates, forms, contact, provinces){

    $scope.model = {
      provinces            : provinces,
      faqTemplate          : templates.subscribe.faq,
      formTemplate         : templates.forms.subscription,
      contactTemplate      : templates.forms.contact,
      reason_enquiry : _.find(contact.reasons, function(type){
        return type.value === 'enquiry';
      })
    };

    API.magazines.getSubscriptionGifts()
    .then(function(magazines){
      $scope.model.giftMagazines = magazines;
    });

    $scope.init = function(token, recatchaPublicKey){
      $scope.model.key = recatchaPublicKey;
      $scope.model.form = {
        token: token
      };
    };

    $scope.changeCities = function(){
      if (!_.isUndefined($scope.model.form.province)){
        $scope.model.form.city = undefined;
        $scope.model.cities = undefined;
        API.cities.get($scope.model.form.province.code)
        .then(function(cities){
          $scope.model.cities = cities;
        });
      }
    };

    $scope.submit = function() {
      $scope.model.sending = true;
      $http({
        method  : 'POST',
        url     : forms.subscription,
        data    : jQuery.param({
          token         : $scope.model.form.token,
          recaptcha     : vcRecaptchaService.data(),
          first_name    : $scope.model.form.first_name,
          last_name     : $scope.model.form.last_name,
          email         : $scope.model.form.email,
          province      : $scope.model.form.province.name,
          city          : $scope.model.form.city,
          address       : $scope.model.form.address,
          zip_code      : $scope.model.form.zip_code,
          gift_magazine : $scope.model.form.gift_magazine,
          notes         : $scope.model.form.notes
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
