<header>
  <div class="inner">
    <div class="lg01">
      <!-- Research Institute on Japanese Military Sexual Slavery-Webzine-KYEOL -->
      <a href="<?php print $front_page;?>"><?php print $site_name;?></a>
      <em><b><?php print $vol;?></b><i>.vol</i></em>
    </div>
    <ul class="global-nav ml-4 mt-10 float-left" style="margin-left: 3rem;">
      <li class="mx-6 float-left">
        <a href="/en/comfort-women">"Comfort Women"</a>
      </li>
      <li class="mx-6 float-left">
        <a href="/en/about-us">RIMSS</a>
      </li>
      <li class="mx-6 float-left">
        <a href="/en/kyeol">KYEOL</a>
      </li>
      <li class="mx-6 float-left">
        <a href="/en/category/articles">Contents</a>
      </li>
    </ul>
    <ul class="ng01">
      <li class="search"><a href="#" title="Open search box"><i class="xi-search"></i></a></li>
      <li class="translate"><a href="/" title="Translate" ><i style="font-size: 1.955rem">KR</i></a></li>
    </ul>
    <form class="cf01" method="post" action="/en/search">
      <a href="#" class="btn_icon01" title="Close search box"><i class="xi-close"></i></a>
      <fieldset>
        <label for="search_query">Search Keyword</label>
        <input type="text" name="key" id="search_query" placeholder="Type in here ..."/>
        <button><i class="xi-search"></i></button>
      </fieldset>
    </form>
  </div>
  <?php print render($page['header']); ?>
</header>
<?php /*
<header>
    <div class="inner">
        <div class="lg01">
            <a href="<?php print $front_page;?>"><?php print $site_name;?></a>
            <em><b><?php print $vol;?></b><i>.vol</i></em>
        </div>
        <ul class="ng01">
            <li class="search"><a href="#" title="검색창 열기"><i class="xi-search"></i></a></li>
            <li class="menu"><a href="#" title="메뉴 열기"><i class="xi-bars"></i></a></li>
        </ul>
        <nav>
            <a href="#" class="btn_icon01" title="메뉴 닫기"><i class="xi-close"></i></a>
            <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu'))); ?>
            <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Secondary menu'))); ?>
        </nav>
        <form class="cf01" method="get" action="<?php print $action;?>">
            <a href="#" class="btn_icon01" title="검색창 닫기"><i class="xi-close"></i></a>
            <fieldset>
                <label for="search_query">검색어</label>
                <input type="text" name="key" id="search_query" placeholder="검색어를 입력해 주세요" value="<?php print ($_GET['key']) ?? '';?>"/>
                <button><i class="xi-search"></i></button>
            </fieldset>
        </form>
    </div>
    <?php print render($page['header']); ?>
</header>
*/ ?>
