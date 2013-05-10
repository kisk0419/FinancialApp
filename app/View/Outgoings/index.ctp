<h2><?php echo $family_name ?>家 支出</h2>

<div>
<table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('期', '日付', 'カテゴリ１', 'カテゴリ２', '単価', '数量', '金額', '店舗', 'メモ', '入力者', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td><?php echo $this->Html->link(h($data['term']), 
                    '/Outgoings/term?year=' . $data['year'] . '&month=' . $data['month']); ?></td>
            <td><?php echo h($data['date']) ?></td>
            <td><?php echo h($data['category_1']) ?></td>
            <td><?php echo h($data['category_2']) ?></td>
            <td><?php echo h($data['unit_price']) ?></td>
            <td><?php echo h($data['quantity']) ?></td>
            <td><?php echo h($data['price']) ?></td>
            <td><?php echo h($data['store']) ?></td>
            <td><?php echo h($data['memo']) ?></td>
            <td><?php echo h($data['user']) ?></td>
            <td><?php echo $this->Html->link('参照', '/Outgoings/show/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('編集', '/Outgoings/edit/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('削除', '/Outgoings/delete/' . $data['id'], array(), '削除してもよろしいですか？'); ?></td>
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