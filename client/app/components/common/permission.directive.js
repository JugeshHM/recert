(function() {
    'use strict';

    angular
        .module('recert')
        .directive('permission', Permission);

    function Permission (Auth) {
        return {
            restrict: 'A',
            scope: {
                permission: '='
            },
            link: function (scope, elem) {
                scope.$watch(Auth.isLoggedIn, function() {
                    if (!Auth.userHasPermission(scope.permission)) {
                        angular.element(elem).remove();
                    }
                });
            }
        };
    }

})();
