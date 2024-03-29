<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any.
 *
 * @ingroup views_templates
 */

$voca = arg(1);
$archive = new Archive();
global $language;
$lang = $language->language;
?>

<?php if(isset($_GET['search'])): ?>

    <div class="fc_box01 fc_box01_01 tags">
    <?php if($lang != 'en'): ?>
      <p class="td01 leftF"><b>"<?php print filter_xss($_GET['search']);?>"</b>에 관련된 기사는 <em><?php print $view->total_rows;?></em>건입니다.</p>
      <a class="btn01 rightF" href="/<?php print request_path();?>">목록 보기</a>
      <?php if($voca === 'person') : ?>
        <a class="btn01 rightF person" href="/ajax/webzine">인물 정보</a>
      <?php endif;?>
      <?php if($voca === 'years') : ?>
        <div class="tagA"><?php print $archive->getYears($voca);?></div>
      <?php endif;?>
    <?php else: ?>
      <p class="td01 leftF"><?php print $view->total_rows;?></em> related contents with<em><b>"<?php print $_GET['search'];?>"</b></p>
      <a class="btn01 rightF" href="/<?php print request_path();?>">List</a>
      <?php if($voca === 'person') : ?>
        <a class="btn01 rightF person" href="/ajax/webzine">Person</a>
      <?php endif;?>
      <?php if($voca === 'years') : ?>
        <div class="tagA"><?php print $archive->getYears($voca);?></div>
      <?php endif;?>
    <?php endif; ?>
    </div>

    <?php if($voca === 'location'): ?>

            <?php /*print $archive->getMap(); 190917 구글맵 임시 주석처리 */ ?>

    <?php endif;?>

    <div class="<?php print $classes; ?>">
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
            <?php print $title; ?>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($header): ?>
            <div class="view-header">
                <?php print $header; ?>
            </div>
        <?php endif; ?>

        <?php if ($attachment_before): ?>
            <div class="attachment attachment-before">
                <?php print $attachment_before; ?>
            </div>
        <?php endif; ?>

        <?php if ($rows): ?>
            <div class="view-content">
                <?php print $rows; ?>
            </div>
        <?php elseif ($empty): ?>
            <div class="view-empty">
                <?php print $empty; ?>
            </div>
        <?php endif; ?>

        <?php if ($pager): ?>
            <?php print $pager; ?>
        <?php endif; ?>

        <?php if ($attachment_after): ?>
            <div class="attachment attachment-after">
                <?php print $attachment_after; ?>
            </div>
        <?php endif; ?>

        <?php if ($more): ?>
            <?php print $more; ?>
        <?php endif; ?>

        <?php if ($footer): ?>
            <div class="view-footer">
                <?php print $footer; ?>
            </div>
        <?php endif; ?>

        <?php if ($feed_icon): ?>
            <div class="feed-icon">
                <?php print $feed_icon; ?>
            </div>
        <?php endif; ?>

    </div>
<?php else: ?>

    <?php print $archive->template($voca);?>

<?php endif;?>
