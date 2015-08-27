<!-- File: /app/View/Shops/index.ctp -->
<?php $this->autoLayout = false; ?>
<?php  echo $this->Html->css('default');?>

<div id="page">
	<div id="timage"><?php echo $this->Html->image('ww.jpg', array('alt' => 'Shop Area Wiki')); ?></div>


	<div id="middle">
		<!-- フォームと送信ボタン -->
		<form action="/cakephp/shops/search" method="POST">
			<div class="input text">
				<input type="text" name="txt" id="txtTitle" placeholder="店名を入力"/>
			</div>
			<div class="submit">
				<input type="submit" value="検索" />
			</div>
		</form>
		<div id="tbottom" >
			Copyright &copy; 2015 ASTMS. All Rights Reserved.
		</div>
	</div>
</div>