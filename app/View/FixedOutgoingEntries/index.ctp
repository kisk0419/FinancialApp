<div id="summary_list">
    <div class="col_1">合計</div>
    <?php echo $this->Utility->currencyTag($datas['summary'], 'div', 'value col_3', '￥'); ?>
    <div class="col_7"></div>
    <div class="col_1">
        <?php echo $this->Utility->actionButton('/FixedOutgoingEntries/add', 'icon-plus'); ?>
    </div>
</div>
<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('カテゴリ１', 'カテゴリ２', '金額', '店舗', 'メモ', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td class="category"><?php echo h($data['category_1']) ?></td>
            <td class="category"><?php echo h($data['category_2']) ?></td>
            <?php echo $this->Utility->currencyTag($data['price'], 'td'); ?>
            <td><div class="memo"><?php echo h($data['store']) ?></div></td>
            <td><div class="memo"><?php echo h($data['memo']) ?></div></td>
            <td class="action3">
                <?php 
                    echo $this->Utility->actionButton(
                            '/FixedOutgoingEntries/show/' . $data['id'], 'icon-search');
                    
                    echo $this->Utility->actionButton(
                            '/FixedOutgoingEntries/edit/' . $data['id'], 'icon-pencil');
                    
                    echo $this->Utility->actionButton(
                            '/FixedOutgoingEntries/delete/' . $data['id'], 'icon-remove', 
                            '', '削除してもよろしいですか？');
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
