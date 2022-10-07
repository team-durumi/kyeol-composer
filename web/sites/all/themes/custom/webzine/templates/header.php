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
    </h1>
      <ul class="global-nav ml-10 mt-8 float-left text-gray-900 rounded-full bg-white">
        <li class="mx-6 float-left py-2">
          <a href="/featured" title="특집 메뉴">특집</a>
        </li>
        <li class="mx-6 float-left py-2">
          <a href="/category/인터뷰" title="인터뷰 메뉴">인터뷰</a>
        </li>
        <li class="mx-6 float-left py-2">
          <a href="/category/에세이" title="에세이 메뉴">에세이</a>
        </li>
        <li class="mx-6 float-left py-2">
          <a href="/category/논평" title="논평 메뉴">논평</a>
        </li>
        <li class="mx-6 float-left py-2">
          <a href="/category/좌담" title="좌담 메뉴">좌담</a>
        </li>
        <li class="mx-6 float-left py-2">
          <a href="/category/자료해제" title="자료해제 메뉴">자료해제</a>
        </li>
      </ul>
      <ul class="ng01">
        <li class="search focus:outline-none focus:ring"><a href="#" title="검색창 열기"><i class="xi-search"></i></a></li>
        <li class="menu focus:outline-none focus:ring"><a href="#" title="메뉴 열기"><i class="xi-bars"></i></a></li>
        <li class="swichtoen lg:text-3xl md:text-3xl text-white">
          <a href="/en" title="영문 웹진으로 이동"><span class="focus:outline-none focus:ring-2 focus:ring-red-900">EN</span>
          </a>
        </li>
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
