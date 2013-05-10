<div>
    <table>
        <thead>
    <?php  
        echo $this->Html->tableHeaders(array('項目', '値'));
    ?>
        </thead>
        <tbody>
            <tr>
                <td>期</td>
                <td><?php echo h($data['Incoming']['term']); ?></td>
            </tr>
            <tr>
                <td>日付</td>
                <td><?php echo h($data['Incoming']['date']) ?></td>
            </tr>
            <tr>
                <td>カテゴリ１</td>
                <td><?php echo h($data['IncomingPrimaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>カテゴリ２</td>
                <td><?php echo h($data['IncomingSecondaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>金額</td>
                <td><?php echo h($data['Incoming']['amount']) ?></td>
            </tr>
            <tr>
                <td>収入元</td>
                <td><?php echo h($data['Company']['name']) ?></td>
            </tr>
            <tr>
                <td>メモ</td>
                <td><?php echo h($data['Incoming']['memo']) ?></td>
            </tr>
            <tr>
                <td>入力者</td>
                <td><?php echo h($data['User']['name']) ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <?php echo $this->Html->link('戻る', $referer); ?>
</div>