
//======================================
//
// 全国和楽大全
// たにし＠じょんからドットコム
// Ver 20220206
//
//======================================


// 地図
let map;

// 住所取得
var geocoder;

// 情報ウィンドウ
var infoWindow;

// マーカー配列
var markers = [];

// データ配列
var items = [];

// 表示フラグ
var onCategory1 = true;
var onCategory2 = true;
var onCategory3 = true;
var onCategory4 = true;

var onShamisen = true;
var onShamisenT = true;
var onShamisenG = true;
var onShamisenJ = true;
var onShamisenM = true;
var onShamisenN = true;
var onShamisenK = true;

var onKoto = true;

var onShakuhachi = true;
var onShinobue = true;
var onSanshin = true;
var onBiwa = true;
var onTaiko = true;
var onKokyu = true;
var onGagaku = true;
var onTaishou = true;

var onShamisenT0 = true;
var onShamisenT1 = true;
var onShamisenT2 = true;
var onShamisenT3 = true;

var onKoto0 = true;
var onKoto1 = true;
var onKoto2 = true;

var onShakuhachi0 = true;
var onShakuhachi1 = true;
var onShakuhachi2 = true;


// 地図の初期化
function initMap() {
    var target = document.getElementById('map');

    // 初期表示位置・縮尺
    var center = { lat: 35.693825, lng: 139.703356 };
    var opts = {
        mapTypeControl: false,
        center: center,
        zoom: 11
    }

    // 初期化
    map = new google.maps.Map(target, opts);
    //geocoder = new google.maps.Geocoder();
    infoWindow = new google.maps.InfoWindow();

    google.maps.event.addListener(map, 'click', function () {
        if (infoWindow) {
            infoWindow.close();
        }
    });

    // 検索欄
    const control = document.getElementById("floating-panel");
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(control);

    // チェックボックスの変更を検知
    const onChangeHandler = function () {
        //getCategoryChecked();
        showMarkers();
    };
    const onChangeParentHandler = function () {
        getParentChecked();
    };
    const onChangeChildHandler = function () {
        getChildChecked();
    };
    const onChangeAll1Handler = function () {
        getAllChecked1();
    };
    const onChangeAll2Handler = function () {
        getAllChecked2();
    };

    document.getElementById("category1").addEventListener("change", onChangeHandler);
    document.getElementById("category2").addEventListener("change", onChangeHandler);
    document.getElementById("category3").addEventListener("change", onChangeHandler);
    document.getElementById("category4").addEventListener("change", onChangeHandler);

    document.getElementById("shamisen").addEventListener("change", onChangeParentHandler);
    document.getElementById("shamisenT").addEventListener("change", onChangeChildHandler);
    document.getElementById("shamisenG").addEventListener("change", onChangeChildHandler);
    document.getElementById("shamisenJ").addEventListener("change", onChangeChildHandler);
    document.getElementById("shamisenM").addEventListener("change", onChangeChildHandler);
    document.getElementById("shamisenN").addEventListener("change", onChangeChildHandler);
    document.getElementById("shamisenK").addEventListener("change", onChangeChildHandler);

    document.getElementById("koto").addEventListener("change", onChangeHandler);
    document.getElementById("shakuhachi").addEventListener("change", onChangeHandler);
    document.getElementById("shinobue").addEventListener("change", onChangeHandler);
    document.getElementById("sanshin").addEventListener("change", onChangeHandler);
    document.getElementById("biwa").addEventListener("change", onChangeHandler);
    document.getElementById("taiko").addEventListener("change", onChangeHandler);
    document.getElementById("kokyu").addEventListener("change", onChangeHandler);
    document.getElementById("gagaku").addEventListener("change", onChangeHandler);
    document.getElementById("taishou").addEventListener("change", onChangeHandler);

    document.getElementById("allcheck1").addEventListener("change", onChangeAll1Handler);
    document.getElementById("allcheck2").addEventListener("change", onChangeAll2Handler);

    document.getElementById("shamisenT0").addEventListener("change", onChangeHandler);
    document.getElementById("shamisenT1").addEventListener("change", onChangeHandler);
    document.getElementById("shamisenT2").addEventListener("change", onChangeHandler);
    document.getElementById("shamisenT3").addEventListener("change", onChangeHandler);

    document.getElementById("koto0").addEventListener("change", onChangeHandler);
    document.getElementById("koto1").addEventListener("change", onChangeHandler);
    document.getElementById("koto2").addEventListener("change", onChangeHandler);

    document.getElementById("shakuhachi0").addEventListener("change", onChangeHandler);
    document.getElementById("shakuhachi1").addEventListener("change", onChangeHandler);
    document.getElementById("shakuhachi2").addEventListener("change", onChangeHandler);

    // データを取得
    getData();
}

