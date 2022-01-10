<?php

/**
 * @file
 * Examples of valid statements for a Drush runtime config (drushrc) file
 */

$options['structure-tables']['common'] = [
  'cache',
  'cache_*',
  'history',
  'search_*',
  'sessions',
  'watchdog'
];
$options['skip-tables']['common'] = [
  'migration_*',
];
