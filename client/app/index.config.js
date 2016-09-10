(function() {
    'use strict';

    angular
        .module('recert')
        .config(config);

    /** @ngInject */
    function config($windowProvider, $logProvider, $httpProvider, $localStorageProvider, $sessionStorageProvider, $locationProvider) {
        var $window = $windowProvider.$get();
        // Enable log
        $logProvider.debugEnabled(true);
        $locationProvider.html5Mode(true);

        $httpProvider.interceptors.push('RecertInterceptor');

        $localStorageProvider.setKeyPrefix('west-chester-');
        $sessionStorageProvider.setKeyPrefix('west-chester-');
        var serialize = function(value){
            if (angular.isObject(value)) {
                value = angular.toJson(value);
            }
            value = $window.btoa(value);
            return value;
        };
        var deserialize = function(value) {
            value = $window.atob(value);
            try {
                value = angular.fromJson(value, true);
            } catch (error) {
                return {};
            }
            return value;
        };

        $localStorageProvider.setSerializer(serialize);
        $localStorageProvider.setDeserializer(deserialize);

        $sessionStorageProvider.setSerializer(serialize);
        $sessionStorageProvider.setDeserializer(deserialize);
    }

})();
