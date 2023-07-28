<?php
/**
 * Created by PhpStorm.
 * User: woonjjang
 * Date: 2023-07-28
 */

$action = '/search' . ((current_path() == 'search/term') ? '/term' : '');
?>
<header>
  <div class="inner">
    <h1 class="lg01">
      <a href="<?php print $front_page;?>">KYEOL|Research Institute on Japanese Military Sexual Slavery</a>
      <em><b><?php print $vol;?></b><i>.vol</i></em>
    </h1>
    <ul class="global-nav ml-4 mt-10 float-left">
      <li class="mx-6 float-left">
        <a href="/en/comfort-women">"Comfort Women"</a>
      </li>
      <li class="mx-6 float-left">
        <a href="/en/rimss">About</a>
      </li>
      <li class="mx-6 float-left">
        <a href="/en/category/articles">Contents</a>
      </li>
      <li class="mx-6 float-left">
        <a href="/en/resources">Resources</a>
      </li>
    </ul>
    <ul class="ng01">
      <li class="search"><a href="#" title="Open search box"><i class="xi-search"></i></a></li>
      <li class="translate"><a href="/" title="Translate" ><span>KR</span></a></li>
      <li class="menu"><a href="#" title="메뉴 열기"><i class="xi-bars"></i></a></li>
    </ul>
    <nav class="displayNone">
      <a href="#" class="btn_icon01" title="메뉴 닫기"><i class="xi-close"></i></a>
      <h2>주 메뉴</h2>
      <ul id="main-menu" class="links inline clearfix">
        <li class="menu-520 first"><a href="/en/taxonomy/term/7" title="Interviews">Interviews</a></li>
        <li class="menu-519"><a href="/en/taxonomy/term/4" title="Essays">Essays</a></li>
        <li class="menu-518"><a href="/en/taxonomy/term/3" title="Reviews">Reviews</a></li>
        <li class="menu-515"><a href="/en/taxonomy/term/2" title="Discussions">Discussions</a></li>
        <li class="menu-516"><a href="/en/taxonomy/term/5" title="Document Explanations">Document Explanations</a></li>
        <li class="menu-764 last"><a href="/en/category/articles">ALL</a></li>
      </ul>
      <h2>부 메뉴</h2>
      <ul id="secondary-menu" class="links inline clearfix">
        <li class="menu-524 first"><a href="/en/archive/person" title="">Overview</a></li>
        <li class="menu-610"><a href="/en/kyeol" title="">About Kyeol</a></li>
        <!-- <li class="menu-935 last"><a href="/en/newsletters" title="">뉴스레터</a></li> -->
      </ul>
    </nav>
    <form class="cf01 displayNone" method="post" action="/en/search">
      <fieldset>
        <label for="search_query">Search Keyword</label>
        <input type="text" name="key" id="search_query" placeholder="Type in here ..." value="<?php print ($_GET['key']) ?? '';?>"/>
        <button><i class="xi-search"></i>search</button>
      </fieldset>
      <a href="#" class="btn_icon01" title="Close search box"><i class="xi-close"></i></a>
    </form>
  </div>
  <?php print render($page['header']); ?>
</header>
