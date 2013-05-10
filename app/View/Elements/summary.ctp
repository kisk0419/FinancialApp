<div>
    <table>
        <thead>
        <tr>
            <th><?php echo h($category_1) ?></th>
            <th>￥<?php echo h(number_format($data->totalPrice())) ?></th>
            <th><?php echo h($data->rate()) ?>%</th>
        </tr>   
        </thead>
        <tbody>
        <?php foreach ($data as $category_2 => $detail): ?>
        <tr>
            <td><?php echo h($category_2) ?></td>
            <td>￥<?php echo h(number_format($detail->totalPrice())) ?></td>
            <td><?php echo h($detail->rate()) ?>%</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>