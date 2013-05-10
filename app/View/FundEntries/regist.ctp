<?php 
    echo $this->Form->create('FundEntry', array('type' => 'post'));
    
    echo $this->Form->input('FundEntry.year',
            array(
                'type' => 'hidden',
                'value' => $year
            ));
   
    echo $this->Form->input('FundEntry.month',
            array(
                'type' => 'hidden',
                'value' => $month
            ));
    
    foreach ($entries as $i => $entry) {
        echo $this->Form->input('Fund.' . $i . '.year',
            array(
                'type' => 'hidden',
                'value' => $year
            )
        );
    
        echo $this->Form->input('Fund.' . $i . '.month',
            array(
                'type' => 'hidden',
                'value' => $month
            )
        );
    
        echo $this->Form->input('Fund.' . $i . '.date', 
            array(
                'label' => array(
                    'text' => '日付'
                ),
            )
        );
    
        echo $this->Form->input('Fund.' . $i . '.fund_primary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー１'
                ),
                'options' => $primary_category,
                'selected' => $entry['FundPrimaryCategory']['id'],
            )
        );
     
        echo $this->Form->input('Fund.' . $i . '.fund_secondary_category_id', 
            array(
                'label' => array(
                    'text' => 'カテゴリー２'
                ),
                'options' => $secondary_category,
                'selected' => $entry['FundSecondaryCategory']['id']
            )
        );
    
        $amount = $entry['FundEntry']['amount'];
        $sub = $amount - $entry['FundSummary']['summary'];
        $target = $entry['FundEntry']['target_value'];
        if ($sub <= 0) {
            $amount = 0;
        } else if ($entry['FundEntry']['fund_entry_mode_id'] == 1) {
            $amount = ($target > $sub) ? $sub : $target;
        } else {
            $count = $target - $entry['FundSummary']['count'];
            if ($count > 0) {
                $amount = ceil($sub / $count);
            }
        }
        
        echo $this->Form->input('Fund.' . $i . '.amount', 
            array(
                'label' => array(
                        'text' => '積立金額'
                ),
                'value' => $amount
            )
        );
     
        echo $this->Html->tag('p', $entry['FundEntry']['memo']);
        
        echo $this->Form->input('Fund.' . $i . '.fund_entry_id', 
            array(
                'type' => 'hidden',
                'value' => $entry['FundEntry']['id']
            )
        );
        
        echo $this->Form->input('Fund.' . $i . '.family_id', 
            array(
                'type' => 'hidden',
                'value' => $entry['FundEntry']['family_id']
            )
        );
        
        echo $this->Form->input('Fund.' . $i . '.user_account', 
            array(
                'type' => 'hidden',
                'value' => $user_account
            )
        );
    }   
     
    echo $this->Form->end('登録');
?>