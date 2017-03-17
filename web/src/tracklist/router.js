function routes($stateProvider, $urlRouterProvider) {
  $stateProvider
    .state('tracklist', {
      url: '/',
      template: require('./template.html'),
      controller: 'TracklistController',
      controllerAs: 't'
    });
}

routes.$inject = ['$stateProvider', '$urlRouterProvider'];
export {routes}