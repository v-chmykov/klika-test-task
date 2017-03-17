import angular from 'angular';
import uiRouter from 'angular-ui-router';

import {routes} from './router.js';
import {TracklistController} from './controller.js';
import {TracklistService} from './service.js';

export default angular.module('app.tracklist', [uiRouter])
  .config(routes)
  .controller('TracklistController', TracklistController)
  .service('TracklistService', TracklistService)
  .name;
