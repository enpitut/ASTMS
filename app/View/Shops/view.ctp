<!-- File: /app/View/Shops/view.ctp -->
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
	<?php echo $this->Html->css('view.css');?>
	<title>ShopAreaWiki</title>
</head>

<body>
	<section class="container-fluid">
		<!-- ヘッダーっぽいもの -->
		<div class="row header">
			<div class="col-md-3">
				<!-- 画像 -->
				<a href="http://localhost/ShopAreaWiki/shops/">
					<?php echo $this->Html->image('logo.png', array('alt' => 'Shop Area Wiki','class' => 'logo')); ?>
				</a>
			</div>

			<div class="col-md-1 col-md-offset-8">
				<?php echo $this->Html->link("新規", array('controller' => 'Shops', 'action' => 'add')); ?>
			</div>
		</div>

		<div  class="container-fluid information_row">
			<!-- 現在マップが表示されているお店の名前、郵便番号、住所、（電話番号）、ジャンル、コメントを記すエリア -->
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12 shop_name">
							<?php echo $shop['Shop']['name']; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					〒<?php echo $shop['Shop']['postal_code']; ?> <?php echo $shop['Shop']['prefecture']; ?><?php echo $shop['Shop']['street_address']; ?>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-3 text-right">
						<b>カテゴリ</b>:
						</div>
						<div class="col-md-9">
							<?php echo $shop['Shop']['category']; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 text-right">
							<b>コメント</b>:
						</div>
						<div class="col-md-9">
							<?php echo $shop['Shop']['comment']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">

			<div class="panel panel-default">
				<div class="panel-heading">
					店内マップ
				</div>
				<div class="panel-body">
					<p align="center"><?php echo $this->Html->image("shop_images/{$shop['Shop']['id']}.jpg"); ?></p>
				</div>
			</div>
		</div>


		<!-- マップ編集ボタン -->
		<div class="container-fluid">
			<div class="row footer">
				<div class="col-md-10">
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-default">
						<span class="glyphicon glyphicon-edit"></span>  編集
					</button>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
