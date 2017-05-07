<?php

/**
 * Created by PhpStorm.
 * User: mcelal
 * Date: 26.04.2017
 * Time: 01:09
 */
class Nba
{
    protected $CI;
    var $cacheTime = 60 * 60;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->driver('cache',
            array('adapter' => 'file', 'backup' => 'file', 'key_prefix' => 'nba_')
        );
    }

    public function getDayGames($date = null)
    {
        if ( !isset($date) ) {
            return null;
        }

        // Cache dosyası için tarihin ayraçlardan temizlenmesi (mmddyyyy) ve cache dosya isminin tanımlanması
        $dateCache = str_replace('/', '', $date);
        $cacheName = "day_{$dateCache}";

        // Tarih api'ye bağlanmak için uygun hale getirilir
        // mm/dd/yyyy => mm%2Fdd%2F/yyyy
        $date = str_replace('/', '%2F', $date);

        // Bağlanılacak api adresi ve tarih bilgisinin birleştirilmesi
        $url = "http://stats.nba.com/stats/scoreboardV2?DayOffset=0&LeagueID=00&gameDate={$date}";

        // Cache dosya kontrolü
        if ( ! $gameList = $this->CI->cache->get($cacheName)) {

            // Cache yok ise verinin uzak sunucudan çekilmesi, cache oluşturulması
            $gameList = $this->cUrl($url);
            $this->CI->cache->save($cacheName, $gameList, $this->cacheTime);

        }

        foreach ($gameList->resultSets[1]->rowSet as $key => $item ) {
            foreach ($gameList->resultSets[0]->rowSet as $key1 => $item1) {
                if ( $item1[1] == $item[1] ){
                    $gameList->resultSets[0]->rowSet[$key1]['lineScore'][$key] = $item;
                }
            }
        }

        return $gameList;
    }

    public function getGame($gameID = null)
    {
        if ( !$gameID ) {
            return null;
        }

        // Cache dosyası için ismin tanımlanması
        $cacheName = "game_{$gameID}";

        $url = "http://stats.nba.com/stats/boxscoretraditionalv2?EndPeriod=10&EndRange=28800&GameID={$gameID}&RangeType=0&StartPeriod=1&StartRange=0";

        // Cache dosya kontrolü
        if ( ! $gameDetail = $this->CI->cache->get($cacheName)) {

            // Cache yok ise verinin uzak sunucudan çekilmesi, cache oluşturulması
            $gameDetail = $this->cUrl($url);
            $this->CI->cache->save($cacheName, $gameDetail, $this->cacheTime);

        }

        // Double-double hesaplaması;
        // Tüm oyuncuların sonuçları sırayla döner
        foreach ($gameDetail->resultSets[0]->rowSet as $key => $player) {
            $y = 0;

            // Her oyuncunun 18-26 indisleri d-d için gerekli skorları tutar
            for ($i = 18; $i <= 26; $i++) {
                // bu skorlardan 10'un üzerinde olan varsa 'y' değişkenini bir arttırır
                if ($player[$i] >= 10) {
                    $y++;
                }
            }

            // 'y' değişkeni 2'ye eşit veya daha fazlaysa
            // oyuncu istatistiklerinin olduğu diziye 'dd' indisli yeni değer atanır
            // true, false olarak boolen değerindedir.
            if ($y >= 2) {
                $gameDetail->resultSets[0]->rowSet[$key]['dd'] = true;
            } else {
                $gameDetail->resultSets[0]->rowSet[$key]['dd'] = false;
            }

        }

        return $gameDetail;

    }

    function cUrl ($url){

        $process = curl_init($url);

        curl_setopt($process, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_HTTPHEADER, array('Expect: 100-continue'));
        curl_setopt($process, CURLOPT_HTTPHEADER, array("Accept-Language: en-US,en;q=0.8,bn;q=0.6"));
        curl_setopt($process, CURLOPT_ENCODING , ""); // Means handle all encodings
        curl_setopt($process, CURLOPT_REFERER, 'http://stats.nba.com/scores/');
        curl_setopt($process, CURLOPT_TIMEOUT,5);

        $return = curl_exec($process);
        $results = json_decode($return);
        curl_close($process);

        return $results;

    }
}