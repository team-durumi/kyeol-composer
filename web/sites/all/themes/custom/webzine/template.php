<?php
/**
* Created by PhpStorm.
* User: js
* Date: 2019-03-07
* Time: 12:08
*/

define('__WZ__', drupal_get_path('theme', 'webzine'));

/**
* hook_js_alter().
* @param $javascript
*/
function webzine_js_alter(&$javascript)
{
  $javascript['misc/jquery.js']['version'] = '3.5.0';
  $javascript['misc/jquery.js']['data'] = '//cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js';
}


/**
* hook_css_alter().
* @param $css
*/
function webzine_css_alter(&$css)
{
  unset($css['modules/system/system.menus.css']);
  unset($css['modules/system/system.theme.css']);
}

/**
 * hook_preprocess_page().
 * @param $variables
 */
function webzine_preprocess_page(&$variables) {
  global $base_url;
  global $language;
  $lang = $language->language;
  $lang_path = ($lang == 'en') ? '/en' : '';

  $main = new Slowalk();
  $vol = $main->vol();
  $variables['vol'] = sprintf('%02d', $vol);  //호수 노출
  $variables['main_class'] = 'fc02';
  if(empty($variables['page']['sidebar_first'])) {
    $variables['main_class'] = 'fc03';
    if(strpos(request_uri(), 'vol') !== false) {
      $variables['theme_hook_suggestions'][] = 'page__vol';
      $term = taxonomy_term_load(arg(2));
      $termname = sprintf('%02d', $term->name);
      drupal_set_title('#'.$termname.'년 글 다시보기');
      if($lang == 'en') {
        drupal_set_title('Vol #'.$termname);
      }
    } elseif (arg(0) === 'taxonomy') {
      drupal_add_css('#page-title:before{content:"#"}', 'inline');
    }
    if(isset($variables['node'])) {
      if($variables['node']->type === 'article') {
        $main->vol = $variables['node']->field_vol['und'][0]['tid'];

        $variables['main_class'] = 'fc04';

        $variables['thisVol'] = sprintf('%02d', $main->vol());  //호수 노출
        $cat_tid = $variables['node']->field_category['und'][0]['tid'];
        $variables['category'] = $main->catLabel[$cat_tid];

        if($lang == 'en') {
          $variables['thisVol'] = '#' . $main->vol();  //호수 노출
          $term = $variables['node']->field_category['und'][0]['taxonomy_term'];
          $variables['category'] = $term->name;
        }

        if(isset($variables['node']->field_writer['und'])) {
          $writers = array();
          foreach($variables['node']->field_writer['und'] as $writerInfo) {
            $wid = $writerInfo['tid'];
            $writer = taxonomy_term_load($wid);
            $field_position = !empty($writer->field_position[$lang]) ? $writer->field_position[$lang][0]['value'] : '';
            $writers[] = array(
              'name' => $writer->name,
              'info' => ($writer->field_position) ? strip_tags($field_position) : ''
            );
          }
          $variables['writers'] = $writers;
        }
        $image = ($variables['node']->field_image) ? image_style_url('article', $variables['node']->field_image['und'][0]['uri']) : '';
        $variables['image'] = ($image) ? ' style="background-image:url('.$image.')"' : '';
        $variables['vol_path'] = '/' . $lang . '/vol/' . $main->vol();
        $term = $variables['node']->field_category['und'][0]['taxonomy_term'];
        if(!empty($term)) {
          $variables['category_path'] = '/' . $lang . '/taxonomy/term/' . $term->tid;
        }
        $variables['url'] = $base_url . $lang_path . '/node/' . $variables['node']->nid;

        $variables['created'] = $variables['node']->created;
        $variables['changed'] = $variables['node']->changed;
      }
    }
    if(strpos(request_uri(), '/resources') !== false) {
      $variables['main_class'] = 'fc02';
      $variables['page']['sidebar_first'] = ['#type' => 'markup', '#markup' => '<h2>All</h2>'];
    }
  }
  drupal_add_js(array('Webzine' => array('vol' => '/vol/' . $vol)), 'setting');
  drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('type' => 'external', 'scope' => 'header', 'group' => JS_LIBRARY));
  drupal_add_js('//cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js', array('type' => 'external', 'scope' => 'header', 'group' => JS_LIBRARY ));
  drupal_add_js('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('type' => 'external', 'scope' => 'header', 'group' => JS_THEME ));
  drupal_add_js(drupal_get_path('module', 'ckeditor') . '/plugins/cavacnote/jquery/jquery.cavacnote.js', array('type' => 'file', 'scope' => 'header', 'group' => JS_LIBRARY));
  drupal_add_js(drupal_get_path('module', 'slowalk'). '/js/cavacnotify.js', array('type' => 'file', 'scope' => 'footer', 'group' => JS_THEME));
  drupal_add_js(drupal_get_path('theme', 'webzine') . '/js/jquery.dialogOptions.js', array('type' => 'file', 'scope' => 'header', 'group' => JS_THEME));
  drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css', array('type' => 'external', 'group' => CSS_THEME));
  drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css', array('type' => 'external', 'group' => CSS_THEME));
  drupal_add_css('//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css', array('type' => 'external', 'group' => CSS_THEME));
  drupal_add_css('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css', array('type' => 'external', 'group' => CSS_THEME));
  drupal_add_css(drupal_get_path('module', 'ckeditor') . '/plugins/cavacnote/css/cavacnote.css', array('type' => 'file', 'group' => CSS_THEME));
  drupal_add_css('//unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css', array('type' => 'external', 'group' => CSS_THEME));

  // 언어에 따라 홈페이지 템플릿 선택
  $language = $variables['language'];
  $lang = $language->language;
  if($lang == 'en') {
    $variables['theme_hook_suggestions'][] = 'page__en';
    // 홈페이지
    if($variables['is_front']) {
      $variables['theme_hook_suggestions'][] = 'page__front__en';
      $variables['page']['content'] = [];

      // 슬라이더
      $slides = module_invoke('wz_block', 'block_view', 'wz_main_slide');
      $slider = [
        '#type' => 'container',
        '#attributes' => [ 'class' => ['ib01'] ],
        'slides' => $slides['content']
      ];
      $variables['page']['content']['slider'] = $slider;

      // 3단 소개
      $about_partial = file_get_contents(drupal_get_path('module', 'wz_block') . '/templates/about-three-cols.tpl.php');
      $variables['page']['content']['about'] = [ '#type' => 'markup', '#markup' => $about_partial ];

      // 최신글 container
      $variables['page']['content']['body'] = [ '#type' => 'container', '#attributes' => ['class' => 'cBody inner']];
      $variables['page']['content']['body']['box'] =  [ '#type' => 'container', '#attributes' => ['class' => 'fc_box02']];
      // $variables['page']['content']['body']['box']['recents'] = [ '#type' => 'container', '#attributes' => ['class' => 'fc03']];

      // 최신글
      $category_terms = [
        'interviews' => '인터뷰',
        'essays' => '에세이',
        'reviews' => '논평',
        'discussions' => '좌담',
        'document_explanations' => '자료해제',
      ];
      foreach ($category_terms as $field => $label) {
        $variables['page']['content']['body']['box']['recents'][$field] = [
          '#type' => 'markup',
          '#markup' => views_embed_view('recent_contents', $field),
          '#prefix' => '<h2 class="mt-5">' . ucwords(str_replace('_' , ' ', $field)) . '</h2>'
        ];
      }
    }

    drupal_add_css(drupal_get_path('theme', 'webzine') . '/css/webzine_en.css', array('type' => 'file', 'group' => CSS_THEME));
    drupal_add_css(drupal_get_path('theme', 'webzine') . '/css/responsive.css', array('type' => 'file', 'group' => CSS_THEME));
  }
}

