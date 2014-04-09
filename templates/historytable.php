<br>
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Symbol</th>
                <th>Action</th>
                <th>Shares</th>
                <th>Price</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
                <tr>
                    <td><?= $position["name"] ?></td>
                    <td><?= $position["symbol"] ?></td>
                    <td><?= $position["action"] ?></td>
                    <td><?= $position["shares"] ?></td>
                    <td>$<?= number_format($position["price"], 2, '.', ',') ?></td>
                    <td><?= $position["time"] ?></td>
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
</div>
