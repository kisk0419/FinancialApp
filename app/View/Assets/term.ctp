<h2><?php echo $family_name ?>家 <?php echo $year . '年' . $month . '月期'?> 貯蓄</h2>

<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                    array('日付', 'カテゴリ１', 'カテゴリ２', '金額', '貯蓄先', 'メモ', '入力者', 'アクション', '', '')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td><?php echo h($data['date']) ?></td>
            <td><?php echo h($data['category_1']) ?></td>
            <td><?php echo h($data['category_2']) ?></td>
            <td><?php echo h($data['amount']) ?></td>
            <td><?php echo h($data['bank']) ?></td>
            <td><?php echo h($data['memo']) ?></td>
            <td><?php echo h($data['user']) ?></td>
            <td><?php echo $this->Html->link('参照', '/Assets/show/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('編集', '/Assets/edit/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('削除', '/Assets/delete/' . $data['id'], array(), '削除してもよろしいですか？'); ?></td>
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
    <?php echo $this->Html->link('入金', '/Assets/add?year=' . $year . '&month=' . $month); ?>
    <?php echo $this->Html->link('出金', '/Assets/draw?year=' . $year . '&month=' . $month); ?>
</div>
<div>
    <?php echo $this->Html->link('戻る', $referer); ?>
</div>