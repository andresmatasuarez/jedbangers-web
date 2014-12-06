(function(){
  'use strict';

  var PREFIX_TEMPLATE = App.template_url + '/templates/';
  var PREFIX_FORM     = App.template_url + '/forms/';

  var app = angular.module('jeds');

  app.value('sections', {
    desde_el_pogo           : 'Desde el pogo',
    gracias_por_la_magia    : 'Gracias por la magia',
    main_album_review       : 'Review principal',
    top_ten                 : 'Top 10',
    poster                  : 'Poster',
    painting_blood          : 'Painting Blood',
    desde_la_tumba          : 'Desde La Tumba',
    historia_del_rock       : 'Historia Del Rock',
    sobrevivientes_del_rock : 'Sobrevivientes del Rock'
  });

  app.value('templates', {
    books: {
      book               : PREFIX_TEMPLATE + '_book.html',
      read_before_buying : PREFIX_TEMPLATE + '_book_read_before_buying.html'
    },
    label: {
      record             : PREFIX_TEMPLATE + '_record.html',
      read_before_buying : PREFIX_TEMPLATE + '_record_read_before_buying.html'
    },
    subscribe: {
      faq                : PREFIX_TEMPLATE + '_faq_subscriptions.html'
    },
    forms: {
      contact            : PREFIX_TEMPLATE + '_form_contact.html',
      subscription       : PREFIX_TEMPLATE + '_form_subscription.html'
    },
    modals: {
      gallery            : PREFIX_TEMPLATE + '_modal_gallery.html',
      response           : PREFIX_TEMPLATE + '_modal_response.html',
      issue              : PREFIX_TEMPLATE + '_modal_issue.html'
    }
  });

  app.value('forms', {
    contact      : PREFIX_FORM + 'form_contact.php',
    subscription : PREFIX_FORM + 'form_subscription.php'
  });

  app.value('contact', {
    reasons: [
      { value: 'enquiry',   label: 'Consultas' },
      { value: 'complaint', label: 'Reclamos' },
      { value: 'difussion', label: 'Bandas/Difusión' },
      { value: 'other',     label: 'Otros' }
    ]
  });

  app.value('provinces', [
    // code: ISO 3166-2:AR code
    // fips: FIPS 10-4 code
    { code: 'AR-C', fips: 'AR07', abbr: 'cf', name: 'Ciudad Autónoma de Buenos Aires',  },
    { code: 'AR-B', fips: 'AR01', abbr: 'ba', name: 'Buenos Aires',                     },
    { code: 'AR-K', fips: 'AR02', abbr: 'ct', name: 'Catamarca',                        },
    { code: 'AR-H', fips: 'AR03', abbr: 'cc', name: 'Chaco',                            },
    { code: 'AR-U', fips: 'AR04', abbr: 'ch', name: 'Chubut',                           },
    { code: 'AR-X', fips: 'AR05', abbr: 'cb', name: 'Córdoba',                          },
    { code: 'AR-W', fips: 'AR06', abbr: 'cn', name: 'Corrientes',                       },
    { code: 'AR-E', fips: 'AR08', abbr: 'er', name: 'Entre Ríos',                       },
    { code: 'AR-P', fips: 'AR09', abbr: 'fm', name: 'Formosa',                          },
    { code: 'AR-Y', fips: 'AR10', abbr: 'jy', name: 'Jujuy',                            },
    { code: 'AR-L', fips: 'AR11', abbr: 'lp', name: 'La Pampa',                         },
    { code: 'AR-F', fips: 'AR12', abbr: 'lr', name: 'La Rioja',                         },
    { code: 'AR-M', fips: 'AR13', abbr: 'mz', name: 'Mendoza',                          },
    { code: 'AR-N', fips: 'AR14', abbr: 'mn', name: 'Misiones',                         },
    { code: 'AR-Q', fips: 'AR15', abbr: 'nq', name: 'Neuquén',                          },
    { code: 'AR-R', fips: 'AR16', abbr: 'rn', name: 'Río Negro',                        },
    { code: 'AR-A', fips: 'AR17', abbr: 'sa', name: 'Salta',                            },
    { code: 'AR-J', fips: 'AR18', abbr: 'sj', name: 'San Juan',                         },
    { code: 'AR-D', fips: 'AR19', abbr: 'sl', name: 'San Luis',                         },
    { code: 'AR-Z', fips: 'AR20', abbr: 'sc', name: 'Santa Cruz',                       },
    { code: 'AR-S', fips: 'AR21', abbr: 'sf', name: 'Santa Fe',                         },
    { code: 'AR-G', fips: 'AR22', abbr: 'se', name: 'Santiago del Estero',              },
    { code: 'AR-V', fips: 'AR23', abbr: 'tf', name: 'Tierra del Fuego',                 },
    { code: 'AR-T', fips: 'AR24', abbr: 'tm', name: 'Tucumán'                           }
  ]);

/*
    { geoname_id: '3433955', code: 'AR.07', name: 'Ciudad Autónoma de Buenos Aires' },
    { geoname_id: '3435907', code: 'AR.01', name: 'Buenos Aires'                    },
    { geoname_id: '3862286', code: 'AR.02', name: 'Catamarca'                       },
    { geoname_id: '3861887', code: 'AR.03', name: 'Chaco'                           },
    { geoname_id: '3861244', code: 'AR.04', name: 'Chubut'                          },
    { geoname_id: '3860255', code: 'AR.05', name: 'Cordoba'                         },
    { geoname_id: '3435214', code: 'AR.06', name: 'Corrientes'                      },
    { geoname_id: '3434137', code: 'AR.08', name: 'Entre Rios'                      },
    { geoname_id: '3433896', code: 'AR.09', name: 'Formosa'                         },
    { geoname_id: '3853404', code: 'AR.10', name: 'Jujuy'                           },
    { geoname_id: '3849574', code: 'AR.11', name: 'La Pampa'                        },
    { geoname_id: '3848949', code: 'AR.12', name: 'La Rioja'                        },
    { geoname_id: '3844419', code: 'AR.13', name: 'Mendoza'                         },
    { geoname_id: '3430657', code: 'AR.14', name: 'Misiones'                        },
    { geoname_id: '3843122', code: 'AR.15', name: 'Neuquen'                         },
    { geoname_id: '3838830', code: 'AR.16', name: 'Rio Negro'                       },
    { geoname_id: '3838231', code: 'AR.17', name: 'Salta'                           },
    { geoname_id: '3837152', code: 'AR.18', name: 'San Juan'                        },
    { geoname_id: '3837029', code: 'AR.19', name: 'San Luis'                        },
    { geoname_id: '3836350', code: 'AR.20', name: 'Santa Cruz'                      },
    { geoname_id: '3836276', code: 'AR.21', name: 'Santa Fe'                        },
    { geoname_id: '3835868', code: 'AR.22', name: 'Santiago del Estero'             },
    { geoname_id: '3834450', code: 'AR.23', name: 'Tierra del Fuego'                },
    { geoname_id: '3833578', code: 'AR.24', name: 'Tucumán'                         }
*/

})();
