<!-- File: /app/View/Shops/index.ctp -->
<!-- <?php $this->autoLayout = false; ?>にするとマップが表示されない。解決法求む -->
<?php $this->autoLayout = false; ?>
<!-- グーグルヘルパー読み込み -->
<!-- <?= $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', false); ?>  -->
<?= $this->Html->script('http://maps.google.com/maps/api/js?sensor=false', true); ?>
<!-- マーカーをクラスタ化するために必要 -->
<?= $this->Html->script("http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js", true); ?>
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
					<form class="form" action="/ShopAreaWiki/shops/search_with_keyword" method="POST">
						<div class="row">
							<div class="col-md-12 text-center">
								<input type="text" name="shopname" class="search_box" autofocus placeholder="店名を入力">
								<button type="submit" class="btn search_button"> 検 索 </button>
							</div>
						</div>
						<div class="row">
							<a class="btn btn-default" data-toggle="collapse" href="#MyCollapse">
								検索条件設定
							</a>
							<div class="collapse" id="MyCollapse">
								<div class="well">
									検索結果を絞り込む条件を指定します
									<div class="form-group">
										<label class="col-md-2 control-label" for="InputAddress">所在地</label>
										<div class="col-md-2">
											<div class="input select">
												<select name="prefecture">
													<option value="" selected>---</option>
													<option value="北海道">北海道</option>
													<option value="青森県">青森県</option>
													<option value="岩手県">岩手県</option>
													<option value="宮城県">宮城県</option>
													<option value="秋田県">秋田県</option>
													<option value="山形県">山形県</option>
													<option value="福島県">福島県</option>
													<option value="茨城県">茨城県</option>
													<option value="栃木県">栃木県</option>
													<option value="群馬県">群馬県</option>
													<option value="埼玉県">埼玉県</option>
													<option value="千葉県">千葉県</option>
													<option value="東京都">東京都</option>
													<option value="神奈川県">神奈川県</option>
													<option value="新潟県">新潟県</option>
													<option value="富山県">富山県</option>
													<option value="石川県">石川県</option>
													<option value="福井県">福井県</option>
													<option value="山梨県">山梨県</option>
													<option value="長野県">長野県</option>
													<option value="岐阜県">岐阜県</option>
													<option value="静岡県">静岡県</option>
													<option value="愛知県">愛知県</option>
													<option value="三重県">三重県</option>
													<option value="滋賀県">滋賀県</option>
													<option value="京都府">京都府</option>
													<option value="大阪府">大阪府</option>
													<option value="兵庫県">兵庫県</option>
													<option value="奈良県">奈良県</option>
													<option value="和歌山県">和歌山県</option>
													<option value="鳥取県">鳥取県</option>
													<option value="島根県">島根県</option>
													<option value="岡山県">岡山県</option>
													<option value="広島県">広島県</option>
													<option value="山口県">山口県</option>
													<option value="徳島県">徳島県</option>
													<option value="香川県">香川県</option>
													<option value="愛媛県">愛媛県</option>
													<option value="高知県">高知県</option>
													<option value="福岡県">福岡県</option>
													<option value="佐賀県">佐賀県</option>
													<option value="長崎県">長崎県</option>
													<option value="熊本県">熊本県</option>
													<option value="大分県">大分県</option>
													<option value="宮崎県">宮崎県</option>
													<option value="鹿児島県">鹿児島県</option>
													<option value="沖縄県">沖縄県</option>
												</select>
											</div>
										</div>
										<div class="col-md-8">
											<input type="text" name="address" class="form-control" placeholder="区市町村以下　例)千葉市稲毛区弥生町">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="InputCategory">カテゴリー</label>
										<div class="col-md-10">
											<input type="text" name="category" class="form-control" placeholder="例)デパート">
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
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
		<!-- マーカーのクラスタ化（近いものはまとめて表示） -->
		<?php echo $this->GoogleMap->clusterMarkers("map_canvas");?>

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









