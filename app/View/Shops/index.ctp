<!-- File: /app/View/Shops/index.ctp -->
<?php $this->autoLayout = false; ?>
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
	<?php  echo $this->Html->css('search');?><!-- cakephp/app/css/index.css (元default.css)-->
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
				<!-- 検索フォーム -->
				<form  action="/ShopAreaWiki/shops/search" method="POST">
					<input type="text" name="txt" class="search_box"  autofocus placeholder="店名">
					<button type="submit" class="btn search_button"> 検 索 </button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>









