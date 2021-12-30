<?php
/**
 * Created by PhpStorm.
 * User: js
 * Date: 2019-03-11
 * Time: 11:59
 */

$action = '/search' . ((current_path() == 'search/term') ? '/term' : '');
?>
<header>
  <div class="inner">
    <h1 class="lg01">
      <a href="<?php print $front_page;?>">결|일본군'위안부'문제연구소 웹진</a>
      <em><b><?php print $vol;?></b><i>.vol</i></em>
    </h1>
      <ul class="global-nav ml-10 mt-10 float-left text-white">
        <li class="mx-6 float-left">
          <a href="/category/인터뷰">인터뷰</a>
        </li>
        <li class="mx-6 float-left">
          <a href="/category/에세이">에세이</a>
        </li>
        <li class="mx-6 float-left">
          <a href="/category/논평">논평</a>
        </li>
        <li class="mx-6 float-left">
          <a href="/category/좌담">좌담</a>
        </li>
        <li class="mx-6 float-left">
          <a href="/category/자료해제">자료해제</a>
        </li>
      </ul>
      <ul class="ng01">
        <li class="search"><a href="#" title="검색창 열기"><i class="xi-search"></i></a></li>
        <li class="menu"><a href="#" title="메뉴 열기"><i class="xi-bars"></i></a></li>
        <li class="translate"><a href="/en" title="Translate" ><i style="font-size: 1.955rem; font-style:normal;">EN</i></a></li>
      </ul>
      <nav class="displayNone">
          <a href="#" class="btn_icon01" title="메뉴 닫기"><i class="xi-close"></i></a>
          <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu'))); ?>
          <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Secondary menu'))); ?>
      </nav>
      <form class="cf01 displayNone" method="get" action="<?php print $action;?>">
          <fieldset>
              <label for="search_query">검색어</label>
              <input type="text" name="key" id="search_query" placeholder="검색어를 입력해 주세요" value="<?php print ($_GET['key']) ?? '';?>"/>
              <button><i class="xi-search"></i>검색하기</button>
          </fieldset>
          <a href="#" class="btn_icon01" title="검색창 닫기"><i class="xi-close"></i></a>
      </form>
  </div>
  <?php print render($page['header']); ?>
</header>
