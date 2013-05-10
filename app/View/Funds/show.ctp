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
                <td><?php echo h($data['Fund']['term']); ?></td>
            </tr>
            <tr>
                <td>日付</td>
                <td><?php echo h($data['Fund']['date']) ?></td>
            </tr>
            <tr>
                <td>カテゴリ１</td>
                <td><?php echo h($data['FundEntry']['FundPrimaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>カテゴリ２</td>
                <td><?php echo h($data['FundEntry']['FundSecondaryCategory']['name']) ?></td>
            </tr>
            <tr>
                <td>金額</td>
                <td><?php echo h($data['Fund']['amount']) ?></td>
            </tr>
            <tr>
                <td>エントリーID</td>
                <td><?php echo h($data['FundEntry']['id']) ?></td>
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