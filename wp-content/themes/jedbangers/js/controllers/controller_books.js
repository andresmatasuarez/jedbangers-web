(function(){
  'use strict';

  var app = angular.module('jeds');

  app.controller('BooksController', [ '$scope', 'API', 'templates', function($scope, API, templates){
    $scope.model = {
      bookTemplate         : templates.books.book,
      galleryModalTemplate : templates.modals.gallery
    };

    API.books.get()
    .then(function(books){
      $scope.books = _.sortBy(books, 'b_id').reverse();
    });
    }
  ]);

})();