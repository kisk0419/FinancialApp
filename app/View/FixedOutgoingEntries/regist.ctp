<?php 
    echo $this->Form->create('FixedOutgoingEntry', array('type' => 'post'));
    
    echo $this->Form->input('FixedOutgoingEntry.year',
            array(
                'type' => 'hidden',
                'value' => $year
            ));
    
    echo $this->Form->input('FixedOutgoingEntry.month',
            array(
                'type' => 'hidden',
                'value' => $month
            ));
    
    foreach ($entries as $i => $entry) {
        echo $this->Form->input('Outgoing.' . $i . '.year',
            array(
                'type' => 'hidden',
                'value' => $year
            )
        );
    
        echo $this->Form->input('Outgoing.' . $i . '.month',
            array(
                'type' => 'hidden',
                'value' => $month
            )
        );
    
        echo $this->Form->input('Outgoing.' . $i . '.date', 
            array(
                'label' => array(
                    'text' => '日付'
                ),
            )
        );
    
        echo $this->Form->input('Outgoing.' . $i . '.outgoing_primary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー１'
                ),
                'options' => $primary_category,
                'selected' => $entry['OutgoingPrimaryCategory']['id'],
            )
        );
     
        echo $this->Form->input('Outgoing.' . $i . '.outgoing_secondary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー２'
                ),
                'options' => $secondary_category,
                'selected' => $entry['OutgoingSecondaryCategory']['id']
            )
        );
    
        echo $this->Form->input('Outgoing.' . $i . '.unit_price', 
            array(
                'label' => array(
                        'text' => '単価'
                ),
                'value' => $entry['FixedOutgoingEntry']['unit_price']
            )
        );
     
        echo $this->Form->input('Outgoing.' . $i . '.quantity', 
            array(
                'label' => array(
                        'text' => '数量'
                ),
                'value' => $entry['FixedOutgoingEntry']['quantity']
            )
        );
     
        echo $this->Form->input('Outgoing.' . $i . '.store_id', 
            array(
                'label' => array(
                        'text' => '店舗'
                ),
                'options' => $store,
            )
        );
     
        echo $this->Form->input('Outgoing.' . $i . '.is_fixed', 
            array(
                'type' => 'hidden',
                'value' => 1,
            )
        );
        
        echo $this->Form->input('Outgoing.' . $i . '.memo', 
            array(
                'label' => array(
                        'text' => 'メモ'
                ),
                'value' => $entry['FixedOutgoingEntry']['memo']
            )
        );
        
        echo $this->Form->input('Outgoing.' . $i . '.family_id', 
            array(
                'type' => 'hidden',
                'value' => $entry['FixedOutgoingEntry']['family_id']
            )
        );
        
        echo $this->Form->input('Outgoing.' . $i . '.user_account', 
            array(
                'type' => 'hidden',
                'value' => $user_account
            )
        );
    }   
     
    echo $this->Form->end('登録');
?>