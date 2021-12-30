<?php
/**
 * Created by PhpStorm.
 * User: js
 * Date: 2019-03-06
 * Time: 15:10
 */

class Slowalk
{
    public $vol, $catLabel, $category, $years, $featureIds, $featureLabel, $machine_name;

    public function __construct()
    {
        $this->vol = variable_get('wz_main_vol', '');   //호수
        $this->featureIds = [];    //메인피쳐

        //기사 분류
        $this->catLabel = [
            2 => '좌담',
            3 => '논평',
            4 => '에세이',
            5 => '자료해제',
            6 => '연구자와 지원단체',
            7 => '인터뷰'
        ];
        $this->machine_name = [
            2 => 'opinion',
            3 => 'review',
            4 => 'essay',
            5 => 'annotation',
            6 => 'personnel',
            7 => 'interview'
        ];
        $this->category = [
            variable_get('wz_main_first_feature', ''),
            variable_get('wz_main_second_feature', '')
        ];
        $this->featureLabel = [
            $this->catLabel[$this->category[0]],
            $this->catLabel[$this->category[1]]
        ];
        //시기
        $this->years = [];
    }

    public static function getData($payloads)
    {
        extract($payloads);
        switch ($type) {
            case 'features':
                $features = [];
                $feature_terms = [
                    variable_get('wz_main_first_feature', ''),
                    variable_get('wz_main_second_feature', '')
                ];
                $query = new EntityFieldQuery();
                $result = $query->entityCondition('entity_type', 'node')
                    ->entityCondition('bundle', 'article')
                    ->propertyCondition('status', 1)
                    ->fieldCondition('field_vol', 'tid', $vol)
                    ->fieldCondition('field_category', 'tid', $category)
                    ->propertyOrderBy('created', 'DESC')
                    ->range(0,2)
                    ->execute();
                $index = array_search($category, $feature_terms);
                if ($result['node']) {
                    foreach ($result['node'] as $key => $value) {
                        $nid = $key;
                        $node = node_load($nid);
                        $output = field_view_field('node', $node, 'body', 'teaser');
                        $body = render($output);
                        $body = strip_tags($body);
                        $output2 = field_view_field('node', $node, 'field_writer', ['label' => 'hidden']);
                        $writer = render($output2);
                        $features[] = [
                            'nid' => $nid,
                            'url' => '/node/' . $nid,
                            'title' => $node->title,
                            'img' => ($node->field_image) ? image_style_url('main_feature', $node->field_image['und'][0]['uri']) : file_create_url(drupal_get_path('theme', 'webzine').'/images/no-image-square.png'),
                            'body' => $body,
                            'writer' => $writer,
                        ];
                    }
                }
                return $features;
                break;
            case 'articles':
                $query = new EntityFieldQuery();
                $result = $query->entityCondition('entity_type', 'node')
                    ->entityCondition('bundle', 'article')
                    ->propertyCondition('status', 1)
                    ->propertyCondition('promote', 1)
                    ->propertyCondition('nid', $nid, 'NOT IN')
                    ->fieldCondition('field_vol', 'tid', $vol)
                    // ->fieldOrderBy('field_category', 'tid', 'ASC')
                    ->propertyOrderBy('changed', 'DESC')
                    ->range(0,6)
                    ->execute();
                $articles = [];
                if($result['node']) {
                    $nids = array_keys($result['node']);
                    $nodes = entity_load('node', $nids);
                    foreach($nodes as $node) {
                        $nid = $node->nid;
                        $output_category = field_view_field('node', $node, 'field_category', ['label' => 'hidden']);
                        $category = render($output_category );
                        $img_uri = ($node->field_image) ? image_style_url('main_article', $node->field_image['und'][0]['uri']) : file_create_url(drupal_get_path('theme', 'webzine').'/images/no-image-square.png');
                        $output_body = field_view_field('node', $node, 'body', 'teaser');
                        $body = strip_tags(render($output_body));
                        $output_writer = field_view_field('node', $node, 'field_writer', ['label' => 'hidden']);
                        $writer = render($writer);
                        $articles[] = array(
                            'nid' => $nid,
                            'url' => '/node/'.$nid,
                            'title' => $node->title,
                            'category' => $category,
                            'img' => $img_uri,
                            'body' => $body,
                            'writer' => $writer,
                        );
                    }
                    return $articles;
                }
                break;
            case 'search':
                if(isset($key)) {
                    $keyword = _slowalk_search('search', 'page', $key);
                    $term = _slowalk_search('search_term', 'page', $key);
                    return array('keyword' => $keyword, 'term' => $term);
                }
                break;
            case 'person':
                $archive = new Archive();
                return $archive->getPerson();
                break;
            case 'term':
                if(!empty($href)) {
                    $explode = explode('/', $href);
                    $tid = $explode[2];
                    $term = taxonomy_term_load($tid);
                    return $term;
                }
            break;
        }
        return [];
    }

