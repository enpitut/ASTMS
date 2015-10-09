<?php
class ShopsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');

	public function index() {
	}

	public function add() {
		if ($this->request->is('post')) {
        	//配列にデータを複数持ち、それをループで回して全て INSERT しようとした際に、
        	//ループ内で Model::save() をすると、2回目以降が UPDATE になってしまう
        	//そのためにcreateを使う
			$this->Shop->create();
			if ($this->Shop->save($this->request->data,true,array_keys($this->Shop->getColumnTypes()))) {
				//以下 画像の保存////////////////////////////////////////////////////////////////////////////////
      			//画像保存先のパス
				$path = constant('WWW_ROOT') . '/img/shop_images';
				//画像の取得
				$image = $this->request->data['Shop']['image'];
				//保存する名前
				$image['name'] = strval($this->Shop->id).'.jpg';

				if(move_uploaded_file($image['tmp_name'], $path . '/' . $image['name'])){
					// $this->Session->setFlash('画像を登録しました');
				}else{
					// $this->Session->setFlash('登録失敗');
				}
				///////////////////////////////////////////////////////////////////////////////////////////////
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your post.'));
		}
	}

	public function view($id = null){
		if(!$id){
			throw new NotFoundException(__('Invalid post'));
		}

    	//Shopモデルの取得
		$this->Shop->recursive = 1;
		$shop = $this->Shop->findById($id);
		$this->set('shop', $shop);
		// echo print_r($shop);
    	//floorモデルsのセット
		// $this->loadModel('Floor');
		// $this->Floor->recursive = 0;
		// $floors = $this->Floor->find('all',array('conditions' => array('shop_id' => $id)));
		// echo print_r($floors);
		// $this->loadModel('Block');
		// $blocks = $this->Block->find('all',array('conditions' => array('shop_id' => $id)));
		// echo print_r($blocks);


    	//ブロックのセット


	}

	       //店名検索結果
	public function search() {
            //リクエストがPOSTメソッドで送られてきた場合
		if($this->request->is('post')) {
				//formのパラメータ取得
			$searchword = $this->request->data('txt');
           		//絞り込み条件
			$conditions = array('conditions' => array('Shop.name LIKE' => '%' . $searchword . '%'));
            	//条件に一致するものを全件取得
			$data = $this->Shop->find('all', $conditions);
		}else{
			$data = $this->Shop->find('all');
		}
		$this->set('result', $data);
	}
}
?>