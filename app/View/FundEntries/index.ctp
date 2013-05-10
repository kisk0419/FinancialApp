<h2><?php echo $family_name ?>家 積立</h2>

<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('エントリーID', 'カテゴリ１', 'カテゴリ２', '目標種別', '目標値', '開始期', '完了見込', '予定額', '実績額', '残額', 'メモ', '進捗', '状態', '入力者', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td><?php echo $this->Html->link(h($data['id']), '/Funds/history/' . $data['id']); ?></td>
            <td><?php echo h($data['category_1']) ?></td>
            <td><?php echo h($data['category_2']) ?></td>
            <td><?php echo h($data['fund_entry_mode']) ?></td>
            <td><?php echo h($data['target_value']) ?></td>
            <td><?php echo h($data['start_term']) ?></td>
            <td>
                <?php 
                    echo h($this->Fund->getEndTerm(
                            $data['fund_entry_mode_id'], 
                            $data['start_year'], 
                            $data['start_month'], 
                            $data['target_value'], 
                            $data['amount'], 
                            $data['summary'], 
                            $data['count'])) 
                ?>
            </td>
            <td><?php echo h($data['amount']) ?></td>
            <td><?php echo h($data['summary']) ?></td>
            <td><?php echo h($data['amount'] - $data['summary']) ?></td>
            <td><?php echo h($data['memo']) ?></td>
            <td><?php echo h($this->Fund->getProgressRate($data['is_completed'], $data['summary'], $data['amount'])) ?></td>
            <td><?php echo h($data['is_active'] ? '有効' : '無効') ?></td>
            <td><?php echo h($data['user']) ?></td>
            <td><?php echo $this->Html->link('完了', '/FundEntries/complete/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('参照', '/FundEntries/show/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('編集', '/FundEntries/edit/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('削除', '/FundEntries/delete/' . $data['id'], array(), '削除してもよろしいですか？'); ?></td>
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
    <?php echo $this->Html->link('新規追加', '/FundEntries/add'); ?>
</div>