    public function vol()
    {
        if($this->vol) {
            $term = taxonomy_term_load($this->vol);
            return $term->name;
        }
        return 0;
    }
}

class Main extends Slowalk
{
    /**
     * @return array
     */
    public function slide(): array
    {
        $total = variable_get('wz_slide_count', 0);
        $slide = array();
        if($total) {
            for($i=1; $i<=$total; $i++) {
                $link = variable_get('slide_'.$i.'_link', '');
                $nid = preg_replace('/\D/', '', $link);
                $authors = [];
                $created = '';
                if ($node = node_load($nid)) {
                    $wrapper = entity_metadata_wrapper('node', $node);
                    $writers = $wrapper->field_writer->value();
                    foreach ($writers as $user) {
                        $authors[] = $user->name;
                    }
                    $created = date('Y.m.d', $node->created);
                }
                $slide[] = array(
                    'title' => variable_get('slide_'.$i.'_title', ''),
                    'body' => variable_get('slide_'.$i.'_body', ''),
                    'fid' => variable_get('slide_'.$i.'_image', ''),
                    'link' => $link,
                    'blank' => variable_get('slide_'.$i.'_blank', ''),
                    'authors' => implode(', ', $authors),
                    'created' => $created,
                );
            }
        }
        return $slide;
    }

    /**
     * @return array
     */
    public function features(): array
    {
        $features = [];
        if($this->vol) {
            for($i = 0; $i < 2; $i++) {
                $data = [
                    'vol' => $this->vol,
                    'category' => $this->category[$i],
                    'type' => 'features'
                ];
                $features[$i] = $this->getData($data);
                if($features) {
                    foreach ($features as $key => $rows) {
                        foreach ($rows as $row) {
                            $this->featureIds[] = $row['nid'];
                        }
                    }
                }
            }
        }
        return $features;
    }

    public function articles(): array
    {
        $articles = array();
        if(empty($this->featureIds)) {
            $this->features();
        }

        if(!empty($this->featureIds) && $this->vol) {
            $data = array(
                'vol' => $this->vol,
                'nid' => $this->featureIds,
                'type' => 'articles'
            );
            $articles = $this->getData($data);
        }
        return $articles;
    }
}

class Webzines extends Slowalk
{
    public function getWebzine($category)
    {
        global $language;
        $lang = $language->language ?? 'und';
        $options['category'] = $this->catLabel[$category];
        $query = new EntityFieldQuery();
        $result = $query->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'article')
            ->propertyCondition('status', 1)
            ->fieldCondition('field_vol', 'tid', $this->vol)
            ->fieldCondition('field_category', 'tid', $category)
            ->propertyOrderBy('created', 'DESC')
            ->propertyCondition('language', $lang, '=')
            ->execute();

