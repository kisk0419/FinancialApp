<div id="summary_list">
    <div class="col_2">目標金額合計</div>
    <?php echo $this->Utility->currencyTag($datas['summary'], 'div', 'value col_3', '￥'); ?>
    <div class="col_6"></div>
    <div class="col_1">
        <?php echo $this->Utility->actionButton('/FundEntries/add', 'icon-plus'); ?>
    </div>
</div>
<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('ID', 'カテゴリ１', 'カテゴリ２', '目標', '完了見込', '目標金額', '積立額', '進捗', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td class="type"><?php echo $this->Html->link(h($data['id']), '/Funds/history/' . $data['id']); ?></td>
            <td class="category"><?php echo h($data['category_1']) ?></td>
            <td class="category"><?php echo h($data['category_2']) ?></td>
            <?php echo $this->Utility->tagetValue($data['fund_entry_mode'], $data['target_value'], 'td', ''); ?>
            <td class="type">
                <?php 
                    echo h($this->Fund->getEndTerm(
                            $data['fund_entry_mode'], 
                            $data['start_year'], 
                            $data['start_month'], 
                            $data['target_value'], 
                            $data['amount'], 
                            $data['summary'], 
                            $data['count'])) 
                ?>
            </td>
            <?php echo $this->Utility->currencyTag($data['amount'], 'td'); ?>
            <?php echo $this->Utility->currencyTag($data['summary'], 'td'); ?>
            <td class="type"><?php echo h($this->Fund->getProgressRate($data['is_completed'], $data['is_settled'], $data['summary'], $data['amount'])) ?></td>
            <td class="action3">
                <?php 
                    echo $this->Utility->actionButton(
                            '/FundEntries/check/' . $data['id'], 'icon-check');
                
                    echo $this->Utility->actionButton(
                            '/FundEntries/edit/' . $data['id'], 'icon-pencil');
                    
                    echo $this->Utility->actionButton(
                            '/FundEntries/delete/' . $data['id'], 'icon-remove', 
                            '', '削除してもよろしいですか？');
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>