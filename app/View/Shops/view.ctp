<!-- File: /app/View/Shops/view.ctp -->

<?php $this->autoLayout = false; ?>
<?php  echo $this->Html->css('shop_view');?>

<div id="page">
	<div>	<?php echo $this->Html->image('ww.jpg', array('alt' => 'Shop Area Wiki', 'width'=>'384','height'=>'62')); ?></div>
	<div id="textwapper"> <span id="text1"><?php echo $shop['Shop']['name']; ?></span> <span id="text2">
		<?php echo $shop['Shop']['postal_code']; ?>
		<?php echo $shop['Shop']['prefecture']; ?>
		<?php echo $shop['Shop']['street_address']; ?>
		<?php echo $shop['Shop']['category']; ?>
		<?php echo $shop['Shop']['comment']; ?>
	</span>

	<!-- <div id="text3"> <span class="textcolor">1F </span><span >2F </span> </div> -->
	<div> <?php echo $this->Html->image("shop_images/{$shop['Shop']['id']}.jpg"); ?> </div>
	<div id="tbottom" >
		Copyright &copy; 2015 ASTMS. All Rights Reserved.
	</div>
</div>