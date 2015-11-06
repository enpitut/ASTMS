<!-- File: /app/View/Shops/index.ctp -->
<!-- <?php $this->autoLayout = false; ?>にするとマップが表示されない。解決法求む -->
<?php $this->autoLayout = true; ?>
<!-- グーグルヘルパー読み込み -->
<!-- <?= $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', false); ?>  -->
<?= $this->Html->script('http://maps.google.com/maps/api/js?sensor=false', false); ?>
<!-- 始_グーグルマップオプション -->

<?php
	// Override any of the following default options to customize your map
$map_options = array(
	'id' => 'map_canvas',
	'width' => '800px',
	'height' => '800px',
	'style' => '',
	'zoom' => 15,
	'type' => 'ROADMAP',
	'custom' => null,
	'localize' => true,
	'latitude' => 40.69847032728747,
	'longitude' => -1.9514422416687,
	'address' => '1 Infinite Loop, Cupertino',
	'marker' => true,
	'markerTitle' => 'This is my position',
	'markerIcon' => 'http://google-maps-icons.googlecode.com/files/home.png',
	'markerShadow' => 'http://google-maps-icons.googlecode.com/files/shadow.png',
	'infoWindow' => true,
	'windowText' => 'My Position'
	);
	?>
	<!-- 終_グーグルマップオプション -->

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

		<!-- 自作のCSSを読み込む -->
		<?php  echo $this->Html->css('search.css');?><!-- cakephp/app/css/index.css (元default.css)-->
		<title>ShopAreaWiki</title>
	</head>

	<body>
		<div class="container-fluid">
			<div class="row header border_bottom">
				<div class="col-md-12 text-center">
					<!-- ロゴ -->
					<div id="timage"><?php echo $this->Html->image('logo.png', array('alt' => 'Shop Area Wiki','class' => 'title')); ?></div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 text-center">
					<!-- 検索フォーム　-->
					<form class="form-inline" action="/ShopAreaWiki/shops/search_with_keyword" method="POST">
						<input type="text" name="keyword" id="keyword" class="search_box" autofocus placeholder="キーワードを入力">

						<!--　ラジオボタンで検索対象選択 -->
						<div class="radio-inline">
							<input type="radio" autocomplete="on" value="shopname" name="searchtype" id="shopname" >
							<label for="shopname">店名</label>
						</div>
						<div class="radio-inline">
							<input type="radio" value="address" name="searchtype" id="address">
							<label for="address">住所</label>
						</div>
						<div class="radio-inline">
							<input type="radio" value="category" name="searchtype" id="category">
							<label for="category">ジャンル</label>
						</div>

						<button type="submit" class="btn search_button"> 検 索 </button>
					</form>
				</div>
			</div>

			<div class="container-fluid">
				<div class="row">
					<div class ="col-md-12 text-center">

						<!-- 始_マップ表示 -->
						<!-- マップを画面の中心に表示 -->
						<center><?= $this->GoogleMap->map($map_options); ?></center>

						<!-- お店のマーカー表示（全ての店なので，後ほど表示範囲内に変更） -->
						<?php foreach ($shops as $shop): ?>
							<!-- $shop_marker_numに店idを代入すれば被らないし使いやすい -->
							<?php $shop_marker_num = $shop['Shop']['id']; ?>
							<!-- リンク用の変数にリンクを代入 -->
							<?php $html{"$shop_marker_num"}=" <a href=\"view/$shop_marker_num\">{$shop['Shop']['name']}</a> "; ?>
							<?php
				// マーカーオプション
							$marker_options = array(
				'showWindow' => true,							//クリックしたときのウィンドウを表示するか
				'windowText' => $html{"$shop_marker_num"} ,		//クリックしたときのウィンドウのテキスト
				'markerTitle' => $shop['Shop']['name'],			//マーカーのタイトル
				'markerIcon' => 'http://labs.google.com/ridefinder/images/mm_20_purple.png',			//マーカーアイコンの画像
				'markerShadow' => 'http://labs.google.com/ridefinder/images/mm_20_purpleshadow.png',	//マーカーアイコンの影
				);
				?>
				<!-- マーカー付け -->
				<?= $this->GoogleMap->addMarker("map_canvas", $shop_marker_num, array('latitude' => $shop['Shop']['latitude'], 'longitude' => $shop['Shop']['longitude']), $marker_options); ?>
			<?php endforeach; ?>

			<!-- 使わないけど残しておく範囲 -->
			<?php
			// Override any of the following default options to customize your marker
			$marker_options = array(
				'showWindow' => true,
				'windowText' => 'Marker',
				'markerTitle' => 'Title',
				'markerIcon' => 'http://labs.google.com/ridefinder/images/mm_20_purple.png',
			//    'markerShadow' => 'http://labs.google.com/ridefinder/images/mm_20_purpleshadow.png',
				);
				?>

				<!-- 経路探索に使いそうなライン。サンフランシスコ～ハワイを見ると何なのかわかる。後で使えそうだし負荷にならないから残しておく -->
				<?= $this->GoogleMap->addPolyline("map_canvas", "polyline", array("start" => array("latitude" =>37.772323 ,"longitude"=> -122.214897), "end" => array("latitude" =>21.291982 ,"longitude"=> -157.821856))); ?>
				<?= $this->GoogleMap->addMarker("map_canvas", 2, "1 Infinite Loop, Cupertino, California", $marker_options); ?>
				<?= $this->GoogleMap->addMarker("map_canvas", 1, array('latitude' => 40.69847, 'longitude' => -73.9514)); ?>
				<?php
				$options = array(
					"strokeColor" => "#FFFFFF",
					"strokeOpacity" => 1,
					"strokeWeight" => 8
					);
					?>
					<?= $this->GoogleMap->addPolyline("map_canvas", "polyline", array("start" => array("latitude" => 37.672323 ,"longitude" => -122.214897), "end" => array("latitude" => 21.261982 , "longitude" => -157.821856)), $options); ?>
					<!-- 終 使わないけど残しておく範囲 -->
					<!-- 終_マップ表示 -->

				</div>
			</div>
		</div>
	</body>
	</html>