// データの取得
// 取得成功したらマーカーを作成
function getData() {
    $.ajax({
        type: "POST",
        url: "wagakumapdata.php",
        dataType: "json",
        success: function (data) {
            items = data;
            createMarkers();
            document.getElementById("num").textContent = items.length + "件";
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error : ' + errorThrown);
        }
    });
}

// マーカーの初回作成
function createMarkers() {
    for (var i = 0; i < items.length; i ++) {
        createMarker(i);
    }
}

// マーカーの初回作成
function createMarker(n) {
    // 種別の名前を設定
    var categoryName = "";
    var br = "";
    // マーカーアイコンを設定
    var icon = "";
    if (items[n].category1 == 1) {
        categoryName += br + "和楽器店";
        br = "<br>";
        icon = "https://maps.google.com/mapfiles/ms/micons/orange-dot.png";
    }
    if (items[n].category2 == 1) {
        categoryName += br + "音楽教室";
        br = "<br>";
        icon = "https://maps.google.com/mapfiles/ms/micons/blue-dot.png";
    }
    if (items[n].category3 == 1) {
        categoryName += br + "演奏団体";
        br = "<br>";
        icon = "https://maps.google.com/mapfiles/ms/micons/green-dot.png";
    }
    if (items[n].category4 == 1) {
        categoryName += br + "演奏会場・飲食店";
        br = "<br>";
        icon = "https://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
    }

    // 取扱楽器・流派を設定
    var instrument = "";
    var spl = "";
    var br = "";
    if (items[n].shamisen == 1 && items[n].shamisenT != 1 && items[n].shamisenJ != 1 && items[n].shamisenM != 1 && items[n].shamisenN != 1 && items[n].shamisenG != 1 && items[n].shamisenK != 1) {
        instrument += br + "三味線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].shamisenT == 1) {
        instrument += br + "津軽三味線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].shamisenT1 == 1) {
        instrument += spl + "澤田流";
        spl = ", ";
    }
    if (items[n].shamisenT2 == 1) {
        instrument += spl + "小山流";
        spl = ", ";
    }
    if (items[n].shamisenT3 == 1) {
        instrument += spl + "高橋流";
        spl = ", ";
    }
    if (items[n].shamisenG == 1) {
        instrument += br + "義太夫三味線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].shamisenJ == 1) {
        instrument += br + "地歌三味線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].shamisenM == 1) {
        instrument += br + "民謡三味線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].shamisenN == 1) {
        instrument += br + "長唄三味線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].shamisenK == 1) {
        instrument += br + "小唄・端唄・清元三味線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].koto == 1) {
        instrument += br + "箏";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].koto1 == 1) {
        instrument += spl + "生田流";
        spl = ", ";
    }
    if (items[n].koto2 == 1) {
        instrument += spl + "山田流";
        spl = ", ";
    }
    if (items[n].shakuhachi == 1) {
        instrument += br + "尺八";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].shakuhachi1 == 1) {
        instrument += spl + "都山流";
        spl = ", ";
    }
    if (items[n].shakuhachi2 == 1) {
        instrument += spl + "琴古流";
        spl = ", ";
    }
    if (items[n].shinobue == 1) {
        instrument += br + "篠笛・能管";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].sanshin == 1) {
        instrument += br + "沖縄三線";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].biwa == 1) {
        instrument += br + "琵琶";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].taiko == 1) {
        instrument += br + "太鼓・鼓";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].kokyu == 1) {
        instrument += br + "胡弓";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].gagaku == 1) {
        instrument += br + "雅楽三管";
        br = "<br>";
        spl = " ／ ";
    }
    if (items[n].taishou == 1) {
        instrument += br + "大正琴";
        br = "<br>";
        spl = " ／ ";
    }

    // 住所から経度緯度を取得
    //geocoder.geocode({ 'address': items[n].address }, function (results, status) {
    //    if (status === 'OK' && results[0]) {
    //    } else {
    //        //ステータスが OK 以外の場合や results[0] が存在しなければ、アラートを表示して処理を中断
    //        alert('geocoder fail: ' + status);
    //        return;
    //    }
    //});

    // URL情報を取得
    var urlAry = items[n].url.split(';');
    var url = "";
    br = "";
    for (var i = 0; i < urlAry.length; i ++) {
        url += br + '<a href="' + urlAry[i] + '" target=_blank>' + urlAry[i] + '</a>';
        br = "<br>";
    }

    // マーカーを作成
    content = '<table class="items"><tr><td class="items" colspan=2><strong><p class="items_title"><a href="https://wagakumap.jonkara.com/detail.php?id=' + items[n].id + '" target=_blank>' + items[n].title + '</a></p></strong></td></tr><tr><td class="items">種別</td><td class="items">' + categoryName + '</td></tr><tr><td class="items">取扱楽器・流派</td><td class="items">' + instrument + '</td></tr><tr><td class="items">ウェブサイト</td><td class="items">' + url + '</td></tr><tr><td class="items">住所</td><td class="items">' + items[n].address + '</td></tr><tr><td class="items">電話</td><td class="items">' + items[n].phone + '</td></tr><tr><td class="items">営業時間</td><td class="items">' + items[n].openinghour + '</td></tr></table><p class="right">更新日：' + items[n].updated_at + '</p>';
    var pos = new google.maps.LatLng({
        lat: parseFloat(items[n].lat),
        lng: parseFloat(items[n].lng)
    });
    var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title: items[n].title,
        icon: icon,
        id: n,
        content: content
    });

    // リスナーを設定
    google.maps.event.addListener(marker, 'click', function () {
        infoWindow.setContent(this.content);
        infoWindow.open(map, marker);
    });
    markers.push(marker);

    // マーカーを全件作成したら表示・非表示を設定
    if (markers.length == items.length) {
        showMarkers();
    }
}

