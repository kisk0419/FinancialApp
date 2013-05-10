<h6><?php echo $family_name ?>家  <?php echo $year . '年' . $month . '月期'?> 支出</h6>

<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('日付', 'カテゴリ１', 'カテゴリ２', '金額', '店舗', 'メモ', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td class="date"><?php echo h($data['date']) ?></td>
            <td class="category"><?php echo h($data['category_1']) ?></td>
            <td class="category"><?php echo h($data['category_2']) ?></td>
            <?php echo $this->Utility->currencyTag($data['price'], 'td'); ?>
            <td><div class="memo"><?php echo h($data['store']) ?></div></td>
            <td><div class="memo"><?php echo h($data['memo']) ?></div></td>
            <td class="action3">
                <?php 
                    echo $this->Utility->actionButton(
                            '/Outgoings/show/' . $data['id'], 'icon-search');
                    
                    echo $this->Utility->actionButton(
                            '/Outgoings/edit/' . $data['id'], 'icon-pencil');
                    
                    echo $this->Utility->actionButton(
                            '/Outgoings/delete/' . $data['id'], 'icon-remove', 
                            '', '削除してもよろしいですか？');
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<table>
    <tr>
        <th>合計</th>
    </tr>
    <tr>
        <td><?php echo h($datas['summary']); ?></td>
    </tr>
</table>
</div>
<div>
    <?php echo $this->Html->link('新規追加', '/Outgoings/add?year=' . $year . '&month=' . $month); ?>
    <?php echo $this->Html->link('固定費', '/FixedOutgoingEntries/regist?year=' . $year . '&month=' . $month); ?>
</div>
<div>
    <?php echo $this->Html->link('戻る', $referer); ?>
</div>