<div>
<?php 
    echo $this->Form->create('Setting', array('type' => 'post'));
    echo $this->Form->input('Setting.id', 
            array(
                'type' => 'hidden',
            )
        );
    
    echo $this->Form->input('Setting.term_start_condition_id', 
            array(
                'label' => array(
                    'text' => '条件'
                ),
                'options' => $conditions
            )
        );
    
    echo $this->Form->input('Setting.term_start_date', 
            array(
                'label' => array(
                    'text' => '開始日'
                ),
            )
        );
    
    echo $this->Form->input('info.referer', 
            array(
                'type' => 'hidden',
                'value' => $referer
            )
        );
     
     echo $this->Form->end('更新'); 
?>
</div>