/**
* @param $field_writer
* @return string
*/
function get_writers($field_writer)
{
  $writers = array();
  if(isset($field_writer['#items'])) {
    foreach($field_writer['#items'] as $item) {
      $writers[] = $item['taxonomy_term']->name;
    }
  } elseif(isset($field_writer['und'])) {
    foreach($field_writer['und'] as $Arr) {
      $tid = $Arr['tid'];
      $term = taxonomy_term_load($tid);
      $writers[] = htmlspecialchars($term->name);
    }
  }
  return implode(', ', $writers);
}

/**
* @param $term
* @param array $options
*/
function get_term_link($term, $options = array())
{
  global $language;
  $lang = $language->language;
  if(isset($term['#items'])) {
    $html[] = '';
    $classes = '';
    if($options) {
      $classes = $options['class'] ?? '';
    }
    $first = true;
    foreach($term['#items'] as $item) {
      $name = isset($options['type']) ? sprintf($options['type'], $item['taxonomy_term']->name) : $item['taxonomy_term']->name;
      if(!$first && strpos($name, '년대') !== false) {
        $html[] = '<br /><br />';
      }
      if(isset($options['prefix'])) {
        $name = $options['prefix'] . $name;
      }
      if(isset($options['suffix'])) {
        $name .= $options['suffix'];
      }
      $lang_prefix = ($lang == 'en') ? '/en' : '';
      if(isset($options['voca'])) {
        $html[] = '<a class="'.$classes.'" href="' . $lang_prefix . '/archive/'.$options['voca'].'?search='.$name.'">'.$name.'</a>';
      } else {
        $html[] = '<a class="'.$classes.'" href="' . $lang_prefix . '/'.drupal_get_path_alias('taxonomy/term/'.$item['tid']).'">'.$name.'</a>';
      }
      $first = false;
    }
    return implode('', $html);
  }
}

