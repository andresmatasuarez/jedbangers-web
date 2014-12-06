(function(){
  'use strict';

  var CAPITAL = [
    { name: 'Kioscos de diarios y revistas',  zone: 'Capital y GBA',    address: '' },
    { name: 'Thor Records',                   zone: 'Recoleta',         address: 'Galería Bond Street – Av. Santa Fe 1670 – Local 51' },
    { name: 'Volumen 4',                      zone: 'San Cristóbal',    address: 'Galería Luxor – Lavalle 669 – Local 7' },
    { name: 'Puesto 87',                      zone: 'Caballito',        address: 'Parque Rivadavia – Av. Rivadavia 4900' },
    { name: 'Samy Records',                   zone: 'Paternal',         address: 'Av. San Martín 2245' },
    { name: 'BVM',                            zone: 'Belgrano',         address: 'Galería Recamier - Av. Cabildo 2136' },
    { name: 'In Concert',                     zone: 'Lomas de Zamora',  address: 'Laprida 175 - Local 22' },
    { name: 'Xennon',                         zone: 'Quilmes',          address: 'Yrigoyen 574 - Local 20' },
    { name: 'Xennon',                         zone: 'La Plata',         address: 'Calle 48 Altura 630 - Local 28' }
  ];

  var INTERIOR = [
    { name: 'Cienfuegos Rock',            zone: 'Bahía Blanca',           address: 'Donado 1140' },
    { name: 'Pesadilla',                  zone: 'Córdoba',                address: 'Galería Cinerama - Av. Colón 359 - Local 20' },
    { name: 'All Music',                  zone: 'San Salvador de Jujuy',  address: 'Galería Dera - Necoche 356 - Local 14' },
    { name: 'Compacto',                   zone: 'Mar del Plata',          address: 'Moreno 2319' },
    { name: 'Locuras',                    zone: 'Mar del Plata',          address: 'Peatonal San Martín 2339' },
    { name: 'Inferna',                    zone: 'Neuquén',                address: 'Av. Argentina 60 - Galería Iommi - Local 2' },
    { name: 'Mix Láser',                  zone: 'Neuquén',                address: 'Buenos Aires 392' },
    { name: 'Imperio Musical',            zone: 'Puerto Madryn',          address: 'Mitre 76 - Local 1' },
    { name: 'Kiosco Revistero El Botín',  zone: 'Puerto Madryn',          address: 'Plaza San Martín' },
    { name: 'Mithril',                    zone: 'Río Negro',              address: 'Roca 849' },
    { name: 'Utopía',                     zone: 'Rosario',                address: 'Maipú 778 - Local 8' },
    { name: 'Blood Vomit',                zone: 'Rosario',                address: 'Sarmiento 846 - Local 31' },
    { name: 'Kaos Rock',                  zone: 'Puerto Santa Cruz',      address: 'Belgrano 459' },
    { name: 'Compakta',                   zone: 'Río Gallegos',           address: 'Galería Mecor - Roca 1074 - Local 4' },
    { name: 'Swan Music',                 zone: 'Tucumán',                address: 'Galería La Gaceta - Mendoza 654 – Local 3' },
    { name: 'Kiosco Yunes',               zone: 'Tucumán',                address: '24 de Septiembre 549' },
    { name: 'Draco',                      zone: 'Tucumán',                address: 'Córdoba 578' },
    { name: 'Kiosco',                     zone: 'Tucumán',                address: '25 de mayo 513' },
    { name: 'La Rockería',                zone: 'Tucumán',                address: 'Buenos Aires 39 - Local 6' }
  ];

  var app = angular.module('jeds');

  app.controller('SellingPointsController', [
    '$scope',
    function($scope){
      $scope.capitalPoints = CAPITAL;
      $scope.interiorPoints = INTERIOR;
    }
  ]);

})();