<?php
class FloorsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
        echo print_r($this->Floor->find('all'));
    }

    public function view($shop_id = null){
        if(!$shop_id){
            throw new NotFoundException(__('Invalid post'));
        }

        echo print_r($this->Floor->findByShop_id(2));
    }
}
?>