<?php
/**
 * /app/Controller/HelloController.php
 */
class HelloController extends AppController
{
    /** ビュー未使用 */
    public $autoRender = false;
    
    /**
     * indexアクション
     */
    public function index() {
        echo "Hello World!";
    }
}