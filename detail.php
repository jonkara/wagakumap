<?php

//======================================
//
// 世界和楽大全
// たにし＠じょんからドットコム
// Ver 20220406
//
//======================================

   $data = array();
   $id = 0;
   $num = 0;
   $lang = 1;

   // パラメータ取得
   if (isset($_GET['id'])) {
      $id = (int)$_GET['id'];
   } else {
      // データが見つからない場合は404を返して終了
      header("HTTP/1.1 404 Not Found");
      echo '指定したデータは存在しません';
      exit;
   }

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
      $sql = $sql_detail_jp;
   } else {
      $sql = $sql_detail_en;
   }
   $sth = $dbh -> prepare($sql);
   $sth -> bindValue(':id', $id, PDO::PARAM_INT);
   $res = $sth -> execute();

   // データを取得する
   if ($res) {
      $data = $sth -> fetch(PDO::FETCH_ASSOC);
      $num = $sth -> rowCount();
   }

   if ($num != 1) {
      // データが見つからない場合は404を返して終了
      header("HTTP/1.1 404 Not Found");
      echo '指定したデータは存在しません';
      exit;
   }

   // 種別の名前を設定
   $categoryName = "";
   $br = "";
   $categoryName2 = "";
   $br2 = "";
   if ($data['category1'] == 1) {
      $categoryName .= $br . ($lang ? "和楽器店" : "Japanese musical instrument shop");
      $br = "<br>";
      $categoryName2 .= $br2 . ($lang ? "和楽器店" : "Japanese musical instrument shop");
      $br2 = " / ";
   }
   if ($data['category2'] == 1) {
      $categoryName .= $br . ($lang ? "和楽器教室" : "Japanese music class");
      $br = "<br>";
      $categoryName2 .= $br2 . ($lang ? "和楽器教室" : "Japanese music class");
      $br2 = " / ";
   }
   if ($data['category3'] == 1) {
      $categoryName .= $br . ($lang ? "演奏団体" : "group of musicians");
      $br = "<br>";
      $categoryName2 .= $br2 . ($lang ? "演奏団体" : "group of musicians");
      $br2 = " / ";
   }
   if ($data['category4'] == 1) {
      $categoryName .= $br . ($lang ? "演奏会場・飲食店" : "concert hall / restaurant");
      $br = "<br>";
      $categoryName2 .= $br2 . ($lang ? "演奏会場・飲食店" : "concert hall / restaurant");
      $br2 = " / ";
   }

   // 取扱楽器・流派を設定
   $instrument = "";
   $spl = "";
   $br = "";
   if ($data['shamisen'] == 1 and $data['shamisenT'] != 1 and $data['shamisenJ'] != 1 and $data['shamisenM'] != 1 and $data['shamisenN'] != 1 and $data['shamisenG'] != 1 and $data['shamisenK'] != 1) {
       $instrument .= $br . ($lang ? "三味線" : "Shamisen");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['shamisenT'] == 1) {
       $instrument .= $br . ($lang ? "津軽三味線" : "Tsugaru Shamisen");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['shamisenT1'] == 1) {
       $instrument .= $spl . ($lang ? "澤田流" : "Sawada style");
       $spl = ", ";
   }
   if ($data['shamisenT2'] == 1) {
       $instrument .= $spl . ($lang ? "小山流" : "Oyama style");
       $spl = ", ";
   }
   if ($data['shamisenT3'] == 1) {
       $instrument .= $spl . ($lang ? "高橋流" : "Takahashi style");
       $spl = ", ";
   }
   if ($data['shamisenG'] == 1) {
       $instrument .= $br . ($lang ? "義太夫三味線" : "Gidayu Shamisen");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['shamisenJ'] == 1) {
       $instrument .= $br . ($lang ? "地歌三味線" : "Jiuta Shamisen");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['shamisenM'] == 1) {
       $instrument .= $br . ($lang ? "民謡三味線" : "Minyo Shamisen");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['shamisenN'] == 1) {
       $instrument .= $br . ($lang ? "長唄三味線" : "Nagauta Shamisen");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['shamisenK'] == 1) {
       $instrument .= $br . ($lang ? "小唄・端唄・清元三味線" : "Kouta, Hauta, Kiyomoto Shamisen");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['koto'] == 1) {
       $instrument .= $br . ($lang ? "箏" : "Koto");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['koto1'] == 1) {
       $instrument .= $spl . ($lang ? "生田流" : "Ikuta style");
       $spl = ", ";
   }
   if ($data['koto2'] == 1) {
       $instrument .= $spl . ($lang ? "山田流" : "Yamada style");
       $spl = ", ";
   }
   if ($data['shakuhachi'] == 1) {
       $instrument .= $br . ($lang ? "尺八" : "Shakuhachi");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['shakuhachi1'] == 1) {
       $instrument .= $spl . ($lang ? "都山流" : "Tozan style");
       $spl = ", ";
   }
   if ($data['shakuhachi2'] == 1) {
       $instrument .= $spl . ($lang ? "琴古流" : "Kinko style");
       $spl = ", ";
   }
   if ($data['shinobue'] == 1) {
       $instrument .= $br . ($lang ? "篠笛・能管" : "Shinobue, Nokan");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['sanshin'] == 1) {
       $instrument .= $br . ($lang ? "沖縄三線" : "Okinawa Sanshin");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['biwa'] == 1) {
       $instrument .= $br . ($lang ? "琵琶" : "Biwa");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['taiko'] == 1) {
       $instrument .= $br . ($lang ? "太鼓・鼓" : "Taiko, Tsuzumi");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['kokyu'] == 1) {
       $instrument .= $br . ($lang ? "胡弓" : "Kokyu");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['gagaku'] == 1) {
       $instrument .= $br . ($lang ? "雅楽三管" : "Gagaku");
       $br = "<br>";
       $spl = " / ";
   }
   if ($data['taishou'] == 1) {
       $instrument .= $br . ($lang ? "大正琴" : "Taisho Koto");
       $br = "<br>";
       $spl = " / ";
   }

   // URL情報を取得
   $urlAry = explode(';', $data['url']);
   $url = "";
   $br = "";
   for ($i = 0; $i < count($urlAry); $i ++) {
       $url .= $br . '<a href="' . $urlAry[$i] . '" target=_blank>' . $urlAry[$i] . '</a>';
       $br = "<br>";
   }

   // 検索クエリを設定
   $query = "place_id:" . $data['placeid'];
   if ($data['placeid'] == "") {
       // placeidがない場合は住所で検索
       $query = str_replace(' ', '+', $data['address']);
   }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $data['title']; ?> (<?php echo $categoryName2; ?>)  - <?php echo ($lang ? "世界和楽大全" : "The World Wagakupedia"); ?></title>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <link rel="alternate" hreflang="ja" href="https://wagakupedia.jonkara.com/jp/detail.php?id=<?php echo $data['id']; ?>" />
    <link rel="alternate" hreflang="en" href="https://wagakupedia.jonkara.com/en/detail.php?id=<?php echo $data['id']; ?>" />
