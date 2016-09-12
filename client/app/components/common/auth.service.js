(function(){
    'use strict';

    angular
        .module('recert')
        .factory('Auth', AuthService);

    function AuthService($rootScope, $sessionStorage, $q, $http, RECERT_CONSTANTS){

        var auth = {};

        var Profile = function (params) {
            var defer = $q.defer();
            $http({
                url: RECERT_CONSTANTS.REST_API_BASE + RECERT_CONSTANTS.API.LOGIN.URI,
                method: RECERT_CONSTANTS.API.LOGIN.METHOD,
                data: angular.extend(RECERT_CONSTANTS.API.LOGIN.PARAMS, params)
            }).then(function(response) {
                defer.resolve(response.data);
            }, function() {
                defer.reject();
            });
            return defer.promise;
        };

        var userHasPermissionForView = function(view){
            if(!auth.isLoggedIn()){
                return false;
            }

            if(!view.permissions || !view.permissions.length){
                return true;
            }

            return auth.userHasPermission(view.permissions);
        };

        auth.init = function(){
            if (auth.isLoggedIn()){
                RECERT_CONSTANTS.SECURITY.LOGGED = $sessionStorage.logged;
                RECERT_CONSTANTS.SECURITY.ROLE = $sessionStorage.user_permission;
                RECERT_CONSTANTS.SECURITY.TOKEN = $sessionStorage.token;
            }
        };

        auth.login = function(cred){
            var defer = $q.defer();
            Profile(cred).then(function(data) {
                $sessionStorage.logged = true;
                $sessionStorage.token = data.token;
                $sessionStorage.user_permission = data.role | 'ADMIN';

                RECERT_CONSTANTS.SECURITY.LOGGED = true;
                RECERT_CONSTANTS.SECURITY.ROLE = data.role;
                RECERT_CONSTANTS.SECURITY.TOKEN = data.token;
                $rootScope.$broadcast('recert:jsevent:logged', {status: true});
                defer.resolve();
            }, function() {
                defer.reject();
            });
            return defer.promise;
        };

        auth.logout = function() {
            $sessionStorage.$reset();
            RECERT_CONSTANTS.SECURITY = {
                LOGGED: false,
                ROLE: '',
                TOKEN: null
            };
            $rootScope.$broadcast('recert:jsevent:logged', {status: false});
        };

        auth.checkPermissionForView = function(view) {
            if (!view.authentication) {
                return true;
            }
            return userHasPermissionForView(view);
        };

        auth.userHasPermission = function(permissions){
            if(!auth.isLoggedIn()){
                return false;
            }

            var found = false;
            angular.forEach(permissions, function(permission){
                if ($sessionStorage.user_permission === permission){
                    found = true;
                    return;
                }
            });

            return found;
        };

        auth.isLoggedIn = function(){
            return true;
            // return $sessionStorage.logged !== null
            //     && $sessionStorage.token !== null
            //     && $sessionStorage.role !== null;
        };

        return auth;
    }

})();