/**
* @return mixed
*/
function countWriters()
{
  $cnt = db_query("select distinct(field_writer_tid) from field_data_field_writer")->rowCount();
  return $cnt;
}

/**
* hook_breadcrumb()
* @param $variables
* @return string
*/
function webzine_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    $breadcrumb = str_replace('Taxonomy term', '태그', $breadcrumb);
    $breadcrumb = str_replace('Search', '키워드 검색', $breadcrumb);
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $output .= '<div class="breadcrumb" id="main-content">' . implode(' ', $breadcrumb) . '</div>';
    return $output;
  }
}

/**
 * Implements hook_preprocess_node().
 */
function webzine_preprocess_node(&$vars) {
  global $language;
  $lang = $vars['lang'] = $language->language;

  if($vars['view_mode'] == 'teaser_en') {
    if(!empty($vars['field_vol']['und'][0]['tid'])) {
      $vol = $vars['field_vol']['und'][0]['tid'];
    }
    if(!empty($vars['field_vol'][0]['tid'])) {
      $vol = $vars['field_vol'][0]['tid'];
    }
    if(!empty($vol)) {
      $term = taxonomy_term_load($vol);
      $vars['vol_name'] = $term->name;
      $vars['vol_path'] = '/en/taxonomy/term/' . $vol;
    }
    if(!empty($vars['field_category']['und'][0]['tid'])) {
      $category = $vars['field_category']['und'][0]['tid'];
    }
    if(!empty($vars['field_category'][0]['tid'])) {
      $category = $vars['field_category'][0]['tid'];
    }
    if(!empty($category)) {
      $term = taxonomy_term_load($category);
      $vars['category_name'] = $term->name;
      $vars['category_path'] = '/en/taxonomy/term/' . $category;
    }
    if(!empty($vars['field_image']['und'][0]['uri'])) {
      $vars['image_uri'] = $vars['field_image']['und'][0]['uri'];
    }
    if(!empty($vars['field_image'][0]['uri'])) {
      $vars['image_uri'] = $vars['field_image'][0]['uri'];
    }
    if(!empty($vars['body'][0]['safe_value'])) {
      $vars['body'] = $vars['body'][0]['safe_value'];
    }
    if(!empty($vars['body']['und'][0]['safe_value'])) {
      $vars['body'] = $vars['body']['und'][0]['safe_value'];
    }

    $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->type . '__teaser_en';
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->nid . '__teaser_en';
  }

  if($vars['type'] == 'resources' && $vars['view_mode'] == 'teaser') {
    if(!empty($vars['field_image']['und'][0]['uri'])) {
      $vars['image_uri'] = $vars['field_image']['und'][0]['uri'];
    }
    if(!empty($vars['field_image'][0]['uri'])) {
      $vars['image_uri'] = $vars['field_image'][0]['uri'];
    }
    if(!empty($vars['body'][0]['safe_value'])) {
      $vars['body'] = $vars['body'][0]['safe_value'];
    }
    if(!empty($vars['body']['und'][0]['safe_value'])) {
      $vars['body'] = $vars['body']['und'][0]['safe_value'];
    }
    $vars['field_writer'] = 'the Editorial Team of the Webzine';
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->type . '__teaser';
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->nid . '__teaser';
  }

  if($vars['type'] == 'article' && $lang == 'en' && $vars['view_mode'] == 'full') {
    $vars['theme_hook_suggestions'][] = 'node__article__en';
  }

  $vars['share_links'] = [
    'canonical_url' => url('node/' . $vars['nid'], ["absolute" => TRUE]),
    'text' => $vars['title_original'],
  ];
}

