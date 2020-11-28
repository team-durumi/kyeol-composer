<?php

$view = new view();
$view->name = 'recent_contents';
$view->description = '최신 글 뷰 블록';
$view->tag = 'default';
$view->base_table = 'node';
$view->human_name = '최신 글';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['title'] = 'Recent contents';
$handler->display->display_options['use_more_always'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '3';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['style_plugin'] = 'list';
$handler->display->display_options['style_options']['default_row_class'] = FALSE;
$handler->display->display_options['style_options']['row_class_special'] = FALSE;
$handler->display->display_options['style_options']['wrapper_class'] = 'lc02 lc02_01';
$handler->display->display_options['row_plugin'] = 'node';
$handler->display->display_options['row_options']['view_mode'] = 'teaser_en';
/* Field: Content: Title */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = '';
$handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
$handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
/* Sort criterion: Content: Post date */
$handler->display->display_options['sorts']['created']['id'] = 'created';
$handler->display->display_options['sorts']['created']['table'] = 'node';
$handler->display->display_options['sorts']['created']['field'] = 'created';
$handler->display->display_options['sorts']['created']['order'] = 'DESC';
/* Filter criterion: Content: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Content: Type */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'article' => 'article',
);
/* Filter criterion: Content: Title (title_field:language) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* Filter criterion: Content: 분류 (field_category) */
$handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
$handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
$handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'article_category';

/* Display: essay */
$handler = $view->new_display('block', 'essay', 'essay');
$handler->display->display_options['defaults']['title'] = FALSE;
$handler->display->display_options['title'] = 'Essay';
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
/* Filter criterion: Content: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Content: Type */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'article' => 'article',
);
/* Filter criterion: Content: Title (title_field:language) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* Filter criterion: Content: 분류 (field_category) */
$handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
$handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['value'] = array(
  4 => '4',
);
$handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
$handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'article_category';
$handler->display->display_options['block_description'] = 'Essay';

/* Display: Interview */
$handler = $view->new_display('block', 'Interview', 'interview');
$handler->display->display_options['defaults']['title'] = FALSE;
$handler->display->display_options['title'] = 'Interview';
$handler->display->display_options['defaults']['pager'] = FALSE;
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '2';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
/* Filter criterion: Content: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Content: Type */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'article' => 'article',
);
/* Filter criterion: Content: Title (title_field:language) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* Filter criterion: Content: 분류 (field_category) */
$handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
$handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['value'] = array(
  7 => '7',
);
$handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
$handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'article_category';
$handler->display->display_options['block_description'] = 'Interview';

/* Display: Researcher Forum */
$handler = $view->new_display('block', 'Researcher Forum', 'resources');
$handler->display->display_options['defaults']['title'] = FALSE;
$handler->display->display_options['title'] = 'Researcher Forum';
$handler->display->display_options['defaults']['pager'] = FALSE;
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '2';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
/* Filter criterion: Content: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Content: Type */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'data' => 'data',
);
/* Filter criterion: Content: Title (title_field:language) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* Filter criterion: Content: 분류 (field_category) */
$handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
$handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['operator'] = 'not';
$handler->display->display_options['filters']['field_category_tid']['value'] = array(
  7 => '7',
);
$handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
$handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'article_category';
$handler->display->display_options['block_description'] = 'Researcher Forum';
$translatables['recent_contents'] = array(
  t('Master'),
  t('Recent contents'),
  t('more'),
  t('Apply'),
  t('Reset'),
  t('Sort by'),
  t('Asc'),
  t('Desc'),
  t('essay'),
  t('Essay'),
  t('Interview'),
  t('Researcher Forum'),
);
