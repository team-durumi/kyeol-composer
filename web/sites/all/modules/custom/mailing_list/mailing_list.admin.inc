<?php

/**
 * @file
 * Mailing list admin UI.
 */

require_once dirname(__FILE__) . '/mailing_list.log.inc';

/**
 * Menu callback; displays all mailing lists in a table.
 *
 * /admin/structure/mailing-list
 * 메일링 리스트 목록 조회.
 */
function mailing_list_lists() {
  $header = [
    ['data' => t('Name'), 'field' => 'name'],
    ['data' => t('Operations'), 'colspan' => '5'],
  ];

  $lists = mailing_list_get();
  $rows = [];
  $destination = drupal_get_destination();
  foreach ($lists as $mlid => $list) {
    $row = [
      l(check_plain($list->name), "admin/structure/mailing-list/$list->mlid"),
      l(t('list e-mails'), "admin/structure/mailing-list/$list->mlid"),
      l(t('import e-mails'), "admin/structure/mailing-list/$list->mlid/import", ['query' => $destination]),
      l(t('export list'), "admin/structure/mailing-list/$list->mlid/export", ['query' => $destination]),
      l(t('rename list'), "admin/structure/mailing-list/$list->mlid/edit", ['query' => $destination]),
      l(t('delete list'), "admin/structure/mailing-list/$list->mlid/delete", ['query' => $destination]),
    ];
    $rows[] = $row;
  }

  if (empty($rows)) {
    $empty_message = t('No mailing lists found.');
    $rows[] = [['data' => $empty_message, 'colspan' => 6]];
  }
  // @todo Perhaps change to $build arrays or even table select?
  $output = theme('table', ['header' => $header, 'rows' => $rows]);

  return $output;
}

/**
 * Menu callback; displays all e-mails for the specified mailing list in a
 * table.  Also routes to delete operation if selected.
 *
 * Hack inspired by user.module.
 */
function mailing_list_emails_list($list) {
  if (!empty($_POST['mails']) && isset($_POST['operation']) && ($_POST['operation'] == 'delete')) {
    $build['mailing_list_email_delete_multiple_confirm'] = drupal_get_form('mailing_list_email_delete_multiple_confirm_form');
  }
  else {
    $build['mailing_list_emails_form'] = drupal_get_form('mailing_list_emails_form', $list);
  }
  return $build;
}

/**
 * Menu callback; displays all e-mails for the specified mailing list in a
 * table.
 */
function mailing_list_emails_form($form, &$form_state, $list = NULL) {
  if (empty($list)) {
    return;
  }
  else {
    drupal_set_title(check_plain($list->name));
  }

  $header = [
    'id' => ['data' => t('ID'), 'field' => 'mle.eid', 'sort' => 'desc'],
    'mail' => ['data' => t('E-mail'), 'field' => 'mle.mail'],
    'name' => ['data' => t('Name'), 'field' => 'mle.name'],
    'source' => ['data' => t('Source'), 'field' => 'mle.source'],
    'created' => ['data' => t('Created'), 'field' => 'mle.created'],
    'operations' => ['data' => t('Operations')],
  ];

  $query = db_select('mailing_list_emails', 'mle')
    ->condition('mlid', $list->mlid);

  $count_query = clone $query;
  $count_query->addExpression('COUNT(mle.eid)');

  $query = $query->extend('PagerDefault')->extend('TableSort');
  $query
    ->fields('mle')
    ->limit(variable_get('mailing_list_limit', MAILING_LIST_LIMIT))
    ->orderByHeader($header)
    ->setCountQuery($count_query);
  $result = $query->execute();

  $rows = [];
  $destination = drupal_get_destination();
  foreach ($result as $data) {
    // Edit link is broken, see http://drupal.org/node/704564
    $rows[$data->eid] = [
      'id' => $data->eid,
      'mail' => check_plain($data->mail),
      'name' => (!empty($data->name)) ? check_plain($data->name) : '',
      'source' => check_plain($data->source),
      'created' => format_date($data->created),
      'operations' => l(t('edit'), "admin/structure/mailing-list/$list->mlid/$data->eid", ['query' => $destination]), l(t('delete'), "admin/structure/mailing-list/$list->mlid/$data->eid/delete", ['query' => $destination]),
    ];
  }

  $form['operation'] = [
    '#type' => 'hidden',
    '#value' => 'delete',
  ];

  $form['mails'] = [
    '#type' => 'tableselect',
    '#header' => $header,
    '#options' => $rows,
    '#empty' => t('No content available.'),
  ];

  $form['pager'] = ['#markup' => theme('pager', ['tags' => NULL])];

  $form['submit'] = [
    '#type' => 'submit',
    '#value' => t('Delete selected'),
  ];

  // Log export.
  if (!empty($list) && count($rows) > 0) {
    $message = t('Read emails of mailing list %name (#%mlid) - emails: [ %eids ]', [
      '%name' => $list->name,
      '%mlid' => $list->mlid,
      '%eids' => implode(', ', array_keys($rows)),
    ]);
    drupal_set_message($message);
    mailing_list_log($list->mlid, 'mailing_list_email', 'read', [
      'message' => strip_tags($message)
    ]);
  }

  return $form;
}

