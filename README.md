# NBA 2015-16 Maç Sorgulama ve Double-Double Gösterimi

Bu proje CodeIgniter kullanılarak yapılmıştır. Nba adında kütüphane yazılarak http://stats.nba.com/ adresinden verilerin curl yardımıyla json tipinde çekilmesiyle anlık olarak çalışmaktadır. Sistem ajax ile dinamik olarak çalışacak şekilde dizayn edilmiştir.

Verilerin sürekli uzak sunucudan çekilerek yük oluşturmasını engellemek için çekilen veriler CodeIgniter üzerinde bulunan cache sistemi ile dosya cache şeklinde tutulmaktadır.


## Kurulum

- application - config.php

Site adresini belirleyen alttaki satırı kendinize göre düzenleyiniz
```sh
$config['base_url'] = 'http://nba.dev/';
```

## Demo Adresi
https://nba.mcelal.com/
