<?php
/**
 * @file
 * Variable API module. Definition for some xample variables
 */

/**
 * Implements hook_variable_info().
 */
function slowalk_variable_info($options) {

  $variables['wz_slide_count'] = [
    'type' => 'text',
    'title' => t('슬라이드 개수 설정', [], $options),
    'default' => '5',
    'description' => t('슬라이드 개수 설정', [], $options),
    'required' => TRUE,
    'group' => 'slowalk'
  ];

  $slide_fields = [
    'title' => '제목',
    'body' => '내용',
    'image' => '이미지',
    'link' => '링크',
    '_blank' => '새창열기'
  ];
  foreach (range(1, 5) as $i) {
    foreach ($slide_fields as $key => $label) {
      $variables['slide_' . $i . '_' . $key] = [
        'type' => 'text',
        'title' => t('슬라이드 #' . $i . ' ' . $label, [], $options),
        'description' => t('슬라이드 #' . $i . ' ' . $label, [], $options),
        'group' => 'slowalk'
      ];
    }
  }

  return $variables;
}

/**
 * Implements hook_variable_group_info().
 */
function slowalk_variable_group_info() {
  $groups['slowalk'] = [
    'title' => t('홈페이지 관리'),
    'description' => t('홈페이지 관리'),
    'access' => 'administer site configuration',
    'path' => ['admin/webzine/slide'],
  ];
  return $groups;
}

