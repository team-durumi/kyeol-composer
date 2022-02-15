<?php

$view = new view();
$view->name = 'featured';
$view->description = '특집 기사 목록 화면입니다.';
$view->tag = 'default';
$view->base_table = 'taxonomy_term_data';
$view->human_name = '특집';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['title'] = '특집';
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
$handler->display->display_options['pager']['options']['expose']['offset_label'] = '건너뛰기';
$handler->display->display_options['pager']['options']['tags']['first'] = '« 처음 페이지';
$handler->display->display_options['pager']['options']['tags']['previous'] = '‹ 이전';
$handler->display->display_options['pager']['options']['tags']['next'] = '다음 ›';
$handler->display->display_options['pager']['options']['tags']['last'] = '마지막 페이지 »';
$handler->display->display_options['style_plugin'] = 'default';
$handler->display->display_options['row_plugin'] = 'entity';
/* 필드: 태그: 이름 */
$handler->display->display_options['fields']['name']['id'] = 'name';
$handler->display->display_options['fields']['name']['table'] = 'taxonomy_term_data';
$handler->display->display_options['fields']['name']['field'] = 'name';
$handler->display->display_options['fields']['name']['label'] = '';
$handler->display->display_options['fields']['name']['alter']['word_boundary'] = FALSE;
$handler->display->display_options['fields']['name']['alter']['ellipsis'] = FALSE;
$handler->display->display_options['fields']['name']['link_to_taxonomy'] = TRUE;
/* 필터 속성: 분류 용어모음: 기계명 */
$handler->display->display_options['filters']['machine_name']['id'] = 'machine_name';
$handler->display->display_options['filters']['machine_name']['table'] = 'taxonomy_vocabulary';
$handler->display->display_options['filters']['machine_name']['field'] = 'machine_name';
$handler->display->display_options['filters']['machine_name']['value'] = array(
  'featured' => 'featured',
);

/* Display: Page */
$handler = $view->new_display('page', 'Page', 'page');
$handler->display->display_options['path'] = 'featured';
