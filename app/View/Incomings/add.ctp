<div>
<?php 
    echo $this->Form->create('Incoming', array('type' => 'post'));
    echo $this->Form->input('Incoming.date', 
            array(
                'label' => array(
                    'text' => '日付'),
                )
            );
    
    echo $this->Form->input('Incoming.year', 
            array(
                'type' => 'hidden',
                'value' => $year,
            )
        );
    
    echo $this->Form->input('Incoming.month', 
            array(
                'type' => 'hidden',
                'value' => $month
            )
        );
    
    echo $this->Form->input('Incoming.incoming_primary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー１'
                ),
                'options' => $category_primary
            )
        );
     
     echo $this->Form->input('Incoming.incoming_secondary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー２'
                ),
                'options' => $category_secondary
            )
        );
     
     echo $this->Form->input('Incoming.amount', 
            array(
                'label' => array(
                        'text' => '金額'
                ),
            )
        );
     
     echo $this->Form->input('Incoming.company_id', 
            array(
                'label' => array(
                        'text' => '収入元'
                ),
                'options' => $company
            )
        );
     
     echo $this->Form->input('Incoming.memo', 
            array(
                'label' => array(
                        'text' => 'メモ'
                ),
            )
        );
     
     echo $this->Form->input('Incoming.referer', 
            array(
                'type' => 'hidden',
                'value' => $referer
            )
        );
     
     echo $this->Form->end('追加'); 
?>
</div>