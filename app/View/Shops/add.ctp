<!-- File: /app/View/Shops/add.ctp -->

<h1>Add Shop</h1>
<?php
echo $this->Form->create('Shop', array('type'=>'file', 'enctype' => 'multipart/form-data'));
echo $this->Form->input('name');
echo $this->Form->input('postal_code');
echo $this->Form->input('prefecture', array(
			'type'=>'select',
			  'options'=>array(
				array('apple'=>'茨城県',
				      'banana'=>'千葉県',
				      'melon'=>'東京都'
				      )
				)
		));
echo $this->Form->input('street_address');
echo $this->Form->input('category');
echo $this->Form->input('comment');
echo $this->Form->input('height');
echo $this->Form->input('width');
echo $this->Form->input('image', array('label' => false, 'type' => 'file', 'multiple'));
echo $this->Form->end('Save Shop');
?>