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
  <!-- A Schema.org Type Organization -->
  <script type="application/ld+json">
  {
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "일본군 위안부 문제연구소 웹진 결 KYEOL",
  "description": "일본군 위안부 문제관련 자료 조사, 수집, 연구, 웹진 웹진결 발간",
  "url": "https://kyeol.kr",
  "sameAs": [
    "https://www.instagram.com/remember_814",
    "https://www.facebook.com/archive814",
    "https://www.youtube.com/@user-vp6ke6ml6d"
  ]
  }
  </script>
  <title><?php print $head_title; ?></title>
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
