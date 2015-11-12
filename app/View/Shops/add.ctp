<!-- File: /app/View/Shops/add.ctp -->
<?php $this->autoLayout = false; ?>
<!DOCTYPE html>
<html>
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
	<?php  echo $this->Html->css('addShop');?>
	<!-- 自作のCSSを読み込む -->

	<title>ShopAreaWiki</title>
</head>

<body>
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

		<h3>店情報の入力</h3>
		<form action="/ShopAreaWiki/Shops/add" enctype="multipart/form-data" id="ShopAddForm" method="post" accept-charset="utf-8">

			<div style="display:none;">
				<input type="hidden" name="_method" value="POST"/>
			</div>

			<!-- 店名 -->
			<div class="row">
				<div class="col-md-4"><input class="form-control" placeholder="店名" name="data[Shop][name]" maxlength="60" type="text" id="ShopName"/></div>
			</div>

			<!-- 郵便番号 -->
			<div class="row">
				<div class="col-md-4"><input class="form-control" placeholder="郵便番号" name="data[Shop][postal_code]" maxlength="10" type="text" id="ShopPostalCode"/></div>
			</div>

			<div class="row"><div class="col-md-12">
				<div class="input select">
					<label for="ShopPrefecture">Prefecture</label>
					<select name="data[Shop][prefecture]" id="ShopPrefecture">
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
			</div></div>

			<!-- 住所 -->
			<div class="row">
				<div class="col-md-4"><input class="form-control" placeholder="住所" name="data[Shop][street_address]" maxlength="100" type="text" id="ShopStreetAddress"/></div>
			</div>

			<!-- カテゴリー -->
			<div class="row">
				<div class="col-md-4"><input class="form-control" placeholder="カテゴリー" name="data[Shop][category]" maxlength="20" type="text" id="ShopCategory"/></div>
			</div>

			<!-- コメント -->
			<div class="row">
				<div class="col-md-4"><input class="form-control" placeholder="コメント" name="data[Shop][comment]" maxlength="200" type="text" id="ShopComment"/></div>
			</div>

			<!-- 縦横 -->
			<div class="row">
				<div class="col-md-1">
					<input class="form-control" placeholder="縦" name="data[Shop][height]" type="text" id="ShopHeight"/>
				</div>
				<div class="col-md-1">
					<input class="form-control" placeholder="横" name="data[Shop][width]" type="text" id="ShopWidth"/>
				</div>
			</div>

			<div class="row"><div class="col-md-12">
				<div class="input file">
					画像
					<input type="file" name="data[Shop][image]" multiple="multiple" id="ShopImage"/>
				</div>
			</div></div>

			<div class="row"><div class="col-md-12">
				<div class="submit">
					<input class="btn btn-success" type="submit" value="Save Shop"/>
				</div>
			</div></div>
		</form>

	</section>

</body>
</html>
