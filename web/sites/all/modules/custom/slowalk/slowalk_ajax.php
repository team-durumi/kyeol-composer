<?php
/**
 * Created by PhpStorm.
 * User: js
 * Date: 2019-03-05
 * Time: 13:37
 */

function webzine_ajax_callback()
{
    $payloads = [];
    $params = ['type', 'vol', 'category', 'nid', 'key', 'href'];
    if (isset($_POST['type'])) {
        foreach ($params as $param) {
            if (!empty($_POST[$param])) {
                $payloads[$param] = $_POST[$param];
            }
        }
        $data = Slowalk::getData($payloads);
        drupal_json_output($data);
    } else {
        drupal_json_output(array('error' => '정상적인 접근이 아닙니다.'));
    }
}
