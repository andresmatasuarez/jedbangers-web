(function(){
	'use strict';

	var app = angular.module('jeds');

	app.filter('utc', function(){
		return function(date, formatString){
			return moment(date).utc().format(formatString);
		};
	});

})();