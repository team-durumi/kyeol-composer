<?php

$view = new view();
$view->name = 'resources';
$view->description = '';
$view->tag = 'default';
$view->base_table = 'node';
$view->human_name = 'resources';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['title'] = 'resources';
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
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['pager']['options']['items_per_page'] = '10';
$handler->display->display_options['pager']['options']['expose']['items_per_page_label'] = '페이지 당 항목 수';
$handler->display->display_options['pager']['options']['expose']['items_per_page_options_all_label'] = '- 모두 -';
$handler->display->display_options['pager']['options']['tags']['first'] = '« 처음 페이지';
$handler->display->display_options['pager']['options']['tags']['previous'] = '‹ 이전';
$handler->display->display_options['pager']['options']['tags']['next'] = '다음 ›';
$handler->display->display_options['pager']['options']['tags']['last'] = '마지막 페이지 »';
$handler->display->display_options['style_plugin'] = 'default';
$handler->display->display_options['row_plugin'] = 'node';
$handler->display->display_options['row_options']['view_mode'] = 'full';
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
  'data' => 'data',
);
/* 필터 속성: 콘텐츠: Title (title_field:언어) */
$handler->display->display_options['filters']['language']['id'] = 'language';
$handler->display->display_options['filters']['language']['table'] = 'field_data_title_field';
$handler->display->display_options['filters']['language']['field'] = 'language';
$handler->display->display_options['filters']['language']['value'] = array(
  '***CURRENT_LANGUAGE***' => '***CURRENT_LANGUAGE***',
);

/* Display: Page */
$handler = $view->new_display('page', 'Page', 'page');
$handler->display->display_options['path'] = 'resources';
$translatables['resources'] = array(
  t('Master'),
  t('resources'),
  t('더 보기'),
  t('적용'),
  t('재설정'),
  t('정렬기준'),
  t('Asc'),
  t('설명'),
  t('페이지 당 항목 수'),
  t('- 모두 -'),
  t('Offset'),
  t('« 처음 페이지'),
  t('‹ 이전'),
  t('다음 ›'),
  t('마지막 페이지 »'),
  t('Page'),
);
