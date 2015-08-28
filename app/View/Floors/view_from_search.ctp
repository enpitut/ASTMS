<!-- File: /app/View/Floors/view_from_search.ctp -->
<?php  echo $this->Html->css('view_from_search');?>
<?php $this->autoLayout = false; ?>

<div id="page">
	<div>	<?php echo $this->Html->image('ww.jpg', array('alt' => 'Shop Area Wiki', 'width'=>'384','height'=>'62')); ?></div>

	<div id="info">
		<span id="shop_name"><?php echo $shop['name']; ?></span>
		<span id="adress">
			<?php echo $shop['postal_code']; ?>
			<?php echo $shop['prefecture']; ?>
			<?php echo $shop['street_address']; ?>
		</span>
		<span id="genre"><?php echo $shop['category']; ?></span>
	</div>

	<div id ="floor">
		<span id="1F">1F</span>
		<span id="2F"><a href="#">2F</a></span>
	</div>

	<table align="center" border="1">
		<tr>
			<?php
			$currentY = 1;
			foreach ($blocks as $block) {
				if ($block['y-coordinate'] > $currentY) {
					$currentY = $block['y-coordinate'];
					echo "</tr><tr>";
				}
				echo "<td>{$block['name']}</td>";
			}
			?>
		</tr>
	</table> 

</div>