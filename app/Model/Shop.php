<?php
class Shop extends AppModel {
	public $hasMany = 'Floor';

	//バリデーション
	public $validate = array(
		//ショップ名
		'name' => array(
    			'notEmpty' => array(
      				'rule'    => 'notEmpty',
      				'allowEmpty' => true,
    			)
 	 	),

 	 	//郵便番号
 	 	'postal_code' => array(
    			'notEmpty' => array(
      				'rule' => array( 'custom', '/^[0-9]{3}-[0-9]{4}$/'),//ハイフン必須
      				//'rule' => array( 'custom', '/^[0-9]{3}[\s-]?[0-9]{4}$/'),//ハイフンあってもなくてもOK
      				'allowEmpty' => true,
    			)
 	 	),

 	 	//住所
 	 	'street_address' => array(
    			'notEmpty' => array(
      				'rule'    => 'notEmpty',
      				'allowEmpty' => false,
    			)
 	 	),
	);
}
?>
