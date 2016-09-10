(function() {
    'use strict';

    angular
        .module('recert')
        .run(Init);

    function Init ($rootScope, $log, $state, $urlRouter, Auth, RECERT_CONSTANTS){

        var loggedinStateCall = $rootScope.$on('recert:jsevent:logged', function(event, params) {
            if (params.status === true) {
                $rootScope.logged = RECERT_CONSTANTS.SECURITY.LOGGED;
            }
            if (params.status === false) {
                $rootScope.logged = RECERT_CONSTANTS.SECURITY.LOGGED;
            }
        });

        var stateStartCall = $rootScope.$on('$stateChangeStart', function(event, state) {
            if (!Auth.checkPermissionForView(state.data)){
                event.preventDefault();
                $state.go("login", {}, {location: true, inherit: false});
            }
        });

        var stateSuccessCall = $rootScope.$on('$stateChangeSuccess', function(event, state) {
            $rootScope.pageTitle = (angular.isDefined(state.data.title) ? state.data.title + ' - ' : '') + 'Recert';
            $urlRouter.sync();
        });

        $rootScope.$on('$destroy', stateSuccessCall);
        $rootScope.$on('$destroy', stateStartCall);
        $rootScope.$on('$destroy', loggedinStateCall);
        $log.info('End Run Block');
    }

})();
