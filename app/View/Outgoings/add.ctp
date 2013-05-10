<div>
<?php 
    echo $this->Form->create('Outgoing', array('type' => 'post'));
    echo $this->Form->input('Outgoing.date', 
            array(
                'label' => array(
                    'text' => '日付'
                ),
                'default' => date($date)
            )
        );
    
    echo $this->Form->input('Outgoing.year', 
            array(
                'type' => 'hidden',
                'value' => $year,
            )
        );
    
    echo $this->Form->input('Outgoing.month', 
            array(
                'type' => 'hidden',
                'value' => $month
            )
        );
    
    echo $this->Form->input('Outgoing.outgoing_primary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー１'
                ),
                'options' => $category_primary
            )
        );
     
    echo $this->Form->input('Outgoing.outgoing_secondary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー２'
                ),
                'options' => $category_secondary
            )
        );
     
    echo $this->Form->input('Outgoing.unit_price', 
            array(
                'label' => array(
                        'text' => '単価'
                ),
            )
        );
     
    echo $this->Form->input('Outgoing.quantity', 
            array(
                'label' => array(
                        'text' => '数量'
                ),
            )
        );
     
    echo $this->Form->input('Outgoing.store_id', 
            array(
                'label' => array(
                        'text' => '店舗'
                ),
                'options' => $store
            )
        );
     
    echo $this->Form->input('Outgoing.memo', 
            array(
                'label' => array(
                        'text' => 'メモ'
                ),
            )
        );
     
    echo $this->Form->input('Outgoing.referer', 
            array(
                'type' => 'hidden',
                'value' => $referer
            )
        );
     
    echo $this->Form->end('追加'); 
?>
</div>