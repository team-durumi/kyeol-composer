# 일본군'위안부'문제연구소 웹진 결

일본군‘위안부’문제연구소는 ‘위안부’ 문제에 관한 체계적인 조사와 연구를 수행하고, 국민의 이해를 돕기 위한 교육과 홍보를 진행하기 위해 2018년 8월 한국여성인권진흥원에 개소하였습니다.

웹진 <결>은 ‘위안부’ 문제에 관한 연구자의 활동을 장려하고, 국민들의 관심을 모으고, 일반 대중의 이해를 높이고자 연구소가 발행하는 웹진입니다.

```
sudo service apache2 stop && sudo service php7.3-fpm stop
echo 'user_allow_other' | sudo tee -a /etc/fuse.conf
rclone mount drive:files /data/kyeol/files --daemon --allow-other
sudo service apache2 start && sudo service php7.3-fpm start
```

## composerfiy fix

```
cd {{ project-dir }}
scp -r kyeol:/var/www/html/kyeol/sites/all/libraries web/sites/all/
scp -r kyeol:/var/www/html/kyeol/sites/all/modules/ckeditor/plugins/ web/sites/all/modules/contrib/ckeditor/

# http://localhost:8080/admin/config/content/ckeditor/edit/Full
# 편집기 모양 > Support for Linkit module => 껏다 켜기

```

## patches

- drupal/ckeditor - [Add %conf_path% and %plugin_module_path% to plugin path render placeholders/replacements to make features reusable](https://www.drupal.org/project/ckeditor/issues/2422875)
- drupal/media_ckeditor - [Not able to submit in media browser](https://www.drupal.org/project/media_ckeditor/issues/3164945)
- drupal/drupal - [[D7] Duplicate HTML IDs are created for file_managed_file fields](https://www.drupal.org/project/drupal/issues/2594955)


## Modules for multilingual drupal (entity translation, i18n)

```zsh
$ drush -y en entity_translation title
$ drush -y en i18n_select i18n_variable i18n_string i18n_block
$ drush -y en i18n_menu i18nviews
```

- https://www.drupal.org/docs/7/multilingual
- [HowTo: Different home page (default front page) for each language](https://www.drupal.org/node/1216132)
- [Multilingual frontpage with translation and URL alias](https://www.drupal.org/node/301587)

## 영문 사이트 정보

- site_name: Webzine-KYEOL
- site_slogan: Research Institute on Japanese Military Sexual Slavery (RIMSS) Webzine

- 인터뷰: Interview
- 에세이: Essay
- 논평: Comment
- 좌담: Discussion
- 자료해제: Bibliographical Explanation
- Sort by – Person / Subject / Region / Writer / Glossary
- 자료실 : Resource
- 소개 : About

## 영문 일반 페이지

- "Comfort Women" - 위안부 용어 소개 - /comfort-women (신규)
- RIMSS - 연구소 소개 소개 - /rimss (신규)
- KYEOL - 웹진 결 소개 - /kyeol (신규)

```
/en/comfort-women
/en/rimss
/en/kyeol
```

## 영문 홈페이지 구조

- wz_main_slide - block - 메인 슬라이드
- about-three-col2 - slowalk/modules/block/template - 소개
- Essay 3 - views.view.recent_contents.essay
- Interview 2 - views.view.recent_contents.interview
- Researcher Forum 1 - views.view.recent_contents.researcher_forum

@see webzine_preprocess_page  (near bottom)

## 다국어 번역 설정 작업 상세 내역

### 언어 설정

- /admin/config/regional/language - english 사용
- /admin/config/regional/language/configure - 인식 방법 URL 2개 모두 체크

```zsh
$ drush -y en entity_translation title
```

### 엔티티 번역 설정 /admin/config/regional/entity_translation

- Use only enabled languages
- Translatable entity types - content, tag
- Pathauto - all alias

### 콘텐츠 유형 수정하기 admin/structure/types/manage/article/fields

- 공개 > Enabled, with field translation 엔터티 번역 설정
- 필드 수정, title 필드 변환, body

### 분류 수정하기

- /admin/structure/taxonomy/article_category/edit vocab 번역 설정
- /admin/structure/taxonomy/article_category/fields 이름, 설명 필드 번역 사용

### 엔티티 번역 설정

- /admin/config/regional/entity_translation content, term 모두 체크

```zsh
drush -y en i18n_block i18n_menu i18n_select i18n_string i18n_variable i18nviews
```

### 다국어 변수 설정

- /admin/config/regional/i18n/variable 홈페이지 모두 선택

### 문자열 번역 설정

- /admin/config/regional/i18n/strings Translatable text formats 모두 선택

### 사이트 정보 설정

- /en/admin/config/system/site-information
- site_name: Webzine-KYEOL
- site_slogan: Research Institute on Japanese Military Sexual Slavery (RIMSS) Webzine

### 홈페이지 슬라이드 설정

- /en/admin/webzine/slide 영문용 슬라이드 정보 및 이미지 지정

### 홈페이지 최신 글 블록용 뷰 추가

- config/sync/views.view.recent_contents.php

### 영문용 Resources 콘텐츠 유형 및 뷰 생성

- 기존에 있던 관련 기록과 자료:data 유형 사용
- config/sync/views.view.resources.php



```
