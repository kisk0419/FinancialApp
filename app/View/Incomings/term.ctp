<h6><?php echo $family_name ?>家 <?php echo $year . '年' . $month . '月期'?> 収入</h6>

<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('日付', 'カテゴリ１', 'カテゴリ２', '金額', 'メモ', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td class="date"><?php echo h($data['date']) ?></td>
            <td class="category"><?php echo h($data['category_1']) ?></td>
            <td class="category"><?php echo h($data['category_2']) ?></td>
            <?php echo $this->Utility->currencyTag($data['amount'], 'td'); ?>
            <td><div class="memo"><?php echo h($data['memo']) ?></div></td>
            <td class="action3">
                <?php 
                    echo $this->Utility->actionButton(
                            '/Incomings/show/' . $data['id'], 'icon-search');
                    
                    echo $this->Utility->actionButton(
                            '/Incomings/edit/' . $data['id'], 'icon-pencil');
                    
                    echo $this->Utility->actionButton(
                            '/Incomings/delete/' . $data['id'], 'icon-remove', 
                            '', '削除してもよろしいですか？');
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<table id="summary_list">
    <tr>
        <th>合計</th>
        <?php echo $this->Utility->currencyTag($datas['summary'], 'td', 'value', '￥'); ?>
    </tr>
</table>
</div>
<div>
    <?php echo $this->Html->link('新規追加', '/Incomings/add?year=' . $year . '&month=' . $month); ?>
</div>
<div>
    <?php echo $this->Html->link('戻る', $referer); ?>
</div>