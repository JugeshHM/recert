(function() {
    angular
        .module('recert')
        .directive('recertNavbar', RecertNavbar);

    function RecertNavbar () {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'app/components/navbar/navbar.html',
            controller: NavbarController,
            controllerAs: 'nc',
            bindToController: true
        }
    }

    function NavbarController($scope, $state, $log, $sessionStorage, Auth, RECERT_CONSTANTS){
        var vm = this;
        vm.user = $sessionStorage.user;
        vm.logged = RECERT_CONSTANTS.SECURITY.LOGGED;

        vm.logout = function(){
            Auth.logout();
            vm.logged = RECERT_CONSTANTS.SECURITY.LOGGED;
            $state.go("login", {}, {inherit: false, location: true});
        };

        $scope.$on('wps:jsevent:logged', function(event, params) {
            if (params.status === true) {
                vm.logged = RECERT_CONSTANTS.SECURITY.LOGGED;
                vm.user = $sessionStorage.user;
            }
            if (params.status === false) {
                vm.logged = RECERT_CONSTANTS.SECURITY.LOGGED;
            }
        });
    }

})();
