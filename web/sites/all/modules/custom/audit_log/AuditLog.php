<?php

/**
 * Contains AuditLog.
 */

/**
 * Represents an AuditLog object.
 */
class Auditlog {
  /**
   * The user ID of the user performing the action.
   *
   * @var int
   */
  public $uid;

  /**
   * The role IDs of the user at the time user performed the action.
   *
   * @var int[]
   */
  public $roleIds;

  /**
   * The user name of the user at the time user performed the action.
   *
   * @var string
   */
  public $name;

  /**
   * The (relative) url at which the action was performed.
   *
   * @var string
   */
  public $url;

  /**
   * The entity id of the entity on which the action was performed.
   *
   * @var int
   */
  public $entityId;

  /**
   * The entity type of the entity on which the action was performed.
   *
   * @var string
   */
  public $entityType;

  /**
   * The bundle of the entity on which the action was performed.
   *
   * @var string
   */
  public $bundle;

  /**
   * The label of the entity on which action was performed, when it occured.
   *
   * @var string
   */
  public $entityLabel;

  /**
   * The action that was performed.
   *
   * One of 'view', 'insert', 'update' or 'delete'.
   *
   * @var string
   */
  public $auditAction;

  /**
   * The timestamp when the action was performed.
   *
   * @var int
   */
  public $timestamp;

  /**
   * Message.
   *
   * A message describing the log item.
   *
   * @var string
   */
  public $message;

  /**
   * Create an audit log.
   *
   * @param array $values
   *   An array where the keys are the audit log's property names and the values
   *   are the corresponding values.
   *   Valid keys are:
   *     - entityId: The entity id of the entity on which the action was
   *       performed (required).
   *     - entityType: The entity type of the entity on which the action was
   *       performed (required).
   *     - entityLabel: The label of the entity on which the action was
   *       performed, at the time it occured (required).
   *     - bundle: The bundle of the entity on which the action was performed
   *       (required).
   *     - auditAction: The action that was performed (required, one of 'view',
   *       'insert', 'update' or 'delete').
   *     - uid: The user ID of the user performing the action (optional,
   *       defaults to the current user).
   *     - roleIds:  The role IDs of the user at the time user performed the
   *       action (optional, defaults to the role ids of the provided uid).
   *     - url: The (relative) url at which the action was performed (optional,
   *       defaults to request_path()).
   *     - timestamp: The timestamp when the action was performed (optional,
   *       defaults to REQUEST_TIME).
   *     - message: Message describing the log item (optional).
   */
  public function __construct(array $values = []) {
    if (!isset($values['uid'])) {
      global $user;
      $values = [
        'uid' => $user->uid,
        'roleIds' => array_keys($user->roles),
        'name' => user_is_anonymous() ? variable_get('anonymous', t('Anonymous')) : $user->name,
      ] + $values;
    }
    if (!isset($values['name'])) {
      $account = user_load($values['uid']);
      $values['name'] = $account->name;
    }
    if (!isset($values['roleIds'])) {
      $account = user_load($values['uid']);
      $values['roleIds'] = array_keys($account->roles);
    }
    $values += [
      'url' => request_path(),
      'timestamp' => REQUEST_TIME,
    ];
    foreach ($values as $property => $value) {
      $this->{$property} = $value;
    }
  }

  /**
   * Logs this audit log.
   *
   * @see hook_audit_log()
   */
  public function log() {
    module_invoke_all('audit_log', $this);
  }

}