/**
 * 메일링 리스트 이메일 목록 폼에서 실행할 작업 검사.
 *
 * /admin/structure/mailing-list/{{ mlid }}
 */
function mailing_list_emails_form_validate($form, &$form_state) {
  $operation = $form_state['values']['operation'];
  if (!$operation) {
    form_set_error('operation', 'No operation selected');
  }
}

/**
 * 메일링 리스트 이메일 목록 폼 작업 실행.
 *
 * /admin/structure/mailing-list/{{ mlid }}
 */
function mailing_list_emails_form_submit(&$form, &$form_state) {
  if ($form_state['values']['operation'] == 'delete') {
    // This stupid hack is is from user.module.  How to get a confirm form to show
    // when you can't just pass the values via GET?  This is a problem.
    return;
  }

  // If other operations come into existance, they could happen here.
  $operation = $form_state['values']['operation'];
  $mails = $form_state['values']['mails'];
  $func = 'mailing_list_bulk_operation_' . $operation;
  if (!function_exists($func)) {
    // I'm not t()'ing this because no one will translate it anyway, and no one should see it.
    throw new Exception('Unable to process form, ' . $func . ' does not exist');
  }
  $mails = array_keys(array_filter($mails));
  call_user_func_array($func, [$mails]);
}

/**
 * 메일링 리스트 이메일 삭제 확인 폼.
 *
 * /admin/structure/mailing-list/{{ mlid }}
 */
function mailing_list_email_delete_multiple_confirm_form($form, &$form_state) {
  $edit = $form_state['input'];

  if ($mails = array_filter($edit['mails'])) {
    $result = db_select('mailing_list_emails', 'mle')
      ->fields('mle')
      ->condition('eid', $mails, 'IN')
      ->execute();

    $form['mails'] = ['#prefix' => '<ul>', '#suffix' => '</ul>', '#tree' => TRUE];
    foreach ($result as $row) {
      $form['mails'][$row->eid] = [
        '#type' => 'hidden',
        '#value' => $row->eid,
        '#prefix' => '<li>',
        '#suffix' => check_plain($row->name . ' <' . $row->mail . '>') . "</li>\n",
      ];
    }
  }
  else {
    drupal_set_message(t('Error, no mails were selected'), 'error');
    drupal_goto();
    return;
  }
  $form['operation'] = ['#type' => 'hidden', '#value' => 'delete'];

  return confirm_form($form,
      t('Are you sure you want to delete these emails?'),
      'admin/people', t('This action cannot be undone.'),
      t('Delete emails from list'), t('Cancel'));
}

/**
 * Deletes multiple emails from admin listing screen.
 *
 * @param array $emails
 *
 * @return void
 */
function mailing_list_email_delete_multiple_confirm_form_submit($form, &$form_state) {
  $mails = array_filter($form_state['values']['mails']);
  $result = db_delete('mailing_list_emails')
    ->condition('eid', $mails, 'IN')
    ->execute();

  $message = t('Deleted %count emails from the database', [
    '%count' => count($mails),
  ]);
  drupal_set_message($message);
  foreach ($mails as $eid) {
    mailing_list_log($eid, 'mailing_list_email', 'delete', [
      'source' => 'admin',
      'message' => $message,
    ]);
  }
}

/**
 * Form for adding / renaming a mailing list.
 */
function mailing_list_form($form, &$form_state, $list = NULL) {
  if (empty($list)) {
    drupal_set_title(t('Add mailing list'));
  }
  else {
    drupal_set_title(t('Edit mailing list'));
  }

  $form = [];
  if (isset($form_state['values']['mlid']) || !empty($list)) {
    $form['mlid'] = [
      '#type' => 'hidden',
      '#value' => isset($form_state['values']['mlid']) ? $form_state['values']['mlid'] : isset($list) ? $list->mlid : NULL,
    ];
  }

  $form['name'] = [
    '#title' => t('List name'),
    '#type' => 'textfield',
    '#required' => TRUE,
    '#default_value' => isset($form_state['values']['name']) ? $form_state['values']['name'] : isset($list) ? $list->name : '',
  ];

  $form['submit'] = [
    '#value' => t('Save'),
    '#type' => 'submit',
    '#submit' => ['mailing_list_form_submit'],
  ];

  $form['#redirect'] = 'admin/structure/mailing-list';

  return $form;
}

