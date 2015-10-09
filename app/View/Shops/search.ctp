<!-- File: /app/View/Shops/search.ctp -->
<?php $this->autoLayout = false; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="ja"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap の本体のCSSを読み込む -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- 自作のCSSを読み込む -->
    <?php echo $this->Html->css('search_result');?>
    <title>ShopAreaWiki</title>
</head>

<body>
    <!-- ヘッダーっぽいもの -->
    <div class="row header">
        <div class="col-md-3">
            <!-- 画像 -->
            <a href="http://localhost/ShopAreaWiki/shops/">
            <?php echo $this->Html->image('logo.png', array('alt' => 'Shop Area Wiki','class' => 'logo')); ?>
            </a>
        </div>
        <div class="col-md-8 search_div">
            <!-- 検索フォーム -->
            <form  action="http://localhost/ShopAreaWiki/shops/search" method="POST">
                <div class="input-group">
                    <input type="text" name="txt" class="form-control search_box" placeholder="店名">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-1">
            <?php echo $this->Html->link("新規", array('controller' => 'Shops', 'action' => 'add')); ?>
        </div>
  </div>



  <?php foreach ($result as $shop): ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 search_row_name">
            <?php echo $this->Html->link($shop['Shop']['name'], array('controller' => 'Shops', 'action' => 'view', $shop['Shop']['id'])); ?>
        </div>
    </div>
    <div class="row search_row_address">
        <div class="col-md-10 col-md-offset-1">
            <?php echo '〒'."{$shop['Shop']['postal_code']}"." {$shop['Shop']['prefecture']} "."{$shop['Shop']['street_address']}"; ?>
        </div>
    </div>
    <div class="row search_row_category">
        <div class="col-md-1 col-md-offset-1">
            カテゴリー:
        </div>
        <div class="col-md-9">
            <?php echo $shop['Shop']['category']; ?>
        </div>
    </div>
    <div class="row search_row_category">
        <div class="col-md-1 col-md-offset-1">
            コメント:
        </div>
        <div class="col-md-9">
            <?php echo $shop['Shop']['comment']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 search_row_footer">
        </div>
    </div>
<?php endforeach; ?>

</body>
</html>