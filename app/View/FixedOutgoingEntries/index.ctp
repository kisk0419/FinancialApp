<h2><?php echo $family_name ?>家 固定費</h2>

<div>
<table>
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('カテゴリ１', 'カテゴリ２', '単価', '数量', '金額', '店舗', 'メモ', '状態', '入力者', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas['details'] as $data): ?>
        <tr>
            <td><?php echo h($data['category_1']) ?></td>
            <td><?php echo h($data['category_2']) ?></td>
            <td><?php echo h($data['unit_price']) ?></td>
            <td><?php echo h($data['quantity']) ?></td>
            <td><?php echo h($data['price']) ?></td>
            <td><?php echo h($data['store']) ?></td>
            <td><?php echo h($data['memo']) ?></td>
            <td><?php echo h($data['user']) ?></td>
            <td><?php echo h($data['is_active'] ? '有効' : '無効') ?></td>
            <td><?php echo $this->Html->link('参照', '/FixedOutgoingEntries/show/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('編集', '/FixedOutgoingEntries/edit/' . $data['id']); ?></td>
            <td><?php echo $this->Html->link('削除', '/FixedOutgoingEntries/delete/' . $data['id'], array(), '削除してもよろしいですか？'); ?></td>
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
    <?php echo $this->Html->link('新規追加', '/FixedOutgoingEntries/add'); ?>
</div>