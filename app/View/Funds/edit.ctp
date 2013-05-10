<div>
<?php 
    echo $this->Form->create('Fund', array('type' => 'post'));
    echo $this->Form->input('Fund.id', 
            array(
                'type' => 'hidden'
            )
        );
    
    echo $this->Form->input('Fund.date', 
            array(
                'label' => array(
                    'text' => '日付'
                ),
            )
        );
    
    echo $this->Html->tag('p', 'カテゴリ１');
    echo $this->Html->tag('p', $this->request->data['FundEntry']['FundPrimaryCategory']['name']);
    echo $this->Form->input('Fund.fund_primary_category_id', 
            array(
                'type' => 'hidden',
                'value' => $this->request->data['FundEntry']['FundPrimaryCategory']['id']
            )
        );
    
    echo $this->Html->tag('p', 'カテゴリ２');
    echo $this->Html->tag('p', $this->request->data['FundEntry']['FundSecondaryCategory']['name']);
    echo $this->Form->input('Fund.fund_secondary_category_id', 
            array(
                'type' => 'hidden',
                'value' => $this->request->data['FundEntry']['FundSecondaryCategory']['id']
            )
        );
    
    echo $this->Form->input('Fund.amount', 
            array(
                'label' => array(
                    'text' => '金額'
                ),
            )
        );
    
    echo $this->Html->tag('p', 'エントリーID');
    echo $this->Html->tag('p', $this->request->data['Fund']['fund_entry_id']);
    echo $this->Form->input('Fund.fund_entry_id', 
            array(
                'type' => 'hidden',
            )
        );
     
    echo $this->Form->input('Fund.referer', 
            array(
                'type' => 'hidden',
                'value' => $referer
            )
        );
     
    echo $this->Form->end('更新'); 
?>
</div>