function get_writers_und($field_writer) {
  $writers = [];
  if(isset($field_writer['und'])) {
    foreach($field_writer['und'] as $writer) {
      $term = taxonomy_term_load($writer['tid']);
      $writers[] = $term->name;
    }
  } elseif(isset($field_writer)) {
    foreach($field_writer as $writer) {
      $term = taxonomy_term_load($writer['tid']);
      $writers[] = htmlspecialchars($term->name);
    }
  }
  return implode(', ', $writers);
}

/**
 * Implements template_preprocess_views_view_summary().
 */
function webzine_preprocess_views_view_summary(&$vars) {
  $view = $vars['view'];
  $argument = $view->argument[$view->build_info['summary_level']];
  $vars['row_classes'] = array();
  $url_options = array();
  if (!empty($view->exposed_raw_input)) {
    $url_options['query'] = $view->exposed_raw_input;
  }
  $count = 0;
  $active_urls = drupal_map_assoc(array(
    url($_GET['q'], array(
      'alias' => TRUE,
    )),
    url($_GET['q'], $url_options + array(
      'alias' => TRUE,
    )),
    url($_GET['q']),
    url($_GET['q'], $url_options),
  ));

  $row_args = array();
  foreach ($vars['rows'] as $id => $row) {
    $row_args[$id] = $argument->summary_argument($row);
  }
  $argument->process_summary_arguments($row_args);
  foreach ($vars['rows'] as $id => $row) {
    if ($count++ && !empty($vars['options']['separator'])) {
      $vars['rows'][$id]->separator = filter_xss_admin($vars['options']['separator']);
    }
    if ($view->name == 'resources' && $view->current_display == 'block_1') {
      $term = taxonomy_term_load($row->field_data_field_resource_terms_field_resource_terms_tid);
      if (!$term) {
        $vars['rows'][$id]->link = '';
      }
      else {
        $vars['rows'][$id]->link = $term->name;
      }
    }
    else {
      $vars['rows'][$id]->link = $argument->summary_name($row);
    }

    $args = $view->args;
    $args[$argument->position] = $row_args[$id];
    $base_path = NULL;
    if (!empty($argument->options['summary_options']['base_path'])) {
      $base_path = $argument->options['summary_options']['base_path'];
    }
    $vars['rows'][$id]->url = url($view->get_url($args, $base_path), $url_options);
    $vars['rows'][$id]->count = intval($row->{$argument->count_alias});
    if (isset($active_urls[$vars['rows'][$id]->url])) {
      $vars['row_classes'][$id] = 'active';
    }
  }
  // 자료실 뷰인 경우 순서를 정렬합니다.
  if ($view->name == 'resources') {
    $rows_sorted = [];
    $rows_sorted[] = $vars['rows'][1];
    $rows_sorted[] = $vars['rows'][0];
    $rows_sorted[] = $vars['rows'][2];
    $rows_sorted[] = $vars['rows'][3];
    $vars['rows'] = $rows_sorted;
  }
}
?>
