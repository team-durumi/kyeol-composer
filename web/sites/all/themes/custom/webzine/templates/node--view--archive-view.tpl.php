<?php
/**
 * Created by PhpStorm.
 * User: js
 * Date: 2019-03-09
 * Time: 20:52
 */
$vol_params = [
    'class' => 'btn02 version',
    'type' => '%02d',
    'suffix' => '년',
];
if($lang == 'en') {
    unset($vol_params['suffix']);
}
?>
<?php if ($node_url): ?>
<a href="<?php print $node_url;?>" class="thumb"><span><img src="<?php print image_style_url('article_thumbnail', $content['field_image'][0]['#item']['uri']);?>" alt="<?php print $title;?>" alt="<?php print $title;?>"/></span></a>
<?php endif ?>
<dl class="conA">
    <dt>
        <span class="category">
            <?php print get_term_link($content['field_vol'], $vol_params);?>
            <?php print get_term_link($content['field_category'], array('class' => 'btn02 mention'));?>
        </span>
        <a href="<?php print $node_url;?>"><?php print $title;?></a>
    </dt>
    <dd>
        <p class="summury"><?php print strip_tags($content['body'][0]['#markup']);?></p>
        <p class="meta">
            <span><?php print get_writers($content['field_writer']);?></span>
            <em><?php print format_date($created, 'custom', 'Y.m.d');?></em>
        </p>
    </dd>
</dl>