// マーカーの表示・非表示を設定
function showMarkers() {
    // チェックボックスの状態をフラグに反映
    onCategory1 = document.getElementById("category1").checked;
    onCategory2 = document.getElementById("category2").checked;
    onCategory3 = document.getElementById("category3").checked;
    onCategory4 = document.getElementById("category4").checked;

    onShamisen = document.getElementById("shamisen").checked;
    onShamisenT = document.getElementById("shamisenT").checked;
    onShamisenG = document.getElementById("shamisenG").checked;
    onShamisenJ = document.getElementById("shamisenJ").checked;
    onShamisenM = document.getElementById("shamisenM").checked;
    onShamisenN = document.getElementById("shamisenN").checked;
    onShamisenK = document.getElementById("shamisenK").checked;

    onKoto = document.getElementById("koto").checked;
    onShakuhachi = document.getElementById("shakuhachi").checked;
    onShinobue = document.getElementById("shinobue").checked;
    onSanshin = document.getElementById("sanshin").checked;
    onBiwa = document.getElementById("biwa").checked;
    onTaiko = document.getElementById("taiko").checked;
    onKokyu = document.getElementById("kokyu").checked;
    onGagaku = document.getElementById("gagaku").checked;
    onTaishou = document.getElementById("taishou").checked;

    onShamisenT0 = document.getElementById("shamisenT0").checked;
    onShamisenT1 = document.getElementById("shamisenT1").checked;
    onShamisenT2 = document.getElementById("shamisenT2").checked;
    onShamisenT3 = document.getElementById("shamisenT3").checked;

    onKoto0 = document.getElementById("koto0").checked;
    onKoto1 = document.getElementById("koto1").checked;
    onKoto2 = document.getElementById("koto2").checked;

    onShakuhachi0 = document.getElementById("shakuhachi0").checked;
    onShakuhachi1 = document.getElementById("shakuhachi1").checked;
    onShakuhachi2 = document.getElementById("shakuhachi2").checked;

    // 表示・非表示の設定
    for (var i = 0; i < markers.length; i++) {
        var n = markers[i].get('id');
        var visible1 = false;
        if (items[n].category1 == 1 && onCategory1 == true) {
            visible1 = true;
        }
        if (items[n].category2 == 1 && onCategory2 == true) {
            visible1 = true;
        }
        if (items[n].category3 == 1 && onCategory3 == true) {
            visible1 = true;
        }
        if (items[n].category4 == 1 && onCategory4 == true) {
            visible1 = true;
        }

        var visible2 = false;
        if (items[n].shamisen == 1) {
            if (onShamisen == true && items[n].shamisenT != 1 && onShamisenT == true && onShamisenT0 == true && items[n].shamisenG != 1 && onShamisenG == true && items[n].shamisenJ != 1 && onShamisenJ == true && items[n].shamisenM != 1 && onShamisenM == true && items[n].shamisenN != 1 && onShamisenN == true && items[n].shamisenK != 1 && onShamisenK == true) {
                visible2 = true;
            }
            else {
                if (items[n].shamisenT == 1 && onShamisenT == true) {
                    if (items[n].shamisenT1 != 1 && items[n].shamisenT2 != 1 && items[n].shamisenT3 != 1 && onShamisenT0 == true) {
                        visible2 = true;
                    }
                    if (items[n].shamisenT1 == 1 && onShamisenT1 == true) {
                        visible2 = true;
                    }
                    if (items[n].shamisenT2 == 1 && onShamisenT2 == true) {
                        visible2 = true;
                    }
                    if (items[n].shamisenT3 == 1 && onShamisenT3 == true) {
                        visible2 = true;
                    }
                }
                if (items[n].shamisenG == 1 && onShamisenG == true) {
                    visible2 = true;
                }
                if (items[n].shamisenJ == 1 && onShamisenJ == true) {
                    visible2 = true;
                }
                if (items[n].shamisenM == 1 && onShamisenM == true) {
                    visible2 = true;
                }
                if (items[n].shamisenN == 1 && onShamisenN == true) {
                    visible2 = true;
                }
                if (items[n].shamisenK == 1 && onShamisenK == true) {
                    visible2 = true;
                }
            }
        }
        if (items[n].koto == 1 && onKoto == true) {
            if (items[n].koto1 != 1 && items[n].koto2 != 1 && onKoto0 == true) {
                visible2 = true;
            }
            if (items[n].koto1 == 1 && onKoto1 == true) {
                visible2 = true;
            }
            if (items[n].koto2 == 1 && onKoto2 == true) {
                visible2 = true;
            }
        }
        if (items[n].shakuhachi == 1 && onShakuhachi == true) {
            if (items[n].shakuhachi1 != 1 && items[n].shakuhachi2 != 1 && onShakuhachi0 == true) {
                visible2 = true;
            }
            if (items[n].shakuhachi1 == 1 && onShakuhachi1 == true) {
                visible2 = true;
            }
            if (items[n].shakuhachi2 == 1 && onShakuhachi2 == true) {
                visible2 = true;
            }
        }
        if (items[n].shinobue == 1 && onShinobue == true) {
            visible2 = true;
        }
        if (items[n].sanshin == 1 && onSanshin == true) {
            visible2 = true;
        }
        if (items[n].biwa == 1 && onBiwa == true) {
            visible2 = true;
        }
        if (items[n].taiko == 1 && onTaiko == true) {
            visible2 = true;
        }
        if (items[n].kokyu == 1 && onKokyu == true) {
            visible2 = true;
        }
        if (items[n].gagaku == 1 && onGagaku == true) {
            visible2 = true;
        }
        if (items[n].taishou == 1 && onTaishou == true) {
            visible2 = true;
        }
        markers[i].setVisible(visible1 && visible2);
    }
}

