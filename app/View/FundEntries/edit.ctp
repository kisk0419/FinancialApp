<div>
<?php 
    echo $this->Form->create('FundEntry', array('type' => 'post'));
    echo $this->Form->input('FundEntry.id', 
            array(
                'type' => 'hidden'
            )
        );
    
    echo $this->Form->input('FundEntry.fund_primary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー１'
                ),
                'options' => $category_primary
            )
        );
     
    echo $this->Form->input('FundEntry.fund_secondary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー２'
                ),
                'options' => $category_secondary
            )
        );
     
    echo $this->Form->input('FundEntry.start_year', 
            array(
                'label' => array(
                        'text' => '開始年'
                ),
            )
        );
     
   echo $this->Form->input('FundEntry.start_month', 
            array(
                'label' => array(
                        'text' => '開始月'
                ),
            )
        );
     
    echo $this->Form->input('FundEntry.fund_entry_mode_id', 
            array(
                'label' => array(
                        'text' => '目標種別'
                ),
                'options' => $modes,
            )
        );
     
    echo $this->Form->input('FundEntry.target_value', 
            array(
                'label' => array(
                        'text' => '目標値'
                ),
            )
        );
    
    echo $this->Form->input('FundEntry.amount', 
            array(
                'label' => array(
                        'text' => '金額'
                ),
            )
        );
    
    echo $this->Form->input('FundEntry.memo', 
            array(
                'label' => array(
                        'text' => 'メモ'
                ),
            )
        );
    
    echo $this->Form->input('FundEntry.is_completed', 
            array(
                'label' => array(
                        'text' => '進捗'
                ),
            )
        );
    
    echo $this->Form->input('FundEntry.is_active', 
            array(
                'label' => array(
                        'text' => '状態'
                ),
            )
        );
    
    echo $this->Form->input('FundEntry.referer', 
            array(
                'type' => 'hidden',
                'value' => $referer
            )
        );
     
    echo $this->Form->end('更新'); 
?>
</div>