        if(isset($result['node'])) {
            $nids = array_keys($result['node']);
            $opinion = node_load_multiple($nids);
            $rows = array();
            foreach($opinion as $item) {
                $rows[] = array(
                    '{{ img }}' => $item->field_image ? image_style_url('main_article', $item->field_image['und'][0]['uri']) : file_create_url(drupal_get_path('theme', 'webzine').'/images/no-image-square.png'),
                    '{{ vol_path }}' => '/vol/'.$this->vol(),
                    '{{ vol }}' => sprintf('%02d', $this->vol()),
                    '{{ category_path }}' => '/category/' . $this->machine_name[$category],
                    '{{ category }}' => $this->catLabel[$category],
                    '{{ node_url }}' => '/node/' . $item->nid,
                    '{{ title }}' => $item->title,
                    '{{ summary }}' => text_summary(trim(strip_tags($item->body[$lang][0]['value'])), 'plain_text', 210).'...',
                    '{{ writer }}' => $this->writer($item->field_writer['und']),
                    '{{ date }}' => format_date($item->created, 'custom', 'Y.m.d')
                );
            }
            $options['rows'] = $rows;
            return $this->template($options);
        }
        return false;
    }

    private function template($options): string
    {
        $html = '<div class="fc_box02">
                    <h2>'.$options['category'].'</h2>
                    <ul class="lc02 lc02_01">';
        if(isset($options['rows'])) {
            foreach($options['rows'] as $row) {
                $html .= '<li>
                    <a href="{{ node_url }}" class="thumb"><span><img src="{{ img }}" alt=""/></span></a>
                    <dl class="conA">
                        <dt>
                            <span class="category">
                                <a class="btn02 version" href="{{ vol_path }}">{{ vol }}년</a>
                                <a class="btn02 mention" href="{{ category_path }}">{{ category }}</a>
                            </span>
                            <a href="{{ node_url }}">{{ title }}</a>
                        </dt>
                        <dd>
                            <p class="summury">{{ summary }}</p>
                            <p class="meta">
                                <span>{{ writer }}</span>
                                <em>{{ date }}</em>
                            </p>
                        </dd>
                    </dl>
                </li>';
                $html = strtr($html, $row);
            }
        }
        $html .= '</ul><div class="clear"></div>
                </div>';
        return $html;
    }

    private function writer($writers): string
    {
        $return = array();
        foreach($writers as $writer) {
            $term = taxonomy_term_load($writer['tid']);
            $return[] = $term->name;
        }
        return implode(', ', $return);
    }

    public function total(): ?int
    {
        $query = new EntityFieldQuery();
        $result = $query->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'article')
            ->propertyCondition('status', 1)
            ->fieldCondition('field_vol', 'tid', $this->vol)
            ->execute();
        if(isset($result['node'])) {
            return count($result['node']);
        }
        return 0;
    }
}

class Archive extends Slowalk
{
    protected function query($machine_name, $condition)
    {
        global $language;
        $lang = $language->language ?? 'ko';
        $start = $condition['start'];
        $end = $condition['end'];
        $vid = $this->vid($machine_name);
        $term = db_select('taxonomy_term_data', 't')
          ->fields('t', array('name'))
          ->condition('vid', $vid)
          ->condition('name', $start, '>=');
        if($end) {
          $term->condition('name', $end, '<');
        }
        $result = $term->execute()->fetchCol();
        return $result;
    }

    protected function total($machine_name)
    {
        $vid = $this->vid($machine_name);
        return db_select('taxonomy_term_data', 't')->fields('t', array('name'))->condition('vid', $vid)->execute()->rowCount();
    }

    private function vid($machine_name)
    {
        return db_select('taxonomy_vocabulary', 'v')->fields('v', array('vid'))->condition('machine_name', $machine_name)->execute()->fetchField();
    }

    private function index($machine_name)
    {
        if($machine_name === 'years') {
            $index = $this->yearsQeury();
        } else {
            $index = array(
                $this->query($machine_name, array('start' => '가', 'end' => '아')),
                $this->query($machine_name, array('start' => '아', 'end' => '')),
                $this->query($machine_name, array('start' => 'A', 'end' => 'ㄱ'))
            );
        }

        return array('total' => $this->total($machine_name), 'index' => $index);
    }

