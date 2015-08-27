<!-- File: /app/View/Shops/search.ctp -->

<div id="page">
<div id="text1">検索結果</div>
<?php echo $this->Html->image('ww.jpg', array('alt' => 'Shop Area Wiki', 'width'=>'192','height'=>'31')); ?>

<div id="biaogepage">

<table border="1" id="talbestyle">
<tr>
<?php foreach ($fields as $key => $field): ?>
    <th><?php echo $fields[$key]; ?></th>
<?php endforeach; ?>
<?php unset($field); ?>
</tr>

<?php foreach ($result as $key1 => $value): ?>
    <tr>
    <?php foreach ($fields as $key2 => $field): ?>
       <td class="biaoti1" width="40%"><?php echo $result[$key1]['Shop'][$fields[$key2]]; ?></td>
    <?php endforeach; ?>
    <?php unset($field); ?>
    </tr>
<?php endforeach; ?>
<?php unset($value); ?>
</table>

</div>

<!-- フォームと送信ボタン -->
<form action="/cakephp-astms/shops/search" method="POST">
    <div class="submit">
        <input type="submit" value="新規作成" />
    </div>
</form>
</div>