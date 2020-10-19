<?php
$databases['default']['default'] = array(
  'driver' => 'mysql',
  'database' => 'kyeol',
  'username' => 'vagrant',
  'password' => 'vagrant',
  'host' => '127.0.0.1',
  'charset' => 'utf8mb4',
  'collation' => 'utf8mb4_general_ci',
);

$settings['trusted_host_patterns'] = [
  '^localhost$'
];

$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;
$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
$settings['extension_discovery_scan_tests'] = FALSE;
