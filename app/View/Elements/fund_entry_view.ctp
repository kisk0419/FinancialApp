
<table>
    <thead>
<?php  
    echo $this->Html->tableHeaders(array('項目', '値'));
?>
    </thead>
    <tbody>
        <tr>
            <td>カテゴリ１</td>
            <td><?php echo h($data['FundPrimaryCategory']['name']) ?></td>
        </tr>
        <tr>
            <td>カテゴリ２</td>
            <td><?php echo h($data['FundSecondaryCategory']['name']) ?></td>
        </tr>
        <tr>
            <td>目標種別</td>
            <td><?php echo h($data['FundEntryMode']['text']) ?></td>
        </tr>
        <tr>
            <td>目標値</td>
            <td><?php echo h($data['FundEntry']['target_value']) ?></td>
        </tr>
        <tr>
            <td>開始期</td>
            <td><?php echo h($data['FundEntry']['start_year'] . '/' . $data['FundEntry']['start_month']) ?></td>
        </tr>
        <tr>
            <td>完了見込</td>
            <td>
                <?php 
                    echo h($this->Fund->getEndTerm(
                            $data['FundEntryMode']['id'], 
                            $data['FundEntry']['start_year'], 
                            $data['FundEntry']['start_month'], 
                            $data['FundEntry']['target_value'], 
                            $data['FundEntry']['amount'], 
                            $data['FundSummary']['summary'], 
                            $data['FundSummary']['count'])) 
                ?>
            </td>
        </tr>
        <tr>
            <td>予定額</td>
            <td><?php echo h($data['FundEntry']['amount']) ?></td>
        </tr>
        <tr>
            <td>実績</td>
            <td><?php echo h($data['FundSummary']['summary']) ?></td>
        </tr>
        <tr>
            <td>残額</td>
            <td><?php echo h($data['FundEntry']['amount'] - $data['FundSummary']['summary']) ?></td>
        </tr>
        <tr>
            <td>メモ</td>
            <td><?php echo h($data['FundEntry']['memo']) ?></td>
        </tr>
        <tr>
            <td>進捗</td>
            <td>
                <?php 
                    echo h($this->Fund->getProgressRate(
                            $data['FundEntry']['is_completed'], 
                            $data['FundEntry']['is_settled'], 
                            $data['FundSummary']['summary'], 
                            $data['FundEntry']['amount'])) 
                ?>
            </td>
        </tr>
        <tr>
            <td>状態</td>
            <td><?php echo h($data['FundEntry']['is_active'] ? '有効' : '無効') ?></td>
        </tr>
        <tr>
            <td>入力者</td>
            <td><?php echo h($data['User']['name']) ?></td>
        </tr>
    </tbody>
</table>
