<div class="col_12">
    <?php echo $this->element('fund_entry_view', array('data' => $data)); ?>
</div>
<div>
    <?php 
        if ($data['FundEntry']['is_completed']) {
            $complete_text = '積立中に戻す';
            $complete_color = 'red';
        } else {
            $complete_text = '積立完了';
            $complete_color = 'green';
        }
        
        if ($data['FundEntry']['is_settled']) {
            $settle_text =  '未精算に戻す';
            $settle_color = 'red';
        } else {
            $settle_text = '清算';
            $settle_color = 'green';
        }
    ?>
    <div class="col_4">
        <?php echo $this->Utility->confirmButton(
                '/FundEntries/complete/' . $data['FundEntry']['id'], 
                '',
                $complete_text,
                'medium',
                $complete_color
            ); 
        ?>
        <?php echo $this->Utility->confirmButton(
                '/FundEntries/settle/' . $data['FundEntry']['id'], 
                '',
                $settle_text,
                'medium',
                $settle_color
            ); 
        ?>
        <?php echo $this->Utility->confirmButton(
                $referer, 
                '',
                '戻る',
                'medium'
            ); 
        ?>
    </div>
    <div class="col_8"></div>
</div>