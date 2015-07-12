<?php


if (!($_GET['auth'] == 'f110')){
	header('HTTP/1.1 403 Forbidden');
	exit(12);
}
header("Content-type: text/plain; charset=utf-8");
require_once('./lib/db.php');

// get marketing data

$ret = iconv("gb2312", "utf-8//IGNORE",file_get_contents("http://item.taobao.com/item.htm?id=39310524066"));
//var_dump($ret);
$pattern = '%<(em class\="tb-rmb-num").*?>(.*?)<\/em>%si'; 
preg_match_all($pattern,$ret,$match);
$price = $match[2][0];



// insert data into db

$db = db::getInstance();
$db->createcon();

$count = "SELECT COUNT(id) FROM `monitor-data-isk-trade` where 1";

$count = $db->fetch_array($count);
$count = $count[0] + 1;
$insert = "INSERT INTO `monitor-data-isk-trade`(`id`, `time`, `price`) VALUES (" . $count . ",'" . date("m-d",time()) . "',$price)";

$id = $db->query($insert);

$db->close();

?>