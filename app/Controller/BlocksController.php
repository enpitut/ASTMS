<?php
class BlocksController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
    	// echo print_r($this->Block->find('all'));
    }

}
?>