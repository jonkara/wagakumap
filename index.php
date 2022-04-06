<?php

//======================================
//
// 世界和楽大全
// たにし＠じょんからドットコム
// Ver 20220309
//
//======================================

   $lang = 1;
   
   // 言語設定の取得
   $langfile = file_get_contents('lang.txt');
   if ($langfile == 'en') {
      $lang = 0;
   }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo ($lang ? "和楽器店舗・教室・団体検索サービス 世界和楽大全 - じょんからドットコム" : "The World Wagakupedia - Search for Japanese musical instrument shops, classes, organizations"); ?></title>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <link rel="alternate" hreflang="ja" href="https://wagakupedia.jonkara.com/jp/" />
    <link rel="alternate" hreflang="en" href="https://wagakupedia.jonkara.com/en/" />
    <script src="./wagakupedia.js"></script>
</head>
<body>
    <div id="header">
        <table width="100%" height="90"><tr>
        <td width="426">
        <img src="wagakupedia.png" alt="世界和楽大全" width="426" height="90" border="0">
        </td>
        <td align="right">
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
    </td></tr></table>
    </div>
    <ul id="floating-panel">
        <?php echo ($lang ? "世界和楽大全は、全国・世界各地の和楽器関連の店舗・団体などを<br />まとめて検索できるサービスです。（現在開発中）" : "The World Wagakupedia is a service that allows you to search for shops, organizations, etc. related to Japanese musical instruments(Wagakki) in various regions.(Now developing)"); ?>
        <h3 align="left"><?php echo ($lang ? "種別" : "category"); ?></h3>
        <center>
            <table class="searchbox">
                <tr class="searchbox1">
                    <td class="searchbox1">
                        <p class="normal">
                            <input type="checkbox" id="category1" checked><label for="category1"><?php echo ($lang ? "和楽器店" : "instrument shop"); ?></label>
                            <input type="checkbox" id="category2" checked><label for="category2"><?php echo ($lang ? "和楽器教室" : "music class"); ?></label>
                            <input type="checkbox" id="category3" checked><label for="category3"><?php echo ($lang ? "演奏団体" : "group of musicians"); ?></label>
                            <input type="checkbox" id="category4" checked><label for="category4"><?php echo ($lang ? "演奏会場・飲食店" : "concert hall / restaurant"); ?></label>
                        </p>
                    </td>
                </tr>
            </table>
        </center>
        <h3 align="left"><?php echo ($lang ? "取扱楽器" : "instrument"); ?></h3>
        <center>
            <table class="searchbox">
                <tr class="searchbox1">
                    <td class="searchbox2-1">
                        <p class="normal"><input type="checkbox" id="shamisen" checked><label for="shamisen"><?php echo ($lang ? "三味線" : "Shamisen"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenT" checked><label for="shamisenT"><?php echo ($lang ? "津軽三味線" : "Tsugaru Shamisen"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenG" checked><label for="shamisenG"><?php echo ($lang ? "義太夫三味線" : "Gidayu Shamisen"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenJ" checked><label for="shamisenJ"><?php echo ($lang ? "地歌三味線" : "Jiuta Shamisen"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenM" checked><label for="shamisenM"><?php echo ($lang ? "民謡三味線" : "Minyo Shamisen"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenN" checked><label for="shamisenN"><?php echo ($lang ? "長唄三味線" : "Nagauta Shamisen"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenK" checked><label for="shamisenK"><?php echo ($lang ? "小唄,端唄,清元三味線" : "Kouta,Hauta,Kiyomoto Shamisen"); ?></label></p>
                    </td>
                    <td class="searchbox2-2">
                        <p class="normal"><input type="checkbox" id="koto" checked><label for="koto"><?php echo ($lang ? "箏" : "Koto"); ?></label></p>
                        <p class="normal"><input type="checkbox" id="shakuhachi" checked><label for="shakuhachi"><?php echo ($lang ? "尺八" : "Shakuhachi"); ?></label></p>
                        <p class="normal"><input type="checkbox" id="shinobue" checked><label for="shinobue"><?php echo ($lang ? "篠笛,能管" : "Shinobue,Nokan"); ?></label></p>
                        <p class="normal"><input type="checkbox" id="sanshin" checked><label for="sanshin"><?php echo ($lang ? "沖縄三線" : "Sanshin"); ?></label></p>
                        <p class="normal"><input type="checkbox" id="biwa" checked><label for="biwa"><?php echo ($lang ? "琵琶" : "Biwa"); ?></label></p>
                    </td>
                    <td class="searchbox2-2">
                        <p class="normal"><input type="checkbox" id="taiko" checked><label for="taiko"><?php echo ($lang ? "太鼓,鼓" : "Taiko,Tsuzumi"); ?></label></p>
                        <p class="normal"><input type="checkbox" id="kokyu" checked><label for="kokyu"><?php echo ($lang ? "胡弓" : "Kokyu"); ?></label></p>
                        <p class="normal"><input type="checkbox" id="gagaku" checked><label for="gagaku"><?php echo ($lang ? "雅楽三管" : "Gagaku"); ?></label></p>
                        <p class="normal"><input type="checkbox" id="taishou" checked><label for="taishou"><?php echo ($lang ? "大正琴" : "Taisho Koto"); ?></label></p>
                    </td>
                </tr>
            </table>
        </center>
        <p class="right"><input type="checkbox" id="allcheck1" checked><label for="allcheck1"><?php echo ($lang ? "全選択・解除" : "all select/unselect"); ?></label></p>
        <h3 align="left"><?php echo ($lang ? "流派の指定" : "style"); ?></h3>
        <center>
            <table class="searchbox">
                <tr class="searchbox1">
                    <td class="searchbox3">
                        <p class="normal"><?php echo ($lang ? "津軽三味線" : "Tsugaru Shamisen"); ?></p>
                        <p class="indent"><input type="checkbox" id="shamisenT0" checked><label for="shamisenT0"><?php echo ($lang ? "指定なし" : "not specified"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenT1" checked><label for="shamisenT1"><?php echo ($lang ? "澤田流" : "Sawada style"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenT2" checked><label for="shamisenT2"><?php echo ($lang ? "小山流" : "Oyama style"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shamisenT3" checked><label for="shamisenT3"><?php echo ($lang ? "高橋流" : "Takahashi style"); ?></label></p>
                    </td>
                    <td class="searchbox3">
                        <p class="normal"><?php echo ($lang ? "箏" : "Koto"); ?></p>
                        <p class="indent"><input type="checkbox" id="koto0" checked><label for="koto0"><?php echo ($lang ? "指定なし" : "not specified"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="koto1" checked><label for="koto1"><?php echo ($lang ? "生田流" : "Ikuta style"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="koto2" checked><label for="koto2"><?php echo ($lang ? "山田流" : "Yamada style"); ?></label></p>
                    </td>
                    <td class="searchbox3">
                        <p class="normal"><?php echo ($lang ? "尺八" : "Shakuhachi"); ?></p>
                        <p class="indent"><input type="checkbox" id="shakuhachi0" checked><label for="shakuhachi0"><?php echo ($lang ? "指定なし" : "not specified"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shakuhachi1" checked><label for="shakuhachi1"><?php echo ($lang ? "都山流" : "Tozan style"); ?></label></p>
                        <p class="indent"><input type="checkbox" id="shakuhachi2" checked><label for="shakuhachi2"><?php echo ($lang ? "琴古流" : "Kinko style"); ?></label></p>
                    </td>
                </tr>
            </table>
        </center>
        <p class="right"><input type="checkbox" id="allcheck2" checked><label for="allcheck2"><?php echo ($lang ? "全選択・解除" : "all select/unselect"); ?></label></p>
        <p><?php echo ($lang ? "運営：<a href=\"https://jonkara.com/\">じょんからドットコム</a>　　現在の登録数：<span id=\"num\">-</span>件<br />掲載情報の更新依頼は<a href=\"https://jonkara.com/wagakupedia/\">こちら</a>。<b>英語版ページは<a href=\"https://wagakupedia.jonkara.com/en/\">こちら</a>。</b>" : "Managed by: <a href=\"https://jonkara.com/\">Jonkara dot com</a>    currently registered: <span id=\"num\">-</span><br />Please click <a href=\"https://jonkara.com/wagakupedia_en/\">here</a> to request information updates. <b>Japanese edition is <a href=\"https://wagakupedia.jonkara.com/jp/\">here</a></b>"); ?></p>
    </ul>
    <input type="hidden" value="<?php echo ($lang ? "1" : "0"); ?>" id="language" />

    <div id="map"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?language=<?php echo ($lang ? "ja" : "en"); ?>&region=JP&key=<?php include("googlemapkey.php"); ?>&callback=initMap"
            async defer></script>
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