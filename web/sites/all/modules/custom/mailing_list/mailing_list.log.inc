<?php

/**
 * @file
 * Log mailing list actions.
 */

/**
 * Obfuscate email address.
 */
function obfuscate_email_address($email) {
  $obfuscated = '';
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    list($first, $last) = explode('@', $email);
    $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first) - 3), $first);
    $last = explode('.', $last);
    $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0']) - 1), $last['0']);
    $obfuscated = $first . '@' . $last_domain . '.' . $last['1'];
  }
  return $obfuscated;
}

/**
 * Log an audit log.
 */
function mailing_list_log($id, $type, $action = 'view', $account = NULL, $url = NULL, $timestamp = REQUEST_TIME, $params = array()) {
  $label = $bundle = '';
  $types = ['mailing_list', 'mailing_list_email'];

  if (!in_array($type, $types)) {
    return;
  }
  elseif ($type == 'mailing_list_email') {
    $email = mailing_list_email_load($id);
    if ($email) {
      $label = obfuscate_email_address($email->mail);
      $mailing_list = mailing_list_get($email->mlid);
      $bundle = reset($mailing_list)->name;
    }
    else {
      return;
    }
  }
  elseif ($type == 'mailing_list') {
    $mailing_list = current(mailing_list_get($id));
    if ($mailing_list) {
      $label = $mailing_list->name;
      $bundle = NULL;
    }
    else {
      return;
    }
  }

  if (!$account) {
    global $user;
    $account = $user;
  }
  if (!$url) {
    $url = request_path();
  }
  $values = array(
    'entity_id' => $id,
    'entity_type' => $type,
    'entity_label' => $label,
    'bundle' => $bundle,
    'uid' => $account ? $account->uid : NULL,
    'url' => $url,
    'timestamp' => $timestamp,
    'audit_action' => $action,
  );

  if (isset($params) && is_array($params)) {
    foreach ($params as $property => $param) {
      $values[$property] = $param;
    }
  }

  $log = new Auditlog(array_filter($values));
  // Log the object.
  $log->log();
}
