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
drush -y en entity_transaltion title 

# [HowTo: Different home page (default front page) for each language](https://www.drupal.org/node/1216132)
drush -y en i18n_select i18n_variable 

# [Multilingual frontpage with translation and URL alias](https://www.drupal.org/node/301587)

```