/**
 * Submit handler for the add / rename mailing list form.
 */
function mailing_list_form_submit($form, &$form_state) {
  // @todo put these in variables and on the settings page.
  $messages = [];

  $messages['update'] = [
    'pass' => 'Renamed mailing list %name',
    'fail' => 'Failed to update mailing list %name',
  ];

  $messages['insert'] = [
    'pass' => 'Created mailing list %name',
    'fail' => 'Failed to create mailing list %name',
  ];

  // List object to save.
  $list = new StdClass();
  $list->name = $form_state['values']['name'];

  if (!empty($form_state['values']['mlid'])) {
    // Update operation.
    $list->mlid = $form_state['values']['mlid'];
    $active_messages = $messages['update'];
    $list->updated = time();
  }
  else {
    $list->created = time();
    $list->updated = 0;
    $active_messages = $messages['insert'];
  }

  try {
    $result = mailing_list_save($list);
    $message = t($active_messages['pass'], ['%name' => $form_state['values']['name']]);
    drupal_set_message($message);
    watchdog('mailing_list', $active_messages['pass'], ['%name' => $form_state['values']['name']], WATCHDOG_NOTICE, l(t('view'), 'admin/structure/mailing-list/' . $list->mlid));
    if ($result == SAVED_NEW) {
      mailing_list_log($list->mlid, 'mailing_list', 'create', ['message' => '']);
    }
    if ($result == SAVED_UPDATED) {
      mailing_list_log($list->mlid, 'mailing_list', 'update', ['message' => '']);
    }
  }
  catch (PDOException $e) {
    $message = t($active_messages['fail'], ['%name' => $form_state['values']['name']]);
    drupal_set_message($message, 'error');
    watchdog('mailing_list', $active_messages['fail'], ['%name' => $form_state['values']['name']], WATCHDOG_NOTICE);
  }
}

/**
 * Mailing list deletion form.
 *
 * @todo D7 Upgrade this/
 */
function mailing_list_delete_confirm($form, $form_state, $list) {
  if (user_access('administer mailing lists')) {
    $form['mlid'] = ['#type' => 'value', '#value' => $list->mlid];
    $form['name'] = ['#type' => 'value', '#value' => $list->name];
    $output = confirm_form($form,
      t('Are you sure you want to delete mailing list %name? All e-mails in this list will be deleted too.', ['%name' => $list->name]),
      isset($_GET['destination']) ? $_GET['destination'] : 'admin/structure/mailing-list');
  }
  return $output;
}

/**
 * Submit handler for the mailing list deletion form.
 *
 * @todo D7 Upgrade this.
 */
function mailing_list_delete_confirm_submit($form, &$form_state) {
  if ($form_state['values']['confirm']) {
    $mlid = $form_state['values']['mlid'];
    mailing_list_delete($mlid);
    // Remove corresponding block from all themes.
    module_invoke('block', 'flush_caches');
    $name = $form_state['values']['name'];
    drupal_set_message(t('Deleted mailing list %name.', ['%name' => $name]));
    watchdog('mailing list', 'Mailing list: deleted list %name.', ['%name' => $name]);
    mailing_list_log($mlid, 'mailing_list', 'delete', [
      'entity_label' => $name,
      'message' => '',
    ]);
    $form_state['redirect'] = 'admin/structure/mailing-list';
    return;
  }
}

/**
 * Form for importing a mailing list from a CSV file.
 */
function mailing_list_import_form($form, $form_state, $list) {
  if (empty($list)) {
    return;
  }

  drupal_set_title(t('Import e-mails'));

  $form = [];
  $form['#attributes'] = ['enctype' => "multipart/form-data"];
  if (isset($mlid) || isset($list)) {
    $form['mlid'] = [
      '#type'       => 'hidden',
      '#value'      => isset($form_state['values']['mlid']) ? $form_state['values']['mlid'] : isset($list) ? $list->mlid : NULL,
    ];
  }
  if (isset($form_state['values']['name']) || isset($list)) {
    $form['name'] = [
      '#type'       => 'hidden',
      '#value'      => isset($form_state['values']['name']) ? $form_state['values']['name'] : isset($list) ? $list->name : NULL,
    ];
  }
  $form['file_upload'] = [
    '#title'      => t('CSV file'),
    '#type'       => 'file',
  ];
  $form['submit'] = [
    '#value'      => t('Import'),
    '#type'       => 'submit',
  ];
  return $form;
}

