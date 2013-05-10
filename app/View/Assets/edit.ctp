<div>
<?php 
    echo $this->Form->create('Asset', array('type' => 'post'));
    echo $this->Form->input('Asset.id', 
            array(
                'type' => 'hidden'
            )
        );
    
    echo $this->Form->input('Asset.date', 
            array(
                'label' => array(
                    'text' => '日付'
                ),
            )
        );
    
     echo $this->Form->input('Asset.asset_primary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー１'
                ),
                'options' => $category_primary
            )
        );
     
     echo $this->Form->input('Asset.asset_secondary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー２'
                ),
                'options' => $category_secondary
            )
        );
     
     echo $this->Form->input('Asset.amount', 
            array(
                'label' => array(
                        'text' => '金額'
                ),
            )
        );
     
     echo $this->Form->input('Asset.bank_id', 
            array(
                'label' => array(
                        'text' => '貯蓄先'
                ),
                'options' => $bank
            )
        );
     
     echo $this->Form->input('Asset.memo',
            array(
                'label' => array(
                    'text' => 'メモ'
                )
            )
        );
     
     echo $this->Form->input('Asset.is_draw',
            array(
                'type' => 'hidden',
            )
        );
     
     echo $this->Form->input('Asset.referer', 
            array(
                'type' => 'hidden',
                'value' => $referer
            )
        );
     
     echo $this->Form->end('更新'); 
?>
</div>
