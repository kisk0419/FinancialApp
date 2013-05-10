<div id="summary_list">
    <div class="col_1">合計</div>
    <?php echo $this->Utility->currencyTag($datas['summary'], 'div', 'value col_3', '￥'); ?>
    <div class="col_7"></div>
    <div class="col_1">
        <?php echo $this->Utility->actionButton('/FundEntries/regist?year=' . $year . '&month=' . $month, 'icon-repeat'); ?>
        <?php echo $this->Utility->actionButton('/FundEntries/index', 'icon-book'); ?>
    </div>
</div>
<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('日付', 'カテゴリ１', 'カテゴリ２', '金額', 'エントリーID', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td class="date">
                <?php 
                    echo $this->Html->link(h($data['date']), $this->Utility->termUrl('Funds', $year, $month, $data['date'])); 
                ?>
            </td>
            <td class="category"><?php echo h($data['category_1']) ?></td>
            <td class="category"><?php echo h($data['category_2']) ?></td>
            <?php echo $this->Utility->currencyTag($data['amount'], 'td'); ?>
            <td class="type">
                <?php 
                    echo $this->Html->link(h($data['entry']), '/FundEntries/show/' . $data['entry']); 
                ?>
            </td>
            <td class="action3">
                <?php 
                    echo $this->Utility->actionButton(
                            '/Funds/show/' . $data['id'], 'icon-search');
                    
                    echo $this->Utility->actionButton(
                            '/Funds/edit/' . $data['id'], 'icon-pencil');
                    
                    echo $this->Utility->actionButton(
                            '/Funds/delete/' . $data['id'], 'icon-remove', 
                            '', '削除してもよろしいですか？');
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<div>
    <?php echo $this->Html->link('戻る', $referer); ?>
</div>