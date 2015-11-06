<?php
class ShopsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session', 'GoogleMap');
	public $components = array('Session');

	public function index() {
		$this->set('shops', $this->Shop->find('all'));
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
				$path = constant('WWW_ROOT') . 'img' . DS . 'shop_images';
				//画像の取得
				$image = $this->request->data['Shop']['image'];
				//保存する名前
				$image['name'] = strval($this->Shop->id).'.jpg';

				if(move_uploaded_file($image['tmp_name'], $path . DS . $image['name'])){
					// $this->Session->setFlash('画像を登録しました');
				}else{
					// $this->Session->setFlash('登録失敗');
				}
				///////////////////////////////////////////////////////////////////////////////////////////////
				//キャンバスサイズと追加した店のidをcreatemap.ctpに渡す
				$this->Session->write('floorwidth', $this->request->data('Shop.width'));
				$this->Session->write('floorheight', $this->request->data('Shop.height'));
				$this->Session->write('last_id', $this->Shop->getLastInsertID());

				//マップ新規作成画面へ
				return $this->redirect(array('action' => 'createmap'));
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

	public function search_with_keyword() {
			//リクエストがPOSTメソッドで送られてきた場合
		if($this->request->is('post')) {
				//formのパラメータ(ラジオボタンおよびテキスト)を取得
			$searchtype = $this->request->data('searchtype');
			$searchword = $this->request->data('keyword');
			
			switch ($searchtype) {
				case 'shopname' :
				$conditions = array('conditions' => array('Shop.name LIKE' => '%' . $searchword . '%'));
				break;

				case 'address' :
				$conditions = array('conditions' => array('Shop.street_address LIKE' => '%' . $searchword . '%'));
				break;

				case 'category':
				$conditions = array('conditions' => array('Shop.category LIKE' => '%' . $searchword . '%'));
				break;

			}
				//条件に一致するものを全件取得
			$data = $this->Shop->find('all', $conditions);
		}else{
			$data = $this->Shop->find('all');
		}
		$this->set('result', $data);
	}


	
	//マップ作成画面
	public function createmap(){


		//キャンバスサイズをviewに渡す
		$this->set('width', $this->Session->read('floorwidth'));
		$this->set('height', $this->Session->read('floorheight'));

		//最後に追加したshop情報を取得
		$last_id = $this->Session->read('last_id');
		$shop = $this->Shop->findById($last_id);
		$this->set('shop', $shop);

		//背景として読み込む画像のパス
		$path = DS . constant('WEBROOT_DIR') . DS .'img' . DS . 'shop_images';
		$this->set('path', $path);
		debug($path);

	}

	//(新規作成した)マップjpeg画像を保存
	public function savemap(){
		// viewを使用しない
      	$this->autoRender = false;

      	//エンコードされたキャンパスの内容を受け取る
      	$file_path = $this->request->data('Shop.mapstring');

		//文字列をデコード
		$canvas = base64_decode($file_path);

		//まだ文字列の状態なので、画像リソース化
		$image = imagecreatefromstring($canvas);
 
		//画像として保存
		imagejpeg($image, WWW_ROOT . 'img' . DS .'shop_images'.DS. strval($this->request->data('Shop.id')).".jpg");
		imagedestroy($image);

		//トップに戻る
		return $this->redirect(array('action' => 'index'));
	}

	//Shopsから要素削除
	public function delete(){
		$this->autoRender = false;

    	$id = $this->request->data('Shop.id');
    	$this->Shop->delete($id);
    	$this->redirect(array('action'=>'index'));
	}

}
?>
