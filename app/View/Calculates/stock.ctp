<?php 
    $asset_total = $asset_data->totalPrice();
    $fund_total = $fund_detail['fund']['summary']['current'][0];
?>
<div>
    
</div>
<div>
    <h2>総貯蓄額: ￥<?php echo h(number_format($asset_total + $fund_total)) ?></h2>
</div>
<div>
    <h3>積立: ￥<?php echo h(number_format($fund_total)) ?> (￥<?php echo h(number_format($fund_detail['fund']['summary']['total'][0])) ?>)</h3>
    <table>
        <thead>
            <?php echo $this->Html->tableHeaders(array('積立中','積立完了', '清算済み')); ?>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php 
                        echo $fund_detail['fund']['details']['processing'][0] . ' / ' .  $fund_detail['fund']['details']['processing'][1];
                    ?>
                </td>
                <td>
                    <?php 
                        echo $fund_detail['fund']['details']['completed'][0] . ' / ' .  $fund_detail['fund']['details']['completed'][1];
                    ?>
                </td>
                <td>
                    <?php 
                        echo $fund_detail['fund']['details']['settled'][0] . ' / ' .  $fund_detail['fund']['details']['settled'][1];
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <h3>貯蓄: ￥<?php echo h(number_format($asset_total)) ?></h3>
    <?php 
        foreach ($asset_data as $category_1 => $asset) {
            echo $this->element('summary', array(
                'category_1' => $category_1,
                'data' => $asset));
        } 
    ?>
</div>
<div>
    <table>
        <thead>
            <?php echo $this->Html->tableHeaders(array('期', '入金額', '出金額', '貯蓄額')); ?>
        </thead>
        <tbody>
            <?php echo $this->Html->tableCells($asset_detail['asset']['details']); ?>
            <?php echo $this->Html->tableCells($asset_detail['asset']['summary']); ?>
        </tbody>
    </table>
</div>