<?php 
    if ($this->request->is('get')) {
        $base_uri = $this->request->here;
    }
?>
<div id="term_menu">
    <?php if (isset($year) && isset($month) && isset($base_uri)) : ?>
        <div id="term_year_menu">
            <?php  
                $year_dec = (int)($year / 10);
                $year_od = (int)($year % 10);
                
                $uri = $base_uri . '?year=' . (($year_dec - 1) * 10 + $year_od) . '&month=' . $month;
                echo '<div class="col_1">';
                echo $this->Html->link('<', $uri);
                echo '</div>';
                
                for ($i = 0; $i < 10; ++$i) {
                    $tmp_year = ($year_dec * 10 + $i);
                    if ($tmp_year == $year) {
                        echo '<div class="col_1 bold">';
                        echo $year . '年';
                        echo '</div>';
                    } else {
                        echo '<div class="col_1">';
                        $uri = $base_uri . '?year=' . $tmp_year . '&month=' . $month;
                        echo $this->Html->link($tmp_year . '年', $uri);
                        echo '</div>';
                    }
                }
                
                $uri = $base_uri . '?year=' . (($year_dec + 1) * 10 + $year_od) . '&month=' . $month;
                echo '<div class="col_1">';
                echo $this->Html->link('>', $uri);
                echo '</div>';
            ?>
        </div>
        <div id="term_month_menu">
            <?php  
                for ($i = 1; $i <= 12; ++$i) {
                    if ($month == $i) {
                        echo '<div class="col_1 bold">';
                        echo $month . '月';
                        echo '</div>';
                    } else {
                        echo '<div class="col_1">';
                        $uri = $base_uri . '?year=' . $year . '&month=' . $i;
                        echo $this->Html->link($i . '月', $uri);
                        echo '</div>';
                    }
                }
            ?>
        </div>
    <?php endif; ?>
</div>