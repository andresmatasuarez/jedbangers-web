(function(){
	'use strict';

	var app = angular.module('jeds');

	// src: https://gist.github.com/noeticpenguin/7948426
	app.filter('autolink', ['$sce', function($sce){
		var urlPattern = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/gi;
		return function(text, target, otherProp) {
			if(text === undefined ||
					text === null ) { return $sce.trustAsHtml(text);}
			angular.forEach(text.toString().match(urlPattern), function(url) {
				text = text.replace(url, "<a target=\"" + target + "\" href="+ url + ">" + url.substring(0,30) +"</a>");
			});
			return $sce.trustAsHtml(text);
		};
	}]);

})();