    private function yearsQeury()
    {
        $vid = $this->vid('years');
        $parentQ = db_select('taxonomy_term_data', 't');
        $parentQ->leftJoin('taxonomy_term_hierarchy', 'h', 'h.tid = t.tid');
        $parentQ->fields('t', array('tid', 'name'));
        $parents = $parentQ->condition('t.vid', $vid)->condition('h.parent', 0)->execute()->fetchAll();
        $data = array();
        foreach($parents as $parent) {
            $data[$parent->tid]['name'] = $parent->name;
            $tid = $parent->tid;
            $childQ = db_select('taxonomy_term_data', 't');
            $childQ->leftJoin('taxonomy_term_hierarchy', 'h', 'h.tid = t.tid');
            $child = $childQ->fields('t', array('name'))->condition('h.parent', $parent->tid)->execute()->fetchCol();
            $data[$parent->tid]['child'] = $child;
        }
        $this->years = $data;
        return $data;
    }

    public function template($machine_name) {
        global $language;
        $lang = $language->language ?? 'ko';

        $data = $this->index($machine_name);
        $html = '<div class="fc_box01"><p class="td01">총 <em>'.$data['total'].'개</em>의 태그가 있습니다.</p></div>';
        if($lang == 'en') {
          $html = '<div class="fc_box01"><p class="td01"><em>'.$data['total'].'</em> keywords</p></div>';
        }
        if($machine_name === 'years') {
            $html .= '<div class="ng02"><div class="tagA">';
            foreach($data['index'] as $index) {
                $html .= '<a class="btn03" href="/archive/'.$machine_name.'/?search=' . $index['name'] . '">#' . $index['name'] . '</a>';
                foreach($index['child'] as $child) {
                    $html .= '<a class="btn03" href="/archive/'.$machine_name.'/?search=' . $child . '">#' . $child . '</a>';
                }
                $html .= '<br />';
            }
            $html .= '</div></div>';
        } else {
            foreach($data['index'] as $i => $index) {
                if($index) {
                    if($i === 0) {
                        $h3 = 'ㄱ~ㅅ';
                    } elseif($i === 1) {
                        $h3 = 'ㅇ~ㅎ';
                    } else {
                        $h3 = 'A~Z';
                    }
                    $html .= '<div class="ng02"><h3>'.$h3.'</h3><div class="tagA">';
                    foreach($index as $term) {
                        $html .= '<a class="btn03" href="/' . $lang . '/archive/'.$machine_name.'/?search=' . $term . '">#' . $term . '</a>';
                    }
                    $html .= '</div></div>';
                }
            }
        }
        return $html;
    }

    public function getYears($machine_name)
    {
        $search = $_GET['search'] ?? "";
        $term = taxonomy_get_term_by_name($search, $machine_name);
        $tid = key($term);
        $parent = taxonomy_get_parents($tid);
        if (empty($parent)) {
            $pid = $tid;
        }
        else {
            $pid = key($parent);
        }
        $this->yearsQeury();
        $html = '';
        if (!empty($this->years[$pid])) {
            $html .= '<a class="btn03" href="' . $lang . '/archive/years/?search=' . $this->years[$pid]['name'] . '">#' . $this->years[$pid]['name'] . '</a>';
            asort($this->years[$pid]['child']);
            foreach($this->years[$pid]['child'] as $child) {
                $html .= '<a class="btn03" href="' . $lang . '/archive/years/?search=' . $child . '">#' . $child . '</a>';
            }
        }

        return $html;
    }

    public function getMap()
    {
        $search = $_GET['search'] ?? '';
        $term = taxonomy_get_term_by_name($search, 'location');
        $term = array_shift($term);
        $view = taxonomy_term_view($term);
        return render($view);
    }

    public function getPerson()
    {
        $search = str_replace('"', '', $_GET['search']) ?? '';
        $term = taxonomy_get_term_by_name($search, 'person');
        $info = array_shift($term);
        return array(
            'name' => $info->name,
            'description' => $info->description,
            'lifetime' => ($info->field_lifetime) ? $info->field_lifetime['und'][0]['value'] : '?'
        );
    }
}

class Search extends Slowalk
{
    public $key;

    public function execute()
    {
        if($this->key) {
            $result = db_select('search_index', 'si')->fields('si', array('sid'))->condition('word', $this->key)->execute();
        }
    }
}
?>
