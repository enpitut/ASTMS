//******ブロック情報
//(マップ保存時にデータベースに保存？)
//(編集のときはデータベースからここに読み込む？)

//ブロックのサイズ指定
//[0] = ブロック非選択状態
var blocks = new Array (new Array(0, 0, 0, 0)); //(ブロックx座標, ブロックy座標, 幅, 高さ)
//ブロック名
var labels = new Array("");
//色
var colors = new Array("");




//*******


var x1, y1;//ブロック開始点
var x2, y2;//終点
var drag = false;//ドラッグ中か

var chosenblock=0;//マウスで選択したブロックのナンバー (0 = 非選択状態)
var currentcolor='#ff0000';//現在選択している色

//描写したブロック情報をhtmlに渡す //プルリク後実験
function setBlockinfo(){
	document.getElementById('blockpos').value=blocks;
	document.getElementById('blockname').value=labels;
	document.getElementById('blockcolor').value=colors;	
}

//応急処置のグローバル変数を作る後で消す/////////////////////////////////////////////////////////////////////////////////////////

var SHOPID, WIDHTH, HEIGHT;

//初期化
//ここでブロック情報初期化？
function initCreateMap(shopID, width, height, blocks){
	SHOPID = shopID;
	WIDHTH = width;
	HEIGHT = height;
	//loadBlocks(shopID);//ブロック読み込み
	drawMap();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//背景+保存済みのブロック描画
function drawMap(){
	var canvas = document.getElementById('mapcanvas');
	if (canvas.getContext) {
		var context = canvas.getContext('2d');

		//背景画像がない場合のcanvasサイズ=add画面で入力したサイズ
  		canvas.width = WIDHTH;
		canvas.height= HEIGHT;

		//アップした画像("/cakephp/img/shop_images/店番号.jpg")の読み込み
   		// 読み込めたら背景画像にする
   		var shopid = SHOPID;
  		var img = new Image();
  		var imgname = "/ShopAreaWiki/img/shop_images/" + String(shopid)+ ".jpg";//ルートディレクトリがShopAreaWikiであること前提

  		img.src = imgname + "?" + new Date().getTime();
  		img.onload = function() {
  			canvas.width = img.width;
			canvas.height= img.height;
    			context.drawImage(img, 0, 0);

    			//作ったブロックを描写
    			drawblocks(context);

    			//アップした画像は加工しなくても保存可能にする
    			savemap(canvas);
		}

    		//背景 白
    		context.fillStyle='#FFFFFF';
    		context.fillRect(0,0, canvas.width, canvas.height);

	    	//canvasの枠線 黒
		context.strokeStyle='#000000';
		context.strokeRect(0,0,canvas.width, canvas.height);

		//保存しておいたブロック描写
		drawblocks(context);

	}

	//マウスの動き反映の設定
	canvas.addEventListener("mousedown", mousedown, false);
	canvas.addEventListener("mousemove", mousemove, false);
	canvas.addEventListener("mouseup", mouseup, false);

        //ブロック情報を渡す　テスト
	//setBlockinfo();

}

//ドラッグ開始時orマウスボタンを押したときの処理
function mousedown(e) {
	var canvas = document.getElementById('mapcanvas');
	var context = canvas.getContext('2d');
	var rect = e.target.getBoundingClientRect();

	//作業のモードチェック
	var radioList = document.getElementsByName("mode");

	//マウスの始点取得
	if(drag==false){
		x1 = e.clientX - rect.left;
		y1 = e.clientY - rect.top;
		drag=true;
	}

	if(radioList[1].checked || radioList[2].checked){//ブロック移動or削除モードの場合
		//ブロックをクリックしたかを調べる
		//******ブロックにリンク貼るときもこの判定を使う******
		for(var i = 0; i < blocks.length; i++){
			if(blocks[i][0] < x1 && x1 < blocks[i][0] + blocks[i][2]){//x座標チェック
				if(blocks[i][1] < y1 && y1 < blocks[i][1] + blocks[i][3]){//y座標チェック
					chosenblock = i
					break;
				}
			}
		}
	}
}

//マウス移動中orドラッグ中の処理
function mousemove(e){
	var canvas = document.getElementById('mapcanvas');
	var context = canvas.getContext('2d');
	var rect = e.target.getBoundingClientRect();

	//作業のモードチェック
	var radioList = document.getElementsByName("mode");

	if(radioList[0].checked){//ブロックのガイドライン表示
		if(drag==true){
			context.strokeRect(x1,y1, e.clientX - rect.left-x1, e.clientY - rect.top-y1);
			context.fillStyle='#FFFFFF';
			context.fillRect(x1,y1, e.clientX - rect.left-x1, e.clientY - rect.top-y1);
		}
	}else if(radioList[1].checked){//ブロック移動
			context.strokeRect(blocks[chosenblock][0] + (e.clientX - rect.left-x1), blocks[chosenblock][1] + (e.clientY - rect.top-y1), blocks[chosenblock][2], blocks[chosenblock][3]);
	}
}

//ドラッグ終了時orクリック修了時
function mouseup(e) {
	var canvas = document.getElementById('mapcanvas');
	var context = canvas.getContext('2d');
	var rect = e.target.getBoundingClientRect();

	//ドラッグ終了フラグ
	drag = false;

	//終点取得
	x2 = e.clientX - rect.left;
	y2 = e.clientY - rect.top;

	//作業のモードチェック
	var radioList = document.getElementsByName("mode");

	if(radioList[0].checked){//ブロック作成
		//ブロック名の入力
		var result = prompt("ブロック名を入力してください (例:「本」)","");
		context.font= 'bold 20px Century Gothic';//フォント指定
		context.globalAlpha = 1.0;//透明度の変更
		context.fillText(result, (x1 + (x2-x1)/2), (y1 + (y2-y1)/2));
	
		//OKボタンが押されたらブロック情報を保存
		if(result != ""){
			blocks.push(new Array(x1, y1, x2-x1, y2-y1));
			labels.push(result);
			colors.push(currentcolor);
		}
	}else if(radioList[1].checked){//ブロック移動
		//ブロックの座標を更新
		blocks[chosenblock][0] += x2-x1;
		blocks[chosenblock][1] += y2-y1;
	}else if(radioList[2].checked){//ブロック削除
		if(0 < chosenblock){
			blocks.splice(chosenblock, 1);
			labels.splice(chosenblock, 1);
			colors.splice(chosenblock, 1);
		}
	}

	chosenblock=0;//移動ブロックを非選択にする	
	drawMap();//再描画
	savemap(canvas);

}

//画像保存の準備
function savemap(canvas){
	//canvasの内容をエンコード
	var newmapurl = canvas.toDataURL("image/jpeg");

	// ヘッダ "data:image/jpeg;base64,"を削除
	var imgbody = newmapurl.split( ',' );
	document.getElementById("mapstring").value=imgbody[1];

	//一回でも描写したら保存可能にする
	document.getElementById("savebutton").disabled = false;
}

//配列blocks,labels,colorsに記録されたブロックをすべて描写する
function drawblocks(context){
	context.globalAlpha = 0.3;//透明度の変更
	context.fillStyle = currentcolor; //塗りつぶしの色

	for(var i =0; i < blocks.length; i++){
		//ブロックの描写
		context.fillStyle = colors[i];//色選択
		context.globalAlpha = 0.3;//透明度の変更
		context.fillRect(blocks[i][0], blocks[i][1], blocks[i][2], blocks[i][3]);
		context.globalAlpha = 1.0;//
		context.fillStyle="#000000";//ブロック名を黒で表示
		context.font= 'bold 20px Century Gothic';//フォント指定
		context.fillText(labels[i], (blocks[i][0] + blocks[i][2]/2), (blocks[i][1] + blocks[i][3]/2));
	}
}

//ブロックを全部消す
function deleteAllBlocks()
{
  	var canvas = document.getElementById('mapcanvas');
	var context = canvas.getContext('2d');

    	//canvasの枠線
	context.strokeStyle='#000000';
	context.strokeRect(0,0,canvas.width, canvas.height);

	savemap(canvas);

	//ブロック情報を初期化
	blocks = new Array(new Array(0, 0, 0, 0));
	labels = new Array("");
	colors = new Array("");

	//背景画像は残す
	drawMap();

	//保存不可にする
	document.getElementById("savebutton").disabled = true;
}


//カラーパレット上でクリックした色を現在の色として保存
function chooseColor(color){
    //クリックされた要素の背景色取得
    var newcolor_255 =(color.style.backgroundColor).toString();

    //背景色の余計な文字列削除
    newcolor_255 = newcolor_255.replace("rgb(","");
    newcolor_255 = newcolor_255.replace(")","");

    //文字列分割
    newcolor_255 = newcolor_255.split(",");

    //色..."#(6桁の16進数)"
    var newcolor = "#";

    //10進数を1色ずつ16進数に変換して連結
    for(var i = 0; i < 3; i++){
    	if(parseInt(newcolor_255[i]).toString(16).length < 2){
    		newcolor = newcolor + "0";
    	}
    	newcolor = newcolor + parseInt(newcolor_255[i]).toString(16);
    }
    currentcolor = newcolor;
}
