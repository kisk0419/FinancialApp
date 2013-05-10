<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(
                        array(
                            'kickstart',
                            'smoothness/jquery-ui-1.10.3.custom.min.css',
                            'fapps'
                        )
                    );
                echo $this->Html->script(
                        array(
                            'jquery-1.9.1.min',
                            'jquery-ui-1.10.3.custom.min',
                            'kickstart'
                        )
                    );
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container" class="grid">
		<div id="header" class="col_12">
                    <div class="col_9">
                        <h6>
                            <?php 
                                if (isset($year)) {
                                    echo $year . '年';
                                }
                                if (isset($month)) {
                                    echo $month . '月';
                                }
                                if (isset($year) || isset($month)) {
                                    echo '期';
                                }
                                if (isset($date)) {
                                    echo '　' . $date;
                                }
                                if (isset($family_name)) {
                                    echo '　' . $family_name . '家';
                                }
                                if (isset($header_title)) {
                                    echo '　' . $header_title;
                                }
                            ?>
                        </h6>
                    </div>
                    <div class="col_3">
                        <ul class="button-bar">
                            <li><?php echo $this->Html->link('家計簿', '/Calculates/check'); ?></li>
                            <li><?php echo $this->Html->link('収入', '/Incomings/term'); ?></li>
                            <li><?php echo $this->Html->link('支出', '/Outgoings/term'); ?></li>
                            <li><?php echo $this->Html->link('貯蓄', '/Assets/term'); ?></li>
                            <li><?php echo $this->Html->link('積立', '/Funds/term'); ?></li>
                        </ul>
                    </div>
    		</div>
            	<div id="content"  class="col_12">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
                </div>
	</div>
</body>
</html>
