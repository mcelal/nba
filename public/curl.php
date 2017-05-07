<?php
/**
 * Created by PhpStorm.
 * User: mcelal
 * Date: 5.05.2017
 * Time: 01:41
 */
$url = "http://stats.nba.com/stats/scoreboardV2?DayOffset=0&LeagueID=00&gameDate=11%2F27%2F2015";
$process = curl_init($url);

//curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
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

var_dump($results);