<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html>
<html lang="ko">
<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta name="description" content="일본군 위안부 문제관련 자료 조사, 수집, 연구, 웹진결 발간">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
  <meta content="yes" name="apple-mobile-web-app-capable" />
  <meta content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" name="viewport" />
  <!--Naver site verification -->
  <meta name="naver-site-verification" content="d2a758ffce5b500bc8ffe7888eec3289caaf7ceb" />
  <meta name="google-site-verification" content="NnfLR0jiAgl9MAW7jzw6HuyyqHQrEalkMHimZTKo6m4" />
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-XWGCLMK7TP"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-XWGCLMK7TP');
    gtag('config', 'AW-11290513099');
  </script>
  <!-- Google ADsense 1-0025000037372 -->
  <script>
  (function() {
  // === Override dataLayer.push to Listen for 'first_visit' Event ===
  window.dataLayer = window.dataLayer || [];
  const originalPush = window.dataLayer.push;

  window.dataLayer.push = function() {
  // Iterate through the arguments to detect 'first_visit' events
  for (let i = 0; i < arguments.length; i++) {
  const event = arguments[i].event;
  if (event === 'first_visit') {
  initiateFirstUserTimer();
  }
  }
  // Call the original dataLayer.push method
  return originalPush.apply(window.dataLayer, arguments);
  };

  // === Function to Detect and Push 'first_visit' Event ===
  function detectFirstVisit() {
  if (!sessionStorage.getItem('hasVisited')) {
  sessionStorage.setItem('hasVisited', '1');
  window.dataLayer.push({ event: 'first_visit' });
  }
  }

  // Call the function on script load
  detectFirstVisit();

  // === Function to Initiate 30-Second Timer for First-Time Users ===
  function initiateFirstUserTimer() {
  const firstUserThreshold = 30; // 30 seconds (adjust as needed)
  const firstUserEventName = 'conversion_event_page_view_4'; // GA4 Event Name
  const firstUserTimeRemainKey = `first_user_time_remain_${firstUserThreshold}`;
  const firstUserIsTriggeredKey = `first_user_is_triggered_${firstUserThreshold}`;
  let firstUserTimeRemain = parseInt(sessionStorage.getItem(firstUserTimeRemainKey)) || firstUserThreshold;

  if (!sessionStorage.getItem(firstUserIsTriggeredKey)) {
  sessionStorage.setItem(firstUserIsTriggeredKey, '1');
  }

  if (firstUserTimeRemain > 0) {
  setTimeout(() => {
  // Set timeRemain to 0 before finalizing
  firstUserTimeRemain = 0;
  finalizeFirstUser();
  }, firstUserTimeRemain * 1000);
  }

  function finalizeFirstUser() {
  if (firstUserTimeRemain <= 0 && sessionStorage.getItem(firstUserIsTriggeredKey) === '1') {
  gtag('event', firstUserEventName);
  sessionStorage.setItem(firstUserIsTriggeredKey, '0');
  }
  sessionStorage.setItem(firstUserTimeRemainKey, firstUserTimeRemain);
  }

  const firstUserTimeBegin = Date.now();
  window.addEventListener('beforeunload', () => {
  const elapsedFirstUserTime = Math.floor((Date.now() - firstUserTimeBegin) / 1000);
  firstUserTimeRemain = Math.max(0, firstUserTimeRemain - elapsedFirstUserTime);
  finalizeFirstUser();
  });
  }

  // === Overall Site Time Tracking ===
  const overallThresholds = [
  { threshold: 180, eventName: 'conversion_event_page_view' }, // 3 minute
  { threshold: 600, eventName: 'conversion_event_page_view_1' }, // 10 minutes
  { threshold: 1800, eventName: 'conversion_event_page_view_2' }, // 30 minutes
  { threshold: 3600, eventName: 'conversion_event_page_view_3' } // 60 minutes
  ];

  overallThresholds.forEach(({ threshold, eventName }) => {
  const timeRemainKey = `time_remain_${threshold}`;
  const isTriggeredKey = `is_triggered_${threshold}`;
  let timeRemain = parseInt(sessionStorage.getItem(timeRemainKey)) || threshold;

  if (!sessionStorage.getItem(isTriggeredKey)) {
  sessionStorage.setItem(isTriggeredKey, '1');
  }

  if (timeRemain > 0) {
  setTimeout(() => {
  // Set timeRemain to 0 before finalizing
  timeRemain = 0;
  finalizeOverallEvent(threshold, eventName);
  }, timeRemain * 1000);
  }

  function finalizeOverallEvent(currentThreshold, currentEventName) {
  if (timeRemain <= 0 && sessionStorage.getItem(isTriggeredKey) === '1') {
  gtag('event', currentEventName);
  sessionStorage.setItem(isTriggeredKey, '0');
  }
  sessionStorage.setItem(timeRemainKey, timeRemain);
  }

  const overallTimeBegin = Date.now();
  window.addEventListener('beforeunload', () => {
  const elapsedOverallTime = Math.floor((Date.now() - overallTimeBegin) / 1000);
  timeRemain = Math.max(0, timeRemain - elapsedOverallTime);
  finalizeOverallEvent(threshold, eventName);
  });
  });

  // === Page-Specific Time Tracking ===
  const pagesToTrack = [
  {
  path: '/comfort-women',
  eventName: 'conversion_event_page_view_5'
  },
  {
  path: '/rimss',
  eventName: 'conversion_event_page_view_6'
  },
  {
  path: '/kyeol',
  eventName: 'conversion_event_page_view_7'
  }
  ];

  const currentPath = window.location.pathname.toLowerCase(); // Convert to lowercase for case-insensitive matching
  const page = pagesToTrack.find(p => currentPath.includes(p.path.toLowerCase())); // Partial match

  if (page) {
  const pageThreshold = 60; // 1 minute (adjust as needed)
  const pageTimeRemainKey = `page_time_remain_${page.path}`;
  const pageIsTriggeredKey = `page_is_triggered_${page.path}`;
  let pageTimeRemain = parseInt(sessionStorage.getItem(pageTimeRemainKey)) || pageThreshold;

  if (!sessionStorage.getItem(pageIsTriggeredKey)) {
  sessionStorage.setItem(pageIsTriggeredKey, '1');
  }

  if (pageTimeRemain > 0) {
  setTimeout(() => {
  // Set pageTimeRemain to 0 before finalizing
  pageTimeRemain = 0;
  finalizePageEvent();
  }, pageTimeRemain * 1000);
  }

  function finalizePageEvent() {
  if (pageTimeRemain <= 0 && sessionStorage.getItem(pageIsTriggeredKey) === '1') {
  gtag('event', page.eventName);
  sessionStorage.setItem(pageIsTriggeredKey, '0');
  }
  sessionStorage.setItem(pageTimeRemainKey, pageTimeRemain);
  }

  const pageTimeBegin = Date.now();
  window.addEventListener('beforeunload', () => {
  const elapsedPageTime = Math.floor((Date.now() - pageTimeBegin) / 1000);
  pageTimeRemain = Math.max(0, pageTimeRemain - elapsedPageTime);
  finalizePageEvent();
  });
  }
  })();
  </script>
  
  <!-- A Schema.org Type Organization -->
  <script type="application/ld+json">
  {
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "일본군 위안부 문제연구소 웹진 결 KYEOL",
  "description": "일본군 위안부 문제관련 자료 조사, 수집, 연구, 웹진결 발간",
  "url": "https://kyeol.kr",
  "sameAs": [
    "https://www.instagram.com/remember_814",
    "https://www.facebook.com/archive814",
    "https://www.youtube.com/@user-vp6ke6ml6d"
  ]
  }
  </script>
  <!-- stylesheet -->
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<div id="skip-link">
  <a href="#main-content" class="element-invisible element-focusable">본문 바로가기</a>
</div>
<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>
<button onclick="topFunction()" id="toTop" title="맨위로"><i class="xi xi-2x xi-arrow-top"></i></button>
</body>
</html>
