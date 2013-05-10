<h3>通算データ</h3>
<li><?php echo $this->Html->link('収入', '/incomings/index'); ?></li>
<li><?php echo $this->Html->link('支出', '/outgoings/index'); ?></li>
<li><?php echo $this->Html->link('貯蓄', '/assets/index'); ?></li>
<li><?php echo $this->Html->link('積立', '/funds/index'); ?></li>
<li><?php echo $this->Html->link('収支', '/calculates/index'); ?></li>

<h3>期間指定</h3>
<?php
    echo $this->Form->create('Term', array('type' => 'post'));
    echo $this->Form->input('Term.year',
            array(
                'label' => '年',
                'options' => $years));
    
    echo $this->Form->input('Term.month',
            array(
                'label' => '月',
                'options' => $months));
    
    echo $this->Form->end('表示');
?>