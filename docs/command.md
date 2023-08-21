 drush cc all
 1424  exit
 1425  curl kyoel.kr
 1426  curl kyeol.kr
 1427  curl localhost
 1428  history
 1429  apt list --upgradable
 1430  sudo apt-get update && apt-get -y upgrade
 1431  curl kyeol.kr
 1432  cd /var/www/kyeol-composer
 1433  drush uli
 1434  cd
 1435  sudo su
 1436  apt list --upgradable
 1437  sudo su
 1438  cd /var/www/kyeol-composer
 1439  drush uli
 1440  history
 1441  apt-get update && apt-get -y upgrade
 1442  sudo apt-get update && apt-get -y upgrade
 1443  apt list --upgradable
 1444  sudo apt-get update && apt-get -y upgrade
 1445  apt-get update dpkg
 1446  sudo apt-get upgrade
 1447  apt-get update dpkg
 1448  apt list --upgradable
 1449  sudo apt-get -y upgrade
 1450  apt list --upgradable
 1451  cd /var/www/kyeol-composer/
 1452  drush sql:dump --gzip > /home/ubuntu/230319.sql.gz
 1453  df -m
 1454  free -m
 1455  df -m
 1456  exit
 1457  df -m
 1458  free -m
 1459  netstat -ntu|awk '{print $5}'|cut -d: -f1 -s |cut -f1,2 -d'.'|sed 's/$/.0.0/'|sort|uniq -c|sort -nk1 -r
 1460  출처: https://livenow14.tistory.com/48 [경험의 연장선]
 1461  sudo apt install net-tools
 1462  netstat -ntu|awk '{print $5}'|cut -d: -f1 -s |cut -f1,2 -d'.'|sed 's/$/.0.0/'|sort|uniq -c|sort -nk1 -r
 1463  vi .htaccess
 1464  cd /var/www
 1465  ls
 1466  cd kyeol-composer/
 1467  ls
 1468  cd web
 1469  ls
 1470  netstat -ntu|awk '{print $5}'|cut -d: -f1 -s |cut -f1,2,3 -d'.'|sed 's/$/.0/'|sort|uniq -c|sort -nk1 -r
 1471  netstat -anp |grep 'tcp\|udp' | awk '{print $5}' | cut -d: -f1 | sort | uniq -c
 1472  출처: https://livenow14.tistory.com/48 [경험의 연장선]
 1473  $ netstat -anp |grep 'tcp\|udp' | awk '{print $5}' | cut -d: -f1 | sort | uniq -c
 1474  netstat -anp |grep 'tcp\|udp' | awk '{print $5}' | cut -d: -f1 | sort | uniq -c
 1475  sudo route add 162.55.232.112 reject
 1476  netstat -anp |grep 'tcp\|udp' | awk '{print $5}' | cut -d: -f1 | sort | uniq -c
 1477  sudo iptables -A INPUT -s 162.55.0.0/SUBNET -j DROP
 1478  sudo route add 162.55.232.112 reject
 1479  sudo route add 162.55.232.113 reject
 1480  sudo route add 162.55.232.114 reject
 1481  sudo route add 162.55.232.116 reject
 1482  sudo route add 162.55.232.119 reject
 1483  sudo route add 162.55.232.124 reject
 1484  sudo route add 162.55.235.124 reject
 1485  sudo route add 162.55.239.78 reject
 1486  netstat
 1487  netstat -anp |grep 'tcp\|udp' | awk '{print $5}' | cut -d: -f1 | sort | uniq -c
 1488  free -m
 1489  netstat -ntu|awk '{print $5}'|cut -d: -f1 -s |cut -f1,2,3 -d'.'|sed 's/$/.0/'|sort|uniq -c|sort -nk1 -r
 1490  ping 114.130.119.0
 1491  cd
 1492  ls
 1493  cd /
 1494  ls
 1495  cd opt
 1496  ls
 1497  history
 1498  cd /var/www/kyeol-composer/
 1499  nano web/.htaccess 
 1500  apache2ctl -M
 1501  sudo apache2ctl -M
 1502  sudo a2enmod header
 1503  sudo a2enmod header2
 1504  sudo a2enmod headers
 1505  sudo service apache2 status
 1506  sudo service apache2 reload
 1507  sudo service apache2 status
 1508  free -m
 1509  pwd
 1510  ls
 1511  cd web
 1512  ls
 1513  netstat -ntu|awk '{print $5}'|cut -d: -f1 -s |cut -f1,2 -d'.'|sed 's/$/.0.0/'|sort|uniq -c|sort -nk1 -r
 1514  free -m
 1515  nano web/.htaccess 


### 공격확인

netstat -ntu|awk '{print $5}'|cut -d: -f1 -s |cut -f1,2 -d'.'|sed 's/$/.0.0/'|sort|uniq -c|sort -nk1 -r

     18 89.23.0.0
     15 212.23.0.0
     13 193.34.0.0
      8 95.217.0.0
      7 45.133.0.0
      6 193.151.0.0
      4 91.211.0.0
      4 91.193.0.0
      4 185.87.0.0
      4 109.107.0.0
      3 37.1.0.0
      2 65.108.0.0
    
    578 185.82.0.0
    162 163.68.0.0
    143 23.224.0.0
    116 130.198.0.0
     41 168.1.0.0
     15 193.151.0.0
     14 176.9.0.0
     13 127.0.0.0
     10 142.132.0.0


netstat -ntu|awk '{print $5}'|cut -d: -f1 -s |cut -f1,2,3 -d'.'|sed 's/$/.0/'|sort|uniq -c|sort -nk1 -r

     21 212.23.222.0
     17 193.34.213.0
      9 91.193.18.0
      9 45.133.193.0



sudo netstat -ntu | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -n

     10 180.188.16.207
     14 95.217.82.116
     17 212.23.222.8
     26 170.39.193.53
     51 170.39.193.48
     64 170.39.193.47
     69 170.39.193.49
     70 170.39.193.62


     13 91.193.18.14
     26 212.23.222.8

      9 170.39.194.236
     10 170.39.193.27
     10 95.217.82.116
     11 193.34.213.23
     13 208.82.62.64
     49 139.162.103.25     


      7 143.244.46.79
      7 45.133.193.13
     25 193.34.213.23


     15 20.196.194.140
     18 176.9.82.108
     19 23.224.215.35
     28 23.224.137.238
     49 23.224.178.253

sudo route add 158.177.0.0 reject
sudo iptables -A INPUT -s 23.224.215.36 -j DROP
sudo iptables -A INPUT -s 23.224.178.251 -j DROP
sudo iptables -A INPUT -s 158.177.89.0/24 -j DROP
sudo iptables -A INPUT -s 163.68.0.0/24 -j DROP

sudo iptables -A INPUT -s 8.213.132.75 -j DROP

159.122.87.0
서브넷 차단
sudo iptables -A INPUT -s 185.82.0.0/SUBNET -j DROP

iptables -nL

https://webdir.tistory.com/170

sudo iptables -A INPUT -t filter -s 163.68.97.0/24 -j DROP

    180 163.68.0.0
    139 23.224.0.0
    135 130.198.0.0
     56 185.82.0.0
     52 168.1.0.0
      9 193.151.0.0
      9 176.9.0.0

     90 163.68.0.0
     83 23.224.0.0
     65 130.198.0.0
     43 3.0.0.0
     25 168.1.0.0
     22 20.196.0.0
     10 194.87.0.0
      8 89.23.0.0
      7 193.151.0.0
      5 85.192.0.0
      5 51.132.0.0


79.182.0.0/20