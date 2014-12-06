(function(){
  'use strict';

  var app = angular.module('jeds');

  // src: http://codereview.stackexchange.com/questions/36664/number-to-roman-numeral
  function toRoman(n) {
    var r = '';
    var decimals = [1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1];
    var roman = ['M', 'CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I'];

    for (var i = 0; i < decimals.length; i++){
      while (n >= decimals[i]){
        r += roman[i];
        n -= decimals[i];
      }
    }
    return r;
  }

  app.filter('integerToRoman', function(){
    return function(n) {
      return toRoman(n);
    };
  });

})();