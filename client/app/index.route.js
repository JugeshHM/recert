(function(){

    'use strict';
    angular
        .module('recert')
        .config(routerConfig);

    function routerConfig($stateProvider, $urlRouterProvider){
        $stateProvider
            .state('site', {
                url: '',
                abstract: true
            })
        .state('login', {
            url: '/',
            parent: 'site',
            views: {
                'main@': {
                    templateUrl: 'app/login/login.html',
                    controller: 'LoginController',
                    controllerAs: 'lc'
                }
            },
            data: {}
        })
        .state('dashboard', {
            url: '/dashboard',
            parent: 'site',
            views: {
                'main@' : {
                    templateUrl: 'app/main/main.html',
                    controller: 'MainController',
                    controllerAs: 'mc'
                }
            },
            data: {
                authentication: true
            }
        });
        $urlRouterProvider.otherwise('/');
    }

})();
