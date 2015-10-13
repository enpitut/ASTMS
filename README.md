#ASTMS
##メンバー
* 戸田 敬太
* 宋双宝
* 味岡 孝昇
* 宮城 優里
* 塩畑 博文

##プロダクト
###プロダクト名
Shop Area Wiki

###エレベーターピッチ
[売り場が見つからないこと]を解決したい  
[店に初めて訪れる人]や[売り場がわかる・店の地図共有]ができる  
[Shop Area Wiki]です  
[店内マップ作成・共有]ができ  
[店員に聞くこと]とは違って  
[どこでも使える]

##導入方法
MAMPまたはXAMPPを使用していることが前提です

1. このリポジトを適当な場所にクローン
	`$ git clone https://github.com/enpitut/WakeUp.git`  
	このディレクトリは Web サーバからアクセスできるようにする必要があります。
	
1. webrootの設定
	1. app/ShopAreaWiki\_webroot ディレクトリ をhtdocsに移動  
		
	1. ShopAreaWiki\_webroot/index.phpの40行目を編集  
		クローンしたディレクトリのパスを記入してください。  
		例えば /Users/hoge/ASTMS の場合は以下のようになります。  
		`define('ROOT', DS.'Users'.DS.'hoge'.DS.'ASTMS');`  

	1. ShopAreaWiki\_webrootのディレクトリ名をShopAreaWikiに変更  
1. データベースの作成
	document/design\_specifications/shop\_area\_wiki.sqlを使ってShopAreaWikiのデータベースを作成
	
	
1. app/Config/database.phpの編集  
	データベースの情報を変更

		`public $default = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => 'root',
			'password' => 'hogehoge',
			'database' => 'shop_area_wiki',
			'prefix' => '',
			//'encoding' => 'utf8',
		);
		
		public $test = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => 'user',
			'password' => 'password',
			'database' => 'test_database_name',
			'prefix' => '',
			//'encoding' => 'utf8',
		);`

1. 後はcakePHP 2.x と同じ使い方で使えます
	例えば、localサーバを立ち上げshopの検索画面を表示する場合は、  
	http://localhost/ShopAreaWiki/Shopsに移動してください
