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

    <div class="panel-pane pane-custom pane-1">
			<div class="pane-content">
				<div class="inner">
					<div class="btns"><a class="btn01" href="/en/category/articles"><i class="xi-plus"></i> Read more </a></div>
				</div>
			</div>
		</div>
  </div>
  <!-- //메인 컨텐츠 영역 -->
  <footer>
    <div class="inner">
      <?php include_once 'footer--en.php'; ?>
    </div>
  </footer>
</div>
<!-- //main_wrap -->
