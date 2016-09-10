(function(){
    'use strict';

    angular
        .module('recert')
        .factory('RecertInterceptor', RecertInterceptor);

    function RecertInterceptor($q, $log, RECERT_CONSTANTS) {
        return {
            request : function(config) {
                if (angular.isDefined(config.url) && angular.isDefined(RECERT_CONSTANTS.SECURITY.TOKEN)) {

                    config.headers['Authorization'] = 'Bearer '+ RECERT_CONSTANTS.SECURITY.TOKEN;
                    config.headers['Content-Type'] = 'application/json';
                }
                return config;
            },

            response: function(response) {
                return response || $q.when(response);
            },

            requestError: function(rejection) {
                return $q.reject(rejection);
            },

            responseError: function(rejection) {
                return $q.reject(rejection);
            }
        };
    }
})();
