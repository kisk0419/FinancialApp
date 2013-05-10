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
                <td><?php echo h($data['Asset']['term']); ?></td>
            </tr>
            <tr>
                <td>日付</td>
                <td><?php echo h($data['Asset']['date']) ?></td>
            </tr>
            <tr>
                <td>カテゴリ１</td>
                <td><?php echo h($data['AssetPrimaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>カテゴリ２</td>
                <td><?php echo h($data['AssetSecondaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>金額</td>
                <td><?php echo h($data['Asset']['amount']) ?></td>
            </tr>
            <tr>
                <td>貯蓄先</td>
                <td><?php echo h($data['Bank']['name']) ?></td>
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