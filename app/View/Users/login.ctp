<?php echo AuthComponent::password('keisuke'); ?>
<?php 
    echo $this->Form->create('User', array('type' => 'post'));
    echo $this->Form->input(
            'User.account',
            array(
                'type' => 'text',
                'label' => array('text' => 'アカウント')
            ));
    echo $this->Form->input(
            'User.password',
            array(
                'label' => array('text' => 'パスワード')
            ));
    echo $this->Form->end('ログイン');
?>
