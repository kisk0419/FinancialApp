<h2>設定一覧</h2>

<div>
<table>
    <thead>
        <?php echo $this->Html->tableHeaders(
                array('ID', '家族名', '期開始日', 'アクション')); ?>
    </thead>
    <tbody>
    <?php foreach ($datas as $data): ?>
        <tr>
            <td><?php echo h($data['Setting']['id']) ?></td>
            <td><?php echo h($data['Family']['name']) ?></td>
            <td><?php echo h($data['TermStartCondition']['text'] . ' ' . $data['Setting']['term_start_date']) ?>日</td>
            <td><?php echo $this->Html->link('編集', '/Settings/edit/' . $data['Setting']['id']); ?></td>
            <td><?php echo $this->Html->link('削除', '/Settings/delete/' . $data['Setting']['id'], array(), '削除してもよろしいですか？'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<div>
    <?php echo $this->Html->link('新規追加', '/Settings/add'); ?>
</div>