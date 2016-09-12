(function() {
    'use strict';

    angular
        .module('recert')
        .controller('MainController', MainController);

    function MainController($state, $log, RECERT_CONSTANTS) {
        var vm = this;
        vm.auth = RECERT_CONSTANTS.SECURITY;
        if (vm.auth.LOGGED !== true) {
            $state.go('login');
            return false;
        }

    }
})();
