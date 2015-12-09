<?php
class ShopsController extends AppController {
	//public $helpers = array('Html', 'Form', 'Session');
	public $helpers = array('Html', 'Form', 'Session', 'GoogleMap');
	public $components = array('Paginator', 'Session');

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
				
				//ジオコード変換//////////////////////////////
				//Google Maps APIジオコーディング読み込み
				$api_url = 'http://maps.googleapis.com/maps/api/geocode/xml?address='. urlencode($this->request->data['Shop']['street_address']). '&sensor=false';
				
				//ジオコード結果をxmlへ格納
				$xml = simplexml_load_file($api_url);
				
				$code = $xml->status;
				
				//扱いやすいように変数へ代入
				$lat = $xml->result->geometry->location->lat;
				$lng = $xml->result->geometry->location->lng;
				
				//緯度経度保存
				$data_lng = array('Shop' => array('id' => $this->Shop->id, 'longitude' => $lng));
				$fields_lng = array('longitude');
				$this->Shop->save($data_lng, false, $fields_lng);
				$data_lat = array('Shop' => array('id' => $this->Shop->id, 'latitude' => $lat));
				$fields_lat = array('latitude');
				$this->Shop->save($data_lat, false, $fields_lat);
				
				
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
				$this->Session->setFlash(__('Succeeded to add your post.'));
				return $this->redirect(array('action' => 'createmap'));

			}
			$this->Session->setFlash(__('Unable to add your post.'));
		}
	}

	//createmapから戻ってきて直すときの処理
	public function edit($id=null, $width = null, $height = null) {
		$this->set('id', $id);
		$shop = $this->Shop->findById($id);
		$this->set('shop', $shop);

		$this->set('width', $width);
		$this->set('height', $height);

		if ($this->request->is('post')) {

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
				$this->Session->write('last_id', $id);

				//マップ新規作成画面へ
				$this->Session->setFlash(__('Succeeded to add your post.'));
				return $this->redirect(array('action' => 'createmap'));

			}
			$this->Session->setFlash(__('Unable to add your post.'));
		}else {
			//createから修正ボタンできた場合、フォームに今までの情報を初期値としてセット
			$this->request->data;
			$this->Shop->read();
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

	public function search() {
		     //リクエストがPOSTメソッドで送られてきた場合
		if($this->request->is('post')) {
				//formのパラメータ取得
			$SearchShopname = $this->request->data('shopname');
			$SearchPrefecture = $this->request->data('prefecture');
			$SearchAddress = $this->request->data('address');
			$SearchCategory = $this->request->data('category');

			//ページネーションのセッティング内容
			$params = array(
				'limit' => 10, //1ページあたりの表示件数
				'maxLimit' => 10, //最大表示件数
				//検索条件
				'conditions' => array(
					//and検索をする
					'and' => array(
						'Shop.name LIKE' => '%' . $SearchShopname . '%', //店名
						'Shop.prefecture LIKE' => '%' . $SearchPrefecture . '%', //都道府県 
						'Shop.street_address LIKE' => '%' . $SearchAddress . '%', //区市町村以下
						'Shop.category LIKE' => '%' . $SearchCategory . '%') //カテゴリ
					)
				);

			//　ページ切り替え時に検索条件を保持するようパラメータをセッション変数に保存
			$this->Session->write('params', $params);

		}else{
			// セッション変数の展開
			if($this->Session->check('params')) {
				$params = $this->Session->read('params');
			}
		}

		$this->Paginator->settings = $params;
		$data = $this->paginate();
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
		//$path = DS. 'ShopAreaWiki'. DS .'app'. DS . constant('WEBROOT_DIR') . '/img/shop_images';//手元の
		$path = DS . constant('WEBROOT_DIR') . DS .'img' . DS . 'shop_images';//手元の
		$this->set('path', $path);

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


		/*
		//ここからブロック情報受け取り テスト
		$blockpos = $this->request->data('Blocks.pos');
		$blockname = $this->request->data('Blocks.name');
		$blockcolor = $this->request->data('Blocks.color');

		App::import("Controller", "Blocks");
		$BlocksController = new BlocksController;
		$post = $BlocksController->saveBlocks($this->request->data('Shop.id'), $blockpos, $blockname, $blockcolor); 
 
		$BlocksController->getBlocks(); 
		*/


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
