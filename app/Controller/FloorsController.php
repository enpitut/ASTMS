<?php
class FloorsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
        echo print_r($this->Floor->find('all'));
    }

    public function viewFromSearch($shop_id = null){
        if(!$shop_id){
            throw new NotFoundException(__('Invalid post'));
        }
        //今はいちいちモデルをロードしている、後で賢いやり方に修正する
        //今はfindAllByShop_idを使っていない
        //今は階層ひとつのみと仮定している
        $value = $this->Floor->findByShop_id($shop_id);
        $shop = $value['Shop'];
        $floor = $value['Floor'];
        $blocks = $value['Block'];

        //ブロックをx座標でソート
        for ($i=0; $i < count($blocks)-1; $i++) {
            for ($j=count($blocks)-1; $j > $i; $j--) {
                if($blocks[$j]['x-coordinate'] < $blocks[$j-1]['x-coordinate']){
                    $tmp = $blocks[$j];
                    $blocks[$j] = $blocks[$j-1];
                    $blocks[$j-1] = $tmp;
                }
            }
        }

        //ブロックをy座標でソート
        for ($i=0; $i < count($blocks)-1; $i++) {
            for ($j=count($blocks)-1; $j > $i; $j--) {
                if($blocks[$j]['y-coordinate'] < $blocks[$j-1]['y-coordinate']){
                    $tmp = $blocks[$j];
                    $blocks[$j] = $blocks[$j-1];
                    $blocks[$j-1] = $tmp;
                }
            }
        }

        $this->set('shop', $shop);
        $this->set('floor', $shop);
        $this->set('blocks', $blocks);

        // print_r($blocks);
    }
}
?>