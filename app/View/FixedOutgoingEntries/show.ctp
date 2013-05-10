<div>
    <table>
        <thead>
    <?php  
        echo $this->Html->tableHeaders(array('項目', '値'));
    ?>
        </thead>
        <tbody>
            <tr>
                <td>カテゴリ１</td>
                <td><?php echo h($data['OutgoingPrimaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>カテゴリ２</td>
                <td><?php echo h($data['OutgoingSecondaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>単価</td>
                <td><?php echo h($data['FixedOutgoingEntry']['unit_price']) ?></td>
            </tr>
            <tr>
                <td>数量</td>
                <td><?php echo h($data['FixedOutgoingEntry']['quantity']) ?></td>
            </tr>
            <tr>
                <td>金額</td>
                <td><?php echo h($data['FixedOutgoingEntry']['unit_price'] * $data['FixedOutgoingEntry']['quantity']) ?></td>
            </tr>
            <tr>
                <td>店舗</td>
                <td><?php echo h($data['Store']['name']) ?></td>
            </tr>
            <tr>
                <td>メモ</td>
                <td><?php echo h($data['FixedOutgoingEntry']['memo']) ?></td>
            </tr>
            <tr>
                <td>入力者</td>
                <td><?php echo h($data['User']['name']) ?></td>
            </tr>
            <tr>
                <td>状態</td>
                <td><?php echo h($data['FixedOutgoingEntry']['is_active'] ? '有効' : '無効') ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <?php echo $this->Html->link('戻る', $referer); ?>
</div>