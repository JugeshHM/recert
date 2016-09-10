(function() {
    'use strict';

    angular
        .module('recert')
        .controller('MainController', MainController);

    function MainController($log, RECERT_CONSTANTS) {
        var vm = this;
        vm.logged = RECERT_CONSTANTS.SECURITY.LOGGED;
        $log.debug('in Dashboard');
    }
})();
