/*
Theme Name: webzine
Author: css3studio
Version:1.0
*/
var device_status = "";
var $ = jQuery;
$(window).resize(function() {
	var dw = viewport().width;
	if(dw <= 768 && device_status == "pc"){	//PC에서 모바일로 변경시
		$("body").removeClass('pc');
		$("body").addClass('mobile');
		init_mobile();
		device_status = "mobile";
	}else if(dw > 768 && device_status == "mobile"){	//모바일에서 PC로 변경시
		$("body").removeClass('mobile');
		$("body").addClass('pc');
		init_pc();
		device_status = "pc";
	}
});

/* 메뉴고정 */
$(window).scroll(function(e){
	if ($(window).scrollTop() > 0) {
		$("body.pc").addClass("scrolling");
	} else {
		$("body.pc").removeClass("scrolling");
	}
});
function viewport() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

$(document).ready(function() {

	var dw = viewport().width;
	if(dw <= 768){	//모바일
		$("body").removeClass('pc');
		$("body").addClass('mobile');
		init_mobile();
		device_status = "mobile";
	}else{	//PC
		$("body").removeClass('mobile');
		$("body").addClass('pc');
		init_pc();
		device_status = "pc";
	}
  	//메인슬라이더
	$('.ib01 .slide li').each(function(){
		$(this).css({'background-image':'url('+$('img',$(this)).attr('src')+')'});
		//$('img',$(this)).remove();
	});
  $('.ib01 .slide').on('init', function(){  //2021.8.3 웹접근성 작업
    $('.slick-dots').append($('<li class="pause"><a href="#" title="일시정지하기" class="pause"><i class="xi-pause"></i></a><a href="#" title="재생하기" class="play"><i class="xi-play"></i></a></li>'));
    setTimeout(function(){
      $('.slick-dots li button').attr('tabindex','0');
    },300);
});
  $('.ib01 .slide').on('afterChange', function(event,slick,currentSlide,nextSlide){ //2021.8.3 웹접근성 작업
      setTimeout(function(){
        $('.slick-dots li button').attr('tabindex','0');
      },300);
  });
  $('.ib01 .slide').slick({
		autoplay:true,
		fade:true,
		speed:1400,
		autoplaySpeed:6000,
		arrows:false,
		dots:true
	});

  $('.slick-dots .pause a').click(function(){  //2021.8.3 웹접근성 작업
    if($(this).parent().hasClass('play')){
      $('.ib01 .slide').slick('slickPlay');
      $(this).parent().removeClass('play');
    }else{
      $('.ib01 .slide').slick('slickPause');
      $(this).parent().addClass('play');
    }
  });


	//검색창 열기/닫기
	$('header .ng01 .search a').click(function(){ //2021.8.3 웹접근성 작업
		$('.cf01').removeClass('displayNone');
    window.setTimeout(function(){
      $('header').addClass('searchOpened');
      $('.cf01 input').focus();
    },50)

		return false;
	});
	$('header .cf01 a.btn_icon01').click(function(){  //2021.8.3 웹접근성 작업
		$('header').removeClass('searchOpened');
    window.setTimeout(function(){
      $('.cf01').addClass('displayNone');
    },600)
    $('header .ng01 .menu a').focus();
		return false;
	});
	//menu 열기/닫기
	$('header .ng01 .menu a').click(function(){ //2021.8.3 웹접근성 작업
    $('header nav').removeClass('displayNone');
    window.setTimeout(function(){
      $('header').addClass('menuOpened');
    },50)
		return false;
	});
	$('header nav a.btn_icon01').click(function(){  //2021.8.3 웹접근성 작업
		$('header').removeClass('menuOpened');
    window.setTimeout(function(){
      $('header nav').addClass('displayNone');
    },600)
		return false;
	});

	$('#skip-link').click(function(){  //2021.8.13 웹접근성 작업
		$('#main-content a, #main-content button').not('[tabindex="-1"]').first().focus();
		return false;
	});
	$(window).keyup(function(){  //2021.8.13 웹접근성 작업
		//$(':focus')[0].scrollIntoView({behavior: "smooth", block: "center"});
    window.scrollTo( 0, $(':focus').offset().top - ($(window).height() / 2 ) );
	});
  //컨테츠 링크이동 효과 - 2021.8.20 웹접근성 작업
  $(".postA sup > a, .postA .footnotes ol > li > a").click(function(event){     
    $('html,body').animate({scrollTop:$(this.hash).offset().top - 150}, 500,"linear");
		return false;
  });

	//뷰화면 툴팁 오브제 효과
	$(".tt01").click(function(){
		$(".tooltip",$(this)).toggle();
		return false;
	});
	$(".tt01 .tooltip a.close").click(function(){
		$(this).parent().hide();
		return false;
	});
	$(document).mouseup(function(e) {
        var container = $('.tt01');
        if(container.has(e.target).length === 0) {
            $(".tooltip",container).hide();
        }
    });
	//뷰화면 공유기능
	$(".ng03 .share").click(function(){
		$(this).siblings('dl').toggle();
		return false;
	});
	$(document).mouseup(function(e) {
        var container = $('.ng03');
        if(container.has(e.target).length === 0) {
            $("dl",container).hide();
            $("button",container).text('링크복사');
        }
    });
	$(".ng03 dl dd button").click(function(){
		$(this).siblings('input').select();
		document.execCommand('copy');
		$(this).text('완료');
		$(this).append($('<i class="xi-check-min"></i>'));
    setTimeout(function(){
      $('.ng03 dl').hide();
    },1500)
	});

	form_validation();

	//cavac note
  if($("span.cavacnote").length > 0) $("span.cavacnote").cavacnote();
  if($("span.cavacnotify").length > 0) $("span.cavacnotify").cavacnotify();

	//검색 사이드바 클릭시 검색어와 함께 redirect
    $("div.menu-name-menu-search ul.menu li a").click(function (e) {
        e.preventDefault();
        let thisURL = $(this).attr('href');
        let searchParam = new URLSearchParams(window.location.search);
        if(searchParam.has('key')) {
            location.replace(thisURL+'?key='+searchParam.get('key'));
        } else {
            location.replace(thisURL);
        }
    });

    //검색 페이지 접근시 검색 결과 Ajax
	if($('body').hasClass('page-search')) {
		let status = (window.location.pathname === '/search') ? 'keyword' : 'term';
		let searchParam = new URLSearchParams(window.location.search);
		let key = searchParam.get('key');
		$.post('/ajax/webzine', {type:'search', status:status, key:key}).done(function (res) {
			$("div.menu-name-menu-search ul.menu li a:eq(0)").append(' ('+res.keyword+')');
			$("div.menu-name-menu-search ul.menu li a:eq(1)").append(' ('+res.term+')');
		});
	}

	//기사페이지 이미지 슬라이드
	$('.slide ul.slider').slick({
		autoplay:true,
		speed:500,
		adaptiveHeight: true,
		autoplaySpeed:6000,
		arrows:true,
		dots:false,
		asNavFor: '.slide ul.slider-nav'
	});
	$('.slide ul.slider-nav').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		asNavFor: '.slide ul.slider',
		arrows:true,
		dots: true,
		focusOnSelect: true
	});

	//로그인페이지
	$('#user-login input').focus(function() {
		$(this).siblings('.description').hide();
	});
	$('#user-login input').change(function () {
		if($(this).val().length === 0) {
			$(this).siblings('.description').show();
		} else {
			$(this).siblings('.description').hide();
		}
	});
	$('#user-login .description').click(function() {
		$(this).hide();
		$(this).siblings('input').focus();
	});

    //상단 Vol 링크
	$('#main_wrap>header .lg01 em b').mouseover(function () {
		$(this).css('cursor', 'pointer');
	}).click(function () {
		location.replace(Drupal.settings.Webzine.vol);
	});

	//모아보기 - 인물 "인물 정보" 클릭 이벤트
    $('a.person').click(function(e) {
        e.preventDefault();
        $.post('/ajax/webzine', {type:'person', search:$('.td01.leftF b').text()}).done(function(res){
            let box = $('<div />').addClass('person-info-box').append(res.description);
            let title = res.name + ' ('+ res.lifetime +')';
            box.dialog({
            	modal: true,
                title:title,
			    width: 'auto', // overcomes width:'auto' and maxWidth bug
			    maxWidth: 600,
			    height: 'auto',
			    modal: true,
			    clickOut: true,
			    fluid: true, //new option
				position: { my: "center", at: "center", of: window }
            });
        });
    });
	// on window resize run function
	$(window).resize(function () {
	    fluidDialog();
	});

	// catch dialog if opened within a viewport smaller than the dialog width
	$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
	    fluidDialog();
	});

	function fluidDialog() {
	    var $visible = $(".ui-dialog:visible");
	    // each open dialog
	    $visible.each(function () {
	        var $this = $(this);
	        var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
	        // if fluid option == true
	        if (dialog.options.fluid) {
	            var wWidth = $(window).width();
	            // check window width against dialog width
	            if (wWidth < (parseInt(dialog.options.maxWidth) + 50))  {
	                // keep dialog from filling entire screen
	                $this.css("max-width", "90%");
	            } else {
	                // fix maxWidth bug
	                $this.css("max-width", dialog.options.maxWidth + "px");
	            }
	            //reposition dialog
	            dialog.option("position", dialog.options.position);
	        }
	    });
	}

});

//PC버젼 초기화
function init_pc(){

}
//모바일 버젼 초기화
function init_mobile(){
	//모바일용 사이드 메뉴
	$(".sidebar ul.menu li.active a").click(function(){
		$(this).parents('ul.menu').toggleClass('opened');
		return false;
	});
	$(document).mouseup(function(e) {
        var container = $('.sidebar ul.menu');
        if(container.has(e.target).length === 0) {
            container.removeClass('opened');
        }
    });

}
//폼 유효성 검사
function form_validation(){
	//검색창
	$(".cf01").on('submit', function() {
		var input = $("input",$(this));
		if(input.val().trim() == ""){
			alert("검색어를 입력해 주세요");
			input.focus();
			return false;
		}
		else
			return true;
	});
	//뉴스레터
	$(".cf02").validate({
      ignore: [],
      rules: {
          email: {
              required: true,
              email: true
          },
          agreed: { required: true }
      },
      messages: {
          email: "올바른 이메일 주소를 입력하세요",
          agreed: ""
      }
  });



}


// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	if($("#toTop").length){
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			document.getElementById("toTop").style.display = "block";
		} else {
			document.getElementById("toTop").style.display = "none";
		}
	}
}


// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
