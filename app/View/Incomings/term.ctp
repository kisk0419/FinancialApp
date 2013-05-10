<div id="summary_list">
    <div class="col_1">合計</div>
    <?php echo $this->Utility->currencyTag($datas['summary'], 'div', 'value col_3', '￥'); ?>
    <div class="col_7"></div>
    <div class="col_1">
        <?php echo $this->Utility->actionButton('/Incomings/add?year=' . $year . '&month=' . $month, 'icon-plus', ''); ?>
    </div>
</div>
<div>
    <table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
        <thead>
            <?php echo $this->Html->tableHeaders(
                    array('日付', 'カテゴリ１', 'カテゴリ２', '金額', 'メモ', 'アクション')); ?>
        </thead>
        <tbody>
        <?php foreach ($datas['details'] as $data): ?>
            <tr>
                <td class="date">
                    <?php 
                        echo $this->Html->link(h($data['date']), $this->Utility->termUrl('Incomings', $year, $month, $data['date'])); 
                    ?>
                </td>
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
</div>
<div>
    <?php echo $this->Html->link('戻る', $referer); ?>
</div>