// マーカーの削除
function deleteMarkers() {
    // 各マーカーを削除
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }

    //参照を開放
    markers = [];
}

// 親チェックボックスのチェックを反映
function getParentChecked() {
    let shamisen = document.getElementById("shamisen");
    let shamisenT = document.getElementById("shamisenT");
    let shamisenG = document.getElementById("shamisenG");
    let shamisenJ = document.getElementById("shamisenJ");
    let shamisenM = document.getElementById("shamisenM");
    let shamisenN = document.getElementById("shamisenN");
    let shamisenK = document.getElementById("shamisenK");

    if (shamisen.checked) {
        shamisenT.checked = true;
        shamisenG.checked = true;
        shamisenJ.checked = true;
        shamisenM.checked = true;
        shamisenN.checked = true;
        shamisenK.checked = true;
    }

    showMarkers();
}

// 子チェックボックスのチェックを反映
function getChildChecked() {
    let shamisen = document.getElementById("shamisen");
    let shamisenT = document.getElementById("shamisenT");
    let shamisenG = document.getElementById("shamisenG");
    let shamisenJ = document.getElementById("shamisenJ");
    let shamisenM = document.getElementById("shamisenM");
    let shamisenN = document.getElementById("shamisenN");
    let shamisenK = document.getElementById("shamisenK");

    if (shamisenT.checked == false || shamisenG.checked == false || shamisenJ.checked == false || shamisenM.checked == false || shamisenN.checked == false || shamisenK.checked == false) {
        shamisen.checked = false;
    }

    showMarkers();
}

