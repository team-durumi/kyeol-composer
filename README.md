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


## multilingual drupal (translation, i18n)

```
# https://www.drupal.org/docs/7/multilingual
drush -y en entity_translation title

# [HowTo: Different home page (default front page) for each language](https://www.drupal.org/node/1216132)
drush -y en i18n_select i18n_variable i18n_string i18n_block

# [Multilingual frontpage with translation and URL alias](https://www.drupal.org/node/301587)

```

1. 영어 언어 추가 및 사용 /admin/config/regional/language
2. UI, 콘텐츠 언어 인식 설정 추가 /admin/config/regional/language/configure
3. 엔티티 번역 설정 추가 /admin/config/regional/entity_translation
   - 기본 언어 = 기본 언어
   - [x] Hide language selector
   - [x] Exclude Language neutral from the available languages
   - [x] Prevent language from being changed once the entity has been created
   - [x] Hide shared elements on translation forms

## 영문 사이트 정보

- site_name: Webzine-KYEOL
- site_slogan: Research Institute on Japanese Military Sexual Slavery (RIMSS) Webzine

## 영문 일반 페이지

- "Comfort Women" - 위안부 용어 소개 - /comfort-women (신규)
- RIMSS - 연구소 소개 소개 - /rimss (신규)
- KYEOL - 웹진 결 소개 - /kyeol (신규)

```
/en/comfort-women
/en/rimss
/en/kyeol
```

## 영문 콘텐츠 번역본

- http://kyeol.durumi.io/en/node/133
- http://kyeol.durumi.io/en/node/138
- http://kyeol.durumi.io/en/node/139
- http://kyeol.durumi.io/en/node/160

## 영문 홈페이지 구조

- wz_main_slide - block - 메인 슬라이드
- about-three-col2 - slowalk/modules/block/template - 소개
- Essay 3
- Interview 2
- Researcher Forum 1

```
$variables['page']['content']['slider'] = $slider;
$variables['page']['content']['about'] = $about;
```
