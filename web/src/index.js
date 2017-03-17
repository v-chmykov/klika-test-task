'use strict';

import angular from 'angular';
import routing from './app.config.js';
import tracklist from './tracklist';

angular.module('app', [tracklist])
  .config(routing);