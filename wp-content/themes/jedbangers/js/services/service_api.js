(function(){
	'use strict';

	var app = angular.module('jeds');

	app.service('API', ['Restangular', function(Restangular){
		return {
			records: {
				get: function(){
					return Restangular.one('wp-content/themes/jedbangers/json', 'records.json').get();
				}
			},

			books: {
				get: function(){
					return Restangular.one('wp-content/themes/jedbangers/json', 'books.json').get();
				}
			},

			magazines: {
				all: function(){
					return Restangular.one('wp-content/themes/jedbangers/json', 'magazines.json').get();
				},
				getOneByNumber: function(number){
					return Restangular.one('wp-content/themes/jedbangers/json', 'magazines.json').get()
					.then(function(magazines){
						return _.find(magazines, { number: number });
					});
				},
				getCurrent: function(){
					return Restangular.one('wp-content/themes/jedbangers/json', 'magazines.json').get()
					.then(function(magazines){
						return _(magazines)
						.sortBy('number')
						.last();
					});
				},
				getSubscriptionGifts: function(){
					return Restangular.one('wp-content/themes/jedbangers/json', 'magazines.json').get()
					.then(function(magazines){
						return _.filter(magazines, 'is_subscription_gift');
					});
				}
			},

			cities: {
				get: function(province_iso_code){
					// Removes 'AR-' and convert to lower case
					var code = province_iso_code.substring(3).toLowerCase();
					return Restangular.one('wp-content/themes/jedbangers/json/cities', code + '.json').get();
				}
			}
		};
	}]);


})();
