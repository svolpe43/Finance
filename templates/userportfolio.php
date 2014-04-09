<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Price</th>
                <th>Worth</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
                <tr>
                    <td><?= $position["name"] ?></td>
                    <td><?= $position["symbol"] ?></td>
                    <td><?= $position["shares"] ?></td>
                    <td>$<?= number_format($position["price"], 2, '.', ',') ?></td>
                    <td>$<?= number_format($position["worth"], 2, '.', ',') ?></td>
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
</div>
