<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<div id="main_wrap" class="mainPage">
  <?php include_once 'header.php';?>

  <!-- 서브 컨텐츠 영역 -->
  <?php if($main_class === 'fc04') : ?>
  <div class="<?php print $main_class;?>" id="main-content">
    <div class="th02"<?php print $image;?>>
      <div class="inner">
        <div class="category">
          <a class="btn02 category" href="<?php print $category_path;?>"><?php print $category;?></a>
        </div>
        <h1><?php print $title;?></h1>
        <div class="writers">
          <p><b>글</b>
          <?php foreach($writers as $writer): ?>
            <b><?php print htmlspecialchars($writer['name']);?></b><em><?php print $writer['info'];?></em>
          <?php endforeach;?>
          </p>
        </div>
        <ul class="metas">
          <li><b>게시일</b><span><?php print format_date($created, 'custom', 'Y.m.d');?></span></li>
          <li><b>최종수정일</b><span><?php print format_date($changed, 'custom', 'Y.m.d');?></span></li>
        </ul>
        <div class="ng03" aria-hidden="true">
          <a href="#" class="share" title="공유하기"><i class="xi-share-alt-o"></i></a>
          <dl>
            <dt><label for="share_url">게시글을 공유해보세요</label></dt>
            <dd>
              <input id="share_url" type="text" title="공유 주소" name="share_url" value="<?php print $url;?>"/>
              <button>링크복사</button>
            </dd>
          </dl>
        </div>
      </div>
    </div>
    <section>
      <div class="inner">
        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print $messages;?>
      </div>
      <?php print render($page['content']);?>
    </section>
  </div>
  <?php else: ?>
  <div class="<?php print $main_class;?>" >
    <div class="inner">
      <nav><?php print $breadcrumb;?></nav>
      <!-- 사이드바 영역 -->
      <?php if ($page['sidebar_first']): ?>
      <aside>
        <div id="sidebar-first" class="column sidebar">
          <div class="section">
            <?php print render($page['sidebar_first']); ?>
          </div>
        </div>
      </aside>
      <?php endif; ?>
      <!-- //사이드바 영역 -->
      <section id="main-content">
          <div class="header">
            <?php print render($title_prefix); ?>
            <?php $keyword = (!empty($_GET['search'])) ? '<small> - ' . htmlspecialchars($_GET['search']) . '</samll>' : ''; ?>
            <?php if ($title): ?>
            <h1 class="title" id="page-title"><?php print $title . $keyword; ?></h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
          </div>
          <div class="cBody">
            <?php print $messages;?>
            <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
            <?php print render($page['content']); ?>
            <?php print $feed_icons; ?>
          </div>
      </section>
    </div>
  </div>
  <?php endif;?>
  <!-- 뉴스레터 -->
  <div class="fc01_03">
    <div class="inner">
      <h2>일본군'위안부'문제연구소의 <br/>새로운 소식을 받아보세요</h2>
      <div class="cf02">
        <button onclick="location.href='https://stop.or.kr/home/kor/M128619676/newsletter/apply.do'">뉴스레터 신청하기</button>
      </div>
    </div>
  </div>
  <!-- //뉴스레터 -->
  <!-- //서브 컨텐츠 영역 -->
  <footer>
    <div class="inner">
      <?php print render($page['footer']);?>
    </div>
  </footer>
</div>
<!-- //main_wrap -->
