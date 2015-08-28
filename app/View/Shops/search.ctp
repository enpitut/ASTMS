<!-- File: /app/View/Shops/search.ctp -->
<?php $this->autoLayout = false; ?>
<?php echo $html->charset("utf-8");?>
<?php  echo $this->Html->css('search_result');?><!-- cakephp/app/css/search.css (元c.css)-->

<div id="page">
    <div id="text1">検索結果</div>
    <?php echo $this->Html->image('ww.jpg', array('alt' => 'Shop Area Wiki', 'width'=>'192','height'=>'31')); ?>

    <div id="biaogepage">
        <!-- カラム名一覧 -->
        <table border="1" class="tablestyle">
        <tr>
            <?php foreach ($fields as $key => $field): ?>
                <th class="biaoti1" width="40%"><?php echo $fields[$key]; ?></th>
            <?php endforeach; ?>
            <?php unset($field); ?>
        </tr>
        

        <!-- 店名検索結果をリストで表示 -->
        <tr>
            <?php foreach ($result as $key1 => $value): ?>
                <?php foreach ($fields as $key2 => $field): ?>
                    <td class="biaogetext">
                        <?php if($fields[$key2]=='name'){//店名の場合
                                    $shopname = $result[$key1]['Shop'][$fields[$key2]];//店名
                                    $id = $result[$key1]['Shop']['id'];//id
                                    echo $this->Html->link($shopname, array('controller' => 'Shops', 'action' => 'view', $id));//リンク貼る
                                    // echo $this->Html->link($shopname, array('controller' => 'Floors', 'action' => 'viewFromSearch', $id));//リンク貼る
                                }
                                else{echo $result[$key1]['Shop'][$fields[$key2]];}//店名以外は普通に表示
                        ?>
                    </td>
                <?php endforeach; ?>
                <?php unset($field); ?>
            </tr>
            <?php endforeach; ?>
            <?php unset($value); ?>
        </table>
    </div>

    <!-- 店内マップ新規作成画面へのボタン -->
    <form action="/cakephp-astms/shops/search" method="POST">
        <div id="tbutton">
            <input type="submit" value="新規作成" />
        </div>
    </form>

</div>