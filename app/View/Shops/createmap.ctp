<!-- File: /app/View/Shops/createmap.ctp -->

<?php $this->autoLayout = false; ?>
<?php  echo $this->Html->css('shop_view');?>
<?php  echo $this->Html->charset("utf-8");?>

<!-- javascript -->
<script type="text/javascript">

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

//背景+保存済みのブロック描画
function drawMap(){
	var canvas = document.getElementById('mapcanvas');
	if (canvas.getContext) {
		var context = canvas.getContext('2d');

		//背景画像がない場合のcanvasサイズ=add画面で入力したサイズ
  		canvas.width = <?php echo $width; ?>;
		canvas.height= <?php echo $height; ?>;

		//アップした画像("/cakephp/img/shop_images/店番号.jpg")の読み込み
   		// 読み込めたら背景画像にする
   		var shopid = <?php echo $shop['Shop']['id']?>;
  		var img = new Image();
  		
  		var imgname = "<?= $path ?>" + "/" + String(shopid)+ ".jpg";

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
			colors.push(getCurrentColor());
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
	context.fillStyle = getCurrentColor(); //塗りつぶしの色

	for(var i =0; i < blocks.length; i++){
		//ブロックの描写
		context.fillStyle = colors[i];//色選択
		context.globalAlpha = 0.3;//透明度の変更
		context.fillRect(blocks[i][0], blocks[i][1], blocks[i][2], blocks[i][3]);
		context.globalAlpha = 1.0;//透明度の変更
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

//現在選択している色の名前を取得する
//ラジオボタンを使わなくしたい
function getCurrentColor(){
	var radioList = document.getElementsByName("color");
	var color;
	for(var i=0; i<radioList.length; i++){
		if (radioList[i].checked) {
			color = radioList[i].value;
			break;
		}
	}
	return color;
}



</script>

<!-- 店内マップ表示-->
<div id="page">
	<div>	<?php echo $this->Html->image('ww.jpg', array('alt' => 'Shop Area Wiki', 'width'=>'384','height'=>'62')); ?>
	</div>
	 
	 <!-- 店舗情報 (編集できるようにしたい)-->
	<div id="textwapper"> 
		<span id="text1">
			<?php echo 'name: ' . $shop['Shop']['name']; ?><br>
		</span>
		<span id="text2">
			<?php echo  'id: ' . $shop['Shop']['id']; ?><br>
			<?php echo 'postal_code: ' . $shop['Shop']['postal_code']; ?><br>
			<?php echo 'prefecture: ' . $shop['Shop']['prefecture']; ?><br>
			<?php echo 'street_address: ' . $shop['Shop']['street_address']; ?><br>
			<?php echo 'category: ' . $shop['Shop']['category']; ?><br>
			<?php echo 'comment: ' . $shop['Shop']['comment']; ?>
		</span>
	</div>

	<!-- canvasで画像表示 -->
	<body onLoad="drawMap()">
	<canvas id="mapcanvas" style="background-color:#FFFFFF;" ></canvas>

	<!-- 編集ツール -->
	<p>
		<input type="radio" name="mode" value="make" checked=""> ブロックを作成
		<input type="radio" name="mode" value="move"> ブロックを移動
		<input type="radio" name="mode" value="delete"> ブロックを削除
	</p>

	<!-- 色選択のラジオボタン (仮) -->
	<!-- パレットにしたい -->
	<p>
		<input type="radio" name="color" value="#FF0000" checked=""> 赤
		<input type="radio" name="color" value="#00FF00"> 緑
		<input type="radio" name="color" value="#0000FF"> 青
	</p>

	<form>
		<input id ="resetbutton" type="button" value="全ブロック消去" onclick="deleteAllBlocks()">
	</form>	
	<br>

	<div>
		<!-- 新しい店内マップを登録 -->
		<form  id = "saveform" method="POST" action="/ShopAreaWiki/shops/savemap">
			<div>
				<input id = "savebutton" type="submit" value="店内マップを保存" disabled="true" />
				<input id = "mapstring" type="hidden" name="data[Shop][mapstring]" >
				<input id = "shopid" type="hidden" name="data[Shop][id]" value = <?php echo strval($shop['Shop']['id'])?>>
			</div>
		</form>

		<!-- 登録キャンセル -->
		<form id = "cancleform" method="POST" action="/ShopAreaWiki/shops/delete">
			<div>
				<input id = "cancelbutton" type="submit" value="登録をやめる" />
				<input id = "deleteid" type="hidden" name="data[Shop][id]" value = <?php echo strval($shop['Shop']['id'])?> >
			</div>
		</form>
	</div>
	

	<div id="tbottom">
		Copyright &copy; 2015 ASTMS. All Rights Reserved.
	</div>
</div>
