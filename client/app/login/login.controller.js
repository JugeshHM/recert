(function(){
    'use strict';

    angular
        .module('recert')
        .controller('LoginController', LoginController);

    function LoginController($state, $timeout, Auth, $log, RECERT_CONSTANTS) {
        if (RECERT_CONSTANTS.SECURITY.LOGGED === true) {
            $state.transitionTo('dashboard', {}, {inherit: false, location: true});
        }

        var vm = this;
        vm.failed = false;

        vm.auth = {
            email: null,
            password: null
        };

        vm.login = function() {
            Auth.login(vm.auth).then(function() {
                $state.transitionTo('dashboard', {}, {inherit: false, location: true});
            }, function() {
                vm.failed = true;
                $log.info("Login failed");
            });
        };
    }

})();
