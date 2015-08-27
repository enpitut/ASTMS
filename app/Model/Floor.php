<?php
class Floor extends AppModel {
	public $belongsTo = 'Shop';
	public $hasMany = 'Block';
}
?>