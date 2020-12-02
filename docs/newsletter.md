## 뉴스레터 목록 추가하기

일단 현재 스티비 뉴스레터 아카이브 페이지에서 제목, 날짜 등 필요한 데이터를 추출한다.

- https://page.stibee.com/archives/31206
- https://page.stibee.com/archives/68725

```
anchors = document.getElementsByTagName("a");
for (anchor of anchors) { console.log(anchor.getAttribute('href')); }

dates = document.querySelectorAll('span.date');
for (date of dates) { console.log(date.textContent); }
mkdir -p /vagrant/dump/newsletters
mkdir -p 20200722 20200708 20200624 20200610 20200527
mkdir -p 20201111 20201028 20201014 20200930 20200916 20200902 20200813 20200805

cp -r /vagrant/dump/newsletters /vagrant/web/sites/default/files/
```

다음으로 httrack으로 루프돌며 가져오려고 했으나, 이미지가 다운로드가 안되서 포기.

```
# apt-get -y -qq install httrack

LINKS=(https://stib.ee/3Wc2 https://stib.ee/j4a2 https://stib.ee/CIY2 https://stib.ee/X1W2 https://stib.ee/3fT2 https://stib.ee/94R2 https://stib.ee/SjM2 https://stib.ee/GaN2 https://stib.ee/CPK2 https://stib.ee/KFI2 https://stib.ee/tCF2 https://stib.ee/laB2 https://stib.ee/blB2)

# for link in "${LINKS[@]}";
#   do echo "$link $@";
# done
# httrack "https://website-url.com/" -O "/path-to-destnation-directory"

for link in "${LINKS[@]}";
  do
  echo -n "$link --> "
  wget -q -O - "$link" | \
    tr "\n" " " | \
    sed 's|.*<title>\([^<]*\).*</head>.*|\1|;s|^\s*||;s|\s*$||'
  echo
done

httrack "https://stibee.com/api/v1.0/emails/share/Fuz9ssM0SVl_x3SSpE7XpM7a_Xgk-Q==" -O "/vagrant/dump/newsletters/"
```

페이지에 방문해서 하나씩 크롬에서 각 날짜별 디렉토리를 만들고 index.html 이름으로 저장했다.
저장한 디렉토리로 드루팔 public files 디렉토리 밑에 놓는다.

slowalk 모듈에 menu, page 추가 후 수집한 메타 정보를 yaml로 templates 디렉토리에 놓고
``` sudo apt-get install -y php7.3-yaml ```
한 후 해당 yaml을 읽어서 템플릿에서 루프돌면서 li로 출력했다.
클릭하면 새창으로 아까 복사한 주소를 링크했다.
