## entity query

```bash
# https://www.drupal.org/docs/7/creating-custom-modules/howtos/how-to-use-entityfieldquery-for-drupal-7
$ drush php
$query = new EntityFieldQuery();
$query = $query->entityCondition('entity_type', 'node')\
  ->entityCondition('bundle', 'resources')\
  ->propertyOrderBy('nid', 'ASC')\
  ->propertyCondition('status', NODE_UNPUBLISHED)\
  ->addMetaData('account', user_load(1))\
  ->execute();
$nids = array_keys($query['node']);
$nodes = node_load_multiple($nids);
foreach($nodes as $nid => $node) {\
  $wrapper = entity_metadata_wrapper('node', $node);\
  $wrapper->field_resource_terms = 482;\
  $wrapper->status = 1;\
  $wrapper->save();\
}
```

