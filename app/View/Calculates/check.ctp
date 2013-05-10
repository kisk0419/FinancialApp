<script>
$(function(){
    $('#tile_summary .linked_tile').click(
        function() {
           window.location=$(this).find("a").attr("href");
           return false;
        }
    );
});
    
</script>
<div id="tile_summary">
    <div class="linked_tile col_2">
        <p><?php echo $this->Html->link('収入', '/Incomings/term?year=' . $year . '&month=' . $month); ?></p>
        <?php echo $this->Utility->currencyTag($incoming_data, 'p', 'price', '￥'); ?>
    </div>
    <div class="linked_tile col_2">
        <p><?php echo $this->Html->link('支出', '/Outgoings/term?year=' . $year . '&month=' . $month); ?></p>
        <?php echo $this->Utility->currencyTag($outgoing_data['total'], 'p', 'price', '￥'); ?>
        <?php echo $this->Utility->currencyTag($outgoing_data['fixed'], 'p', 'sub_price', '(固定費: ￥', ')'); ?>
    </div>
    <div class="linked_tile col_2">
        <p><?php echo $this->Html->link('貯蓄', '/Assets/term?year=' . $year . '&month=' . $month); ?></p>
        <?php echo $this->Utility->currencyTag($asset_data, 'p', 'price', '￥'); ?>
    </div>
    <div class="linked_tile col_2">
        <p><?php echo $this->Html->link('積み立て', '/Funds/term?year=' . $year . '&month=' . $month); ?></p>
        <?php echo $this->Utility->currencyTag($fund_data, 'p', 'price', '￥'); ?>
    </div>
    <div class="fixed_tile col_2">
        <p>生活費予算</p>
        <?php echo $this->Utility->currencyTag($budget['budget'], 'p', 'price', '￥'); ?>
    </div>
    <div class="fixed_tile col_2">
        <p>残金</p>
        <?php echo $this->Utility->currencyTag($budget['remain'], 'p', 'price', '￥'); ?>
    </div>
</div>
<hr class="alt1" />
<div>
    <table id="detail_list" cellspacing="0" cellpadding="0" class="striped tight">
        <thead>
            <?php echo $this->Html->tableHeaders(array('日付', '支出', '日割予算', '差額', '評価', 'アクション')); ?>
        </thead>
        <tbody>
            <?php foreach ($daily_account['detail'] as $id => $detail) : ?>
            <tr>
                <td class="date"><?php echo $this->Html->link(h($detail[0]), '/Outgoings/term?year=' . $year . '&month=' . $month . '&date=' . h($detail[0])); ?></td>
                <?php echo $this->Utility->currencyTag($detail[1], 'td'); ?>
                <?php echo $this->Utility->currencyTag($detail[2], 'td'); ?>
                <?php echo $this->Utility->currencyTag($detail[3], 'td'); ?>
                <?php echo $this->Utility->evaluateTag($detail[4], 'td', '', $id, 20); ?>
                <td class="action">
                    <?php 
                        echo $this->Utility->actionButton(
                            '/Outgoings/add?year=' . $year . '&month=' . $month . '&date=' . h($detail[0]), 
                            'icon-plus'); 
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr class="summary">
                <td class="date"><?php echo $this->Utility->h($daily_account['summary'][0]); ?></td>
                <?php echo $this->Utility->currencyTag($daily_account['summary'][1], 'td', '', '￥'); ?>
                <?php echo $this->Utility->currencyTag($daily_account['summary'][2], 'td', '', '￥'); ?>
                <?php echo $this->Utility->currencyTag($daily_account['summary'][3], 'td', '', '￥'); ?>
                <?php echo $this->Utility->evaluateTag($daily_account['summary'][4], 'td', '', 'summaryId', 20); ?>
                <td class="action"></td>
            </tr>
        </tbody>
    </table>
</div>