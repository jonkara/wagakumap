<?php

//======================================
//
// 世界和楽大全
// たにし＠じょんからドットコム
// Ver 20220406
//
//======================================

   //ヘッダー情報の設定
   header("Content-Type: application/json; charset=utf-8");

   $data = array();
   $lang = 1;

   // 言語設定の取得
   $langfile = file_get_contents('lang.txt');
   if ($langfile == 'en') {
      $lang = 0;
   }

   // DB接続情報
   $sql = "";
   require_once(dirname(__FILE__) . '/../../../application/wagakupediainfo.php');

   // DB接続情報設定・SQL準備・接続
   $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $user, $pass);

   if ($lang == 1) {
      $sql = $sql_all_jp;
   } else {
      $sql = $sql_all_en;
   }
   $sth = $dbh -> prepare($sql);
   $sth -> execute();

   //データを取得する
   $data = $sth -> fetchAll(PDO::FETCH_ASSOC);

   //jsonオブジェクト化
   echo json_encode($data);
?>