</head>
<body>
    <div class="header0">
        <p class="header1">
            <a href="https://wagakupedia.jonkara.com/<?php echo ($lang ? "jp" : "en"); ?>/"><img src="wagakupedia.png" alt="世界和楽大全" width="426" height="90" border="0"></a>
        </p>
        <p class="header2">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?php include("googleadsid.php"); ?>"
     crossorigin="anonymous"></script>
<!-- header_big_banner -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="<?php include("googleadsid.php"); ?>"
     data-ad-slot="7105864136"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        </p>
    </div>
    <p class="clearboth" align="left"><a href="https://jonkara.com/"><?php echo ($lang ? "じょんからドットコム" : "Jonkara dot com"); ?></a> > <a href="<?php echo ($lang ? "https://wagakupedia.jonkara.com/jp/\">世界和楽大全 世界の店舗検索ページ" : "https://wagakupedia.jonkara.com/en/\">The World Wagakupedia search page"); ?></a> > <?php echo $data['title']; ?></p>
    <h1 class="detail"><?php echo $data['title']; ?></h1>
    <table class="detail">
        <tr>
            <td class="detail1"><?php echo ($lang ? "種別" : "category"); ?></td>
            <td class="detail2"><?php echo $categoryName; ?></td>
        </tr>
        <tr>
            <td class="detail1"><?php echo ($lang ? "取扱楽器・流派" : "instrument, style"); ?></td>
            <td class="detail2"><?php echo $instrument; ?></td>
        </tr>
        <tr>
            <td class="detail1"><?php echo ($lang ? "ウェブサイト" : "website"); ?></td>
            <td class="detail2"><?php echo $url; ?></td>
        </tr>
        <tr>
            <td class="detail1"><?php echo ($lang ? "住所" : "address"); ?></td>
            <td class="detail2"><?php echo $data['address']; ?></td>
        </tr>
        <tr>
            <td class="detail1"><?php echo ($lang ? "電話" : "phone"); ?></td>
            <td class="detail2"><?php echo $data['phone']; ?></td>
        </tr>
        <tr>
            <td class="detail1"><?php echo ($lang ? "営業時間" : "opening hours"); ?></td>
            <td class="detail2"><?php echo $data['openinghour']; ?></td>
        </tr>
        <tr>
            <td class="detail1"><?php echo ($lang ? "お店からのお知らせ" : "information by shop"); ?></td>
            <td class="detail2"><?php echo $data['information']; ?></td>
        </tr>
    </table>
    <p align="left"><?php echo ($lang ? "更新日：" : "updated: "); echo $data['updated_at']; ?></p>
    <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?language=<?php echo ($lang ? "ja" : "en"); ?>&region=JP&q=<?php echo $query; ?>&key=<?php include("googlemapkey.php"); ?>&center=<?php echo $data['lat']; ?>,<?php echo $data['lng']; ?>&zoom=16"></iframe>
    <p align="left"><?php echo ($lang ? "<a href=\"https://wagakupedia.jonkara.com/en/detail.php?id=" . $data['id'] . "\">英語版ページはこちら</a>" : "<a href=\"https://wagakupedia.jonkara.com/jp/detail.php?id=" . $data['id'] . "\">Japanese edition is here</a>"); ?></p>
    <p align="left"><?php echo ($lang ? "世界和楽大全は、全国・世界各地の和楽器関連の店舗・団体などをまとめて検索できるサービスです。<br />運営：<a href=\"https://jonkara.com/\">じょんからドットコム</a><br />掲載情報の更新等は<a href=\"https://jonkara.com/wagakupedia/\">こちら</a>からご依頼ください。<br />地図や口コミ情報はGoogleのシステムを利用しています。" : "The World Wagakupedia is a service that allows you to search for shops, organizations, etc. related to Japanese musical instruments(Wagakki) in various regions.<br />Managed by: <a href=\"https://jonkara.com/\">Jonkara dot com</a><br />Please click <a href=\"https://jonkara.com/wagakupedia_en/\">here</a> to request information updates.<br />Maps and review information are based on Google's system."); ?></p>

<p align="center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- footer1_responsive -->
<ins class="adsbygoogle"
     style="display:inline-block; width: 300px; height: 250px"
     data-ad-client="<?php include("googleadsid.php"); ?>"
     data-ad-slot="2517683212"
     data-ad-format="rectangle"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> 

<style>
.my_adslot2 { display:inline-block; width: 300px; height: 250px; }
@media(max-width: 600px) { .my_adslot2 { display:none; } }
</style>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- footer2_responsive -->
<ins class="adsbygoogle my_adslot2"
     data-ad-client="<?php include("googleadsid.php"); ?>"
     data-ad-slot="1021780471"
     data-ad-format="rectangle"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</p>

    <hr class="detail">
    <p align="center"><?php echo ($lang ? "© じょんからドットコム" : "(C) Jonkara dot com"); ?> All Rights Reserved.</p>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php include("googleanalyticsid.php"); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php include("googleanalyticsid.php"); ?>');
</script>
</body>
</html>