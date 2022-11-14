<?php
/**
 * Created by PhpStorm.
 * User: js
 * Date: 2019-03-09
 * Time: 10:38
 */
?>

<div id="main_wrap" class="mainPage">
    <?php include_once 'header.php';?>
    <!-- 메인 컨텐츠 영역 -->
    <div class="fc01" id="main-content">
        <?php print render($page['content']); ?>
        <?php print $messages;?>
    </div>
    <!-- 뉴스레터 -->
    <div class="fc01_03">
        <div class="inner">
        <h2>일본군'위안부'문제연구소의 <br/>새로운 소식을 받아보세요</h2>
        <div class="cf02">
            <a href="https://www.stop.or.kr/newsletter/newsletterForm.do" target="_blank">
            <button>뉴스레터 신청하기</button>
            </a>
        </div>
        </div>
    </div>
    <!-- //뉴스레터 -->
    <!-- //메인 컨텐츠 영역 -->
    <footer>
        <div class="inner">
            <?php print render($page['footer']);?>
        </div>
    </footer>
</div>
<!-- //main_wrap -->
