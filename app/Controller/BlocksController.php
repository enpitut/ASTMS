<?php
class BlocksController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
    	// echo print_r($this->Block->find('all'));
    }

   //ブロック情報の保存
	public function saveBlocks($shopid, $blockpos, $blockname, $blockcolor){
		//debug($blockpos);
		//debug($blockname);
		//debug($blockcolor);

		//配列の中身を分割
		$blockpos_array = explode(",", $blockpos);
		$blockname_array = explode(",", $blockname);
		$blockcolor_array = explode(",", $blockcolor);
		//debug($blockpos_array);
		//debug($blockname_array);
		//debug($blockcolor_array);

		//1マップ内のブロックの個数
		$blocknum = count($blockname_array);

		//debug($blockname_array[1]);
		//debug($blockcolor_array[1]);


		//ブロックを1つずつDBに登録
		for($i = 1; $i < $blocknum; $i++){//ok
			//debug($blockpos_array[4*$i]);
			//debug($blockname_array[$i]);
			//debug($blockcolor_array[$i]);

			$this->Block->create();
			//登録する値
			$data = array('Block' => array('shop_id' => $shopid, 'x-coordinate' => $blockpos_array[4*$i], 'y-coordinate' => $blockpos_array[4*$i+1],'name' => $blockname_array[$i], 'color' => $blockcolor_array[$i]));
			// 登録するフィールド
			$fields = array( 'id', 'shop_id', 'x-coordinate', 'y-coordinate',  'name', 'color');

			// 新規登録
			$this->Block->save($data, false, $fields);
		}
	}

	//店IDが$idのブロックをすべて返す
	public function getBlocks($id){
		// viewを使用しない
      	$this->autoRender = false;

		//ブロック情報を読み込む
		//$this->Block->find('all', array('conditions'=> array('shop_id' => 'id')));
		$result = $this->Block->find('all', array('conditions'=> array('shop_id' => $id)));//テスト用
		//debug($result);
		return $result;
	}

	/*
	//createmap.jsでそのまま使えるようにブロック情報をリスト化
	//getblocksの結果を引数にする？
	public function makeBLocksList($blocks){
	}*/

}
?>
