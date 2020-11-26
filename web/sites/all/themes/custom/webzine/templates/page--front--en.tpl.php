<?php
/**
 * English Homepage.
 */
?>

<div id="main_wrap" class="mainPage">
  <?php include_once 'header--en.php';?>
  <!-- 메인 컨텐츠 영역 -->
  <div class="fc01" id="main-content">
    <?php print render($page['content']); ?>
    <?php print $messages;?>
  </div>
  <!-- //메인 컨텐츠 영역 -->
  <footer>
    <div class="inner">
      <?php print render($page['footer']);?>
    </div>
  </footer>
</div>
<!-- //main_wrap -->
