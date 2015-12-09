<!-- File: /app/View/Shops/createmap.ctp -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="ja"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap の本体のCSSを読み込む -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<?php $this->autoLayout = false; ?>
	<?php  echo $this->Html->css('createMap');?>
	<?php  echo $this->Html->charset("utf-8");?>
	<?php echo $this->Html->script('createMap'); ?>

</head>

<!-- ********** キャンバス初期化時にブロック情報読み込み追加予定 **********-->
<!-- もともとのコード　DBからブロックは受け取らない --> 
<body onLoad="initCreateMap(<?php echo $shop['Shop']['id']?>,<?php echo $width; ?>,<?php echo $height; ?>)">

<!-- 以下3つ ブロック情報の読み込みテスト  -->
<!-- phpの変数としては読めるがcreatemap.jsに渡せていない-->
<!-- ********** -->
<!-- <body onLoad="initCreateMap(<?php echo $shop['Shop']['id']?>,<?php echo $width; ?>,<?php echo $height; ?>,<?php echo $dbblock[0]['Block']['id']; ?>)"> -->

<!-- <body onLoad="initCreateMap(<?php echo $shop['Shop']['id']?>,<?php echo $width; ?>,<?php echo $height; ?>,<?php echo $dbblock[0]['Block']; ?>)"> -->

 <!-- <body onLoad="initCreateMap(<?php echo $shop['Shop']['id']?>,<?php echo $width; ?>,<?php echo $height; ?>, JSON.parse('<?php echo $json_test2;?>'))"> -->
<!-- ********** -->
	
<section class="container-fluid">

		<!-- ヘッダーっぽいもの -->
	<div class="row header">
		<div class="col-md-12">
			<!-- ロゴ -->
			<a href="http://localhost/ShopAreaWiki/shops/">
				<?php echo $this->Html->image('logo.png', array('alt' => 'Shop Area Wiki','class' => 'logo')); ?>
			</a>
		</div>
	</div>

	<div class="toolbar">
		<!-- 色選択行 -->
		<div class="row">
			<div class="col-md-12">
				色選択
				<table class="color_palet"><tr>
		    		<td style="background-color:#ff0000" onclick="chooseColor(this)"></td>
		    		<td style="background-color:#00ff00" onclick="chooseColor(this)"></td>
		    		<td style="background-color:#0000ff" onclick="chooseColor(this)"></td>
		    		<td style="background-color:#ffff00" onclick="chooseColor(this)"></td>
		    		<td style="background-color:#00ffff" onclick="chooseColor(this)"></td>
		    		<td style="background-color:#ff00ff" onclick="chooseColor(this)"></td>
    			</tr></table>
			</div>
		</div>

		<!-- ブロック操作選択ボタン行 -->
		<div class="row operate_block_bar">
			<div class="col-md-2">
				<input type="radio" name="mode" value="make" checked=""> ブロックを作成
			</div>
			<div class="col-md-2">
				<input type="radio" name="mode" value="move"> ブロックを移動
			</div>
			<div class="col-md-2">
				<input type="radio" name="mode" value="delete"> ブロックを削除
			</div>


			<div class="col-md-2">
				<button id ="resetbutton" type="button" class="btn btn-danger" onclick="deleteAllBlocks()">全ブロック消去</button>
			</div>
			<!-- <form>
				<input id ="resetbutton" type="button" value="全ブロック消去" onclick="deleteAllBlocks()">
			</form>	 -->

		</div>


		<!-- 全体操作選択ボタン行 -->
		<div class="row operate_save_bar">
			<!-- 新しい店内マップを登録 -->
			<div class="col-md-1">
				<form  id = "saveform2" method="POST" action="/ShopAreaWiki/shops/savemap">
					<input id = "savebutton" type="submit" value="保存" class="btn btn-success"/>
					<input id = "mapstring" type="hidden" name="data[Shop][mapstring]" >
					<input id = "shopid" type="hidden" name="data[Shop][id]" value = <?php echo strval($shop['Shop']['id'])?>>

					<!-- ブロック情報の登録 -->
					<input id = "blockpos" type="hidden" name = "data[Blocks][pos]";?>
					<input id = "blockname" type="hidden" name = "data[Blocks][name]";?>
					<input id = "blockcolor" type="hidden" name = "data[Blocks][color]";?>
				</form>


			</div>

			<!-- 登録キャンセル -->
			<div class="col-md-1">
				<form id = "cancleform" method="POST" action="/ShopAreaWiki/shops/delete">
					<input id = "cancelbutton" type="submit" value="登録をやめる" class="btn btn-danger"/>
					<input id = "deleteid" type="hidden" name="data[Shop][id]" value = <?php echo strval($shop['Shop']['id'])?> >
				</form>
			</div>
		</div>

		<div class="row"><?php echo $this-> Html-> link('登録内容を修正',array('action'=>'edit',$shop['Shop']['id'], $width, $height)); ?></div>
		</div>

		<div  class="container-fluid information_row">
		<!-- 現在マップが表示されているお店の名前、郵便番号、住所、（電話番号）、ジャンル、コメントを記すエリア -->
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 shop_name">
						<?php echo  $shop['Shop']['name']; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php echo $shop['Shop']['postal_code']; ?> <?php echo $shop['Shop']['street_address']; ?>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
						<b>ジャンル</b>:
					</div>
					<div class="col-md-10">
						<?php echo  $shop['Shop']['category']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>コメント</b>:
					</div>
					<div class="col-md-10">
						<?php echo  $shop['Shop']['comment']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			店内マップ
		</div>
		<div class="panel-body">
			<p align="center">
				<canvas id="mapcanvas" style="background-color:#FFFFFF;" ></canvas>
			</p>
		</div>
	</div>
</section>
</body>
</html>
