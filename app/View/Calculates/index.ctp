<?php 
    $incoming_total = $incoming_data->totalPrice();
    $outgoing_total = $outgoing_data->totalPrice();
    $asset_total = $asset_data->totalPrice();
    $fund_total = $fund_data->totalPrice();
?>
<h2>収支: ￥<?php echo h(number_format($incoming_total - ($outgoing_total + $asset_total + $fund_total))) ?></h2>
<div>
    <h3>収入: ￥<?php echo h(number_format($incoming_total)) ?></h3>
    <?php 
        foreach ($incoming_data as $category_1 => $incoming) {
            echo $this->element('summary', array(
                'category_1' => $category_1,
                'data' => $incoming));
        } 
    ?>
</div>
<div>
    <h3>支出: ￥<?php echo h(number_format($outgoing_total)) ?></h3>
    <?php 
        foreach ($outgoing_data as $category_1 => $outgoing) {
            echo $this->element('summary', array(
                'category_1' => $category_1,
                'data' => $outgoing));
        } 
    ?>
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
    <h3>積立: ￥<?php echo h(number_format($fund_total)) ?></h3>
    <?php 
        foreach ($fund_data as $category_1 => $fund) {
            echo $this->element('summary', array(
                'category_1' => $category_1,
                'data' => $fund));
        } 
    ?>
</div>