// 全選択チェックボックスのチェックを反映
function getAllChecked1() {
    let allcheck1 = document.getElementById("allcheck1");

    let shamisen = document.getElementById("shamisen");
    let shamisenT = document.getElementById("shamisenT");
    let shamisenG = document.getElementById("shamisenG");
    let shamisenJ = document.getElementById("shamisenJ");
    let shamisenM = document.getElementById("shamisenM");
    let shamisenN = document.getElementById("shamisenN");
    let shamisenK = document.getElementById("shamisenK");
    let koto = document.getElementById("koto");
    let shakuhachi = document.getElementById("shakuhachi");
    let shinobue = document.getElementById("shinobue");
    let sanshin = document.getElementById("sanshin");
    let biwa = document.getElementById("biwa");
    let taiko = document.getElementById("taiko");
    let kokyu = document.getElementById("kokyu");
    let gagaku = document.getElementById("gagaku");
    let taishou = document.getElementById("taishou");

    if (allcheck1.checked) {
        shamisen.checked = true;
        shamisenT.checked = true;
        shamisenG.checked = true;
        shamisenJ.checked = true;
        shamisenM.checked = true;
        shamisenN.checked = true;
        shamisenK.checked = true;
        koto.checked = true;
        shakuhachi.checked = true;
        shinobue.checked = true;
        sanshin.checked = true;
        biwa.checked = true;
        taiko.checked = true;
        kokyu.checked = true;
        gagaku.checked = true;
        taishou.checked = true;
    }
    else {
        shamisen.checked = false;
        shamisenT.checked = false;
        shamisenG.checked = false;
        shamisenJ.checked = false;
        shamisenM.checked = false;
        shamisenN.checked = false;
        shamisenK.checked = false;
        koto.checked = false;
        shakuhachi.checked = false;
        shinobue.checked = false;
        sanshin.checked = false;
        biwa.checked = false;
        taiko.checked = false;
        kokyu.checked = false;
        gagaku.checked = false;
        taishou.checked = false;
    }

    showMarkers();
}

// 全選択チェックボックスのチェックを反映
function getAllChecked2() {
    let allcheck2 = document.getElementById("allcheck2");

    let shamisenT0 = document.getElementById("shamisenT0");
    let shamisenT1 = document.getElementById("shamisenT1");
    let shamisenT2 = document.getElementById("shamisenT2");
    let shamisenT3 = document.getElementById("shamisenT3");

    let koto0 = document.getElementById("koto0");
    let koto1 = document.getElementById("koto1");
    let koto2 = document.getElementById("koto2");

    let shakuhachi0 = document.getElementById("shakuhachi0");
    let shakuhachi1 = document.getElementById("shakuhachi1");
    let shakuhachi2 = document.getElementById("shakuhachi2");

    if (allcheck2.checked) {
        shamisenT0.checked = true;
        shamisenT1.checked = true;
        shamisenT2.checked = true;
        shamisenT3.checked = true;
        koto0.checked = true;
        koto1.checked = true;
        koto2.checked = true;
        shakuhachi0.checked = true;
        shakuhachi1.checked = true;
        shakuhachi2.checked = true;
    }
    else {
        shamisenT0.checked = false;
        shamisenT1.checked = false;
        shamisenT2.checked = false;
        shamisenT3.checked = false;
        koto0.checked = false;
        koto1.checked = false;
        koto2.checked = false;
        shakuhachi0.checked = false;
        shakuhachi1.checked = false;
        shakuhachi2.checked = false;
    }

    showMarkers();
}
