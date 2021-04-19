<?php

/**
 * @file
 * Example of valid statements for an alias file.
 */

$aliases['local'] = [
  'uri' => 'http://localhost:8080',
  'root' => '/vagrant/web',
  'path-aliases' => [
    '%files' => 'sites/default/files',
    '%dump' => '../dump',
  ],
];
