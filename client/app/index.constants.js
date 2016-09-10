(function() {
    'use strict';

    angular
        .module('recert')
        .constant('RECERT_CONSTANTS', {
            'REST_API_BASE': '/api/v1',
            'SECURITY': {
                'LOGGED': false,
                'TOKEN': null,
                'ROLE': null
            },
            'API': {
                'LOGIN': {
                    'URI': '/login',
                    'METHOD': 'POST',
                    'PARAMS': {
                        'email': null,
                        'password': null
                    }
                }
            }
        });

})();
