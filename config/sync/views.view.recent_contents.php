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
$handler->display->display_options['use_more_text'] = '더 보기';
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['exposed_form']['options']['submit_button'] = '적용';
$handler->display->display_options['exposed_form']['options']['reset_button_label'] = '재설정';
$handler->display->display_options['exposed_form']['options']['exposed_sorts_label'] = '정렬기준';
$handler->display->display_options['exposed_form']['options']['sort_desc_label'] = '설명';
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '3';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['style_plugin'] = 'list';
$handler->display->display_options['style_options']['default_row_class'] = FALSE;
$handler->display->display_options['style_options']['row_class_special'] = FALSE;
$handler->display->display_options['style_options']['wrapper_class'] = 'lc02 lc02_01';
$handler->display->display_options['row_plugin'] = 'node';
$handler->display->display_options['row_options']['view_mode'] = 'teaser_en';
/* 필드: 콘텐츠: 제목 */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = '';
$handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
$handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
/* 정렬 기준: 콘텐츠: Post date */
$handler->display->display_options['sorts']['created']['id'] = 'created';
$handler->display->display_options['sorts']['created']['table'] = 'node';
$handler->display->display_options['sorts']['created']['field'] = 'created';
$handler->display->display_options['sorts']['created']['order'] = 'DESC';
/* 필터 속성: 콘텐츠: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* 필터 속성: 콘텐츠: 종류 */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'article' => 'article',
);
/* 필터 속성: 콘텐츠: Title (title_field:언어) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* 필터 속성: 콘텐츠: 분류 (field_category) */
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
/* 필터 속성: 콘텐츠: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* 필터 속성: 콘텐츠: 종류 */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'article' => 'article',
);
/* 필터 속성: 콘텐츠: Title (title_field:언어) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* 필터 속성: 콘텐츠: 분류 (field_category) */
$handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
$handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['value'] = array(
  4 => '4',
);
$handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
$handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'article_category';
$handler->display->display_options['block_description'] = 'Essay';

/* Display: interview */
$handler = $view->new_display('block', 'interview', 'interview');
$handler->display->display_options['defaults']['title'] = FALSE;
$handler->display->display_options['title'] = 'Interview';
$handler->display->display_options['defaults']['pager'] = FALSE;
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '2';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
/* 필터 속성: 콘텐츠: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* 필터 속성: 콘텐츠: 종류 */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'article' => 'article',
);
/* 필터 속성: 콘텐츠: Title (title_field:언어) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* 필터 속성: 콘텐츠: 분류 (field_category) */
$handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
$handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['value'] = array(
  7 => '7',
);
$handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
$handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'article_category';
$handler->display->display_options['block_description'] = 'Interview';

/* Display: discussion */
$handler = $view->new_display('block', 'discussion', 'discussion');
$handler->display->display_options['defaults']['title'] = FALSE;
$handler->display->display_options['title'] = 'Discussion';
$handler->display->display_options['defaults']['pager'] = FALSE;
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '2';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['defaults']['filter_groups'] = FALSE;
$handler->display->display_options['defaults']['filters'] = FALSE;
/* 필터 속성: 콘텐츠: Published status */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* 필터 속성: 콘텐츠: 종류 */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'data' => 'data',
);
/* 필터 속성: 콘텐츠: Title (title_field:언어) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);
/* 필터 속성: 콘텐츠: 분류 (field_category) */
$handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
$handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
$handler->display->display_options['filters']['field_category_tid']['operator'] = 'not';
$handler->display->display_options['filters']['field_category_tid']['value'] = array(
  2 => '2',
);
$handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
$handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'article_category';
$handler->display->display_options['block_description'] = 'Discussion';
$translatables['recent_contents'] = array(
  t('Master'),
  t('Recent contents'),
  t('더 보기'),
  t('적용'),
  t('재설정'),
  t('정렬기준'),
  t('Asc'),
  t('설명'),
  t('essay'),
  t('Essay'),
  t('interview'),
  t('Interview'),
  t('discussion'),
  t('Discussion'),
);