/**
 * Submit handler for the mailing list import form.
 *
 * @todo D7, queries
 */
function mailing_list_import_form_submit($form, &$form_state) {
  $num_imported = 0;
  $mlid = $form_state['values']['mlid'];

  if ($file = file_save_upload('file_upload', ['file_validate_extensions' => ['csv']])) {
    ini_set('auto_detect_line_endings', TRUE);
    $handle = @fopen($file->uri, 'r');
    while (($data = fgetcsv($handle)) !== FALSE) {
      $num_fields = count($data);
      $is_existing = mailing_list_email_get_by_email($mlid, $data[0]);
      if (!$is_existing && $num_fields == 2) {
        $mle = new StdClass();
        $mle->mlid = $mlid;
        $mle->mail = $data[0];
        $mle->name = $data[1];
        $mle->source = 'import';
        $mle->created = REQUEST_TIME;
        if (mailing_list_email_save($mle)) {
          $eid = db_query('SELECT MAX(eid) FROM {mailing_list_emails}')->fetchField();
          mailing_list_log($eid, 'mailing_list_email', 'create', [
            'entity_id' => $eid,
            'entity_label' => obfuscate_email_address($data[0]),
          ]);
        }
        $num_imported++;
      }
    }

    fclose($handle);

    if ($num_imported) {
      $message = t('Import complete: %num-imported added to mailing list %name.', [
        '%num-imported' => format_plural($num_imported, '1 e-mail', '@count e-mails'),
        '%name' => $form_state['values']['name']
      ]);
      drupal_set_message($message);
      mailing_list_log($mlid, 'mailing_list', 'import', ['message' => strip_tags($message)]);
    }
  }

  if (!$num_imported) {
    drupal_set_message(t('No e-mails added to mailing list: invalid or empty file.'), 'error');
  }

  $form_state['redirect'] = 'admin/structure/mailing-list/' . $form_state['values']['mlid'];

  return;
}

/**
 * Menu callback; exports a mailing list directly to the user as a CSV file.
 */
function mailing_list_export($list) {
  // Create file to hold email list.
  $filename = 'mlid-' . drupal_strtolower(str_replace(' ', '_', $list->mlid));
  $filename .= '-' . REQUEST_TIME . '.csv';
  $full_path = 'temporary' . '://' . $filename;

  $result = mailing_list_email_get_by_list($list->mlid, 0, 0);
  if (count($result) == 0) {
    drupal_set_message('Cowardly refusing to export an empty mailing list');
    drupal_goto('admin/structure/mailing-list/' . $list->mlid);
  }

  // Log export.
  $message = t('Export complete: %rows exported from mailing list %name. (#%mlid)', [
    '%rows' => count($result),
    '%name' => $list->name,
    '%mlid' => $list->mlid,
  ]);
  drupal_set_message($message);
  mailing_list_log($list->mlid, 'mailing_list', 'export', [
    'message' => strip_tags($message)
  ]);

  // Create string with all the emails.
  foreach ($result as $row) {
    $emails[] = '"' . trim($row->mail) . '","' . trim($row->name) . '"';
  }

  $emails = implode("\n", $emails) . "\n";

  // Write resultant string to file.
  file_unmanaged_save_data($emails, $full_path, FILE_EXISTS_REPLACE);

  // Set headers for file transfer.
  $headers = [
    'Content-Type' => 'application/octet-stream',
    'Content-Transfer-Encoding' => 'binary',
    'Content-Disposition' => 'attachment; filename="' . basename($full_path) . '";',
    'Content-Length' => sprintf('%u', filesize($full_path)),
  ];

  file_transfer($full_path, $headers);
}

/**
 * 메일링 리스트 관리자 설정.
 */
function mailing_list_admin_settings($form, &$form_state) {
  drupal_set_title('Mailing list settings');
  $form['mailing_list_subscription_message'] = [
    '#type' => 'textfield',
    '#title' => t('Subscription message'),
    '#description' => t('The message users see when they subscribe.  You can use %mail and %name as tokens.'),
    '#default_value' => variable_get('mailing_list_subscription_message', MAILING_LIST_MESSAGE_SUBSCRIPTION),
  ];

  return system_settings_form($form, TRUE);
}

?>
