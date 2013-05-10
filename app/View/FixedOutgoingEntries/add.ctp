<div>
<?php 
    echo $this->Form->create('FixedOutgoingEntry', array('type' => 'post'));
    
    echo $this->Form->input('FixedOutgoingEntry.outgoing_primary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー１'
                ),
                'options' => $category_primary
            )
        );
     
    echo $this->Form->input('FixedOutgoingEntry.outgoing_secondary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー２'
                ),
                'options' => $category_secondary
            )
        );
     
    echo $this->Form->input('FixedOutgoingEntry.unit_price', 
            array(
                'label' => array(
                        'text' => '単価'
                ),
            )
        );
     
    echo $this->Form->input('FixedOutgoingEntry.quantity', 
            array(
                'label' => array(
                        'text' => '数量'
                ),
            )
        );
     
    echo $this->Form->input('FixedOutgoingEntry.store_id', 
            array(
                'label' => array(
                        'text' => '店舗'
                ),
                'options' => $store
            )
        );
     
    echo $this->Form->input('FixedOutgoingEntry.memo', 
            array(
                'label' => array(
                        'text' => 'メモ'
                ),
            )
        );
    
    echo $this->Form->input('FixedOutgoingEntry.is_active', 
            array(
                'label' => array(
                        'text' => '状態'
                ),
            )
        );
    
    echo $this->Form->input('FixedOutgoingEntry.referer', 
            array(
                'type' => 'hidden',
                'value' => $referer
            )
        );
     
    echo $this->Form->end('追加'); 
?>
</div>