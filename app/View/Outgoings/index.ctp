<div id="summary_list">
    <div class="col_1">合計</div>
    <?php echo $this->Utility->currencyTag($datas['summary'], 'div', 'value col_3', '￥'); ?>
    <div class="col_8"></div>
</div>
<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('期', '日付', 'カテゴリ１', 'カテゴリ２', '金額', '種別', 'カード', '店舗', 'メモ', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td class="date"><?php echo $this->Html->link(h($data['term']), 
                    '/Outgoings/term?year=' . $data['year'] . '&month=' . $data['month']); ?></td>
            <td class="date"><?php echo h($data['date']) ?></td>
            <td class="category"><?php echo h($data['category_1']) ?></td>
            <td class="category"><?php echo h($data['category_2']) ?></td>
            <?php echo $this->Utility->currencyTag($data['price'], 'td'); ?>
            <td class="type"><?php echo h($data['type']) ?></td>
            <td class="type">
                <?php
                    if ($data['is_credit']) {
                        echo '○';
                    } else {
                        echo '--';
                    }
                ?>
            </td>
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
</div>