
# 가비아 Sectigo 인증서 Apache 설치하기

- 2021-05-03
- @mozo

https://customer.gabia.com/manual/hosting/435/994

- 인증서 www_kyeol_kr.crt
- 개인키 www_kyeol_kr.key
- 체인 루트 인증서 Chain_RootCA_Bundle.crt

## 1. ssl 인증서 파일 설치

```shell
# ssl 관련 디렉토리 생성
sudo mkdir -p /etc/apache2/ssl/private
sudo chmod 755 /etc/apache2/ssl # 인증서
sudo chmod 710 /etc/apache2/ssl/private # 개인키

# 파일 제 위치에 놓기
sudo mv /data/kyeol/210503-ssl/www_kyeol_kr.crt\
 /data/kyeol/210503-ssl/Chain_RootCA_Bundle.crt /etc/apache2/ssl/
sudo mv /data/kyeol/210503-ssl/www_kyeol_kr.key /etc/apache2/ssl/private/

# 소유권 및 권한 설정
sudo chown -R root:root /etc/apache2/ssl/
sudo chown -R root:ssl-cert /etc/apache2/ssl/private/
sudo chmod 644 /etc/apache2/ssl/*.crt
sudo chmod 640 /etc/apache2/ssl/private/www_kyeol_kr.key
```

# 2. virtualhost 설정 추가

```
<VirtualHost *:443>
  SSLEngine On
  SSLCertificateFile /etc/apache2/ssl/www_kyeol_kr.crt
  SSLCertificateKeyFile /etc/apache2/ssl/private/www_kyeol_kr.key
  SSLCertificateChainFile /etc/apache2/ssl/Chain_RootCA_Bundle.crt

  ServerName kyeol.kr
  ServerAlias www.kyeol.kr
  ServerAdmin hark@durumi.io

  DocumentRoot /var/www/kyeol-composer/web
  <Directory "/var/www/kyeol-composer/web">
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
  </Directory>

  ErrorLog /efs/data/kyeol/logs/error.log
  CustomLog /efs/data/kyeol/logs/access.log combined
</VirtualHost>

<VirtualHost *:80>
  ServerName kyeol.kr
  ServerAlias www.kyeol.kr
  SSLProxyEngine On
  RewriteEngine On
  RewriteCond %{HTTPS} off
  RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [P,R,L]
</VirtualHost>

```

# 3. 아파치 모듈 활성화 및 재시작

```shell
sudo a2enmod ssl proxy-http

cd /etc/apache2/sites-available/
sudo cp /var/www/kyeol-composer/provision/config/kyeol-ssl.conf ./
sudo a2dissite 000-default && sudo a2ensite kyeol-ssl
# sudo a2dissite kyeol-ssl && sudo a2ensite 000-default

sudo service apache2 restart
```

# 가비아 Sectigo 인증서 Apache 갱신하기

- 2023-04-24
- @woonjjang

https://customer.gabia.com/manual/hosting/435/994

- 인증서 www_kyeol_kr.crt
- 개인키 www_kyeol_kr.key
- 체인 루트 인증서 Chain_RootCA_Bundle.crt

```
  SSLCertificateFile /etc/apache2/ssl/www_kyeol.kr_cert.crt
  SSLCertificateKeyFile /etc/apache2/ssl/private/www_kyeol_kr.key
  SSLCertificateChainFile /etc/apache2/ssl/www_kyeol.kr_chain_cert.crt
  SSLCACertificateFile /etc/apache2/ssl/www_kyeol.kr_root_cert.crt
```