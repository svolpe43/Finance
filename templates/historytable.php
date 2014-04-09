<br>
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="2">Name</th>
                <th>Symbol</th>
                <th>Action</th>
                <th>Shares</th>
                <th>Price Per Share</th>
                <th>Total</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
                <tr>
                    <td><?= $position["order"] ?></td>
                    <td><?= $position["name"] ?></td>
                    <td>
                        <form action="quote.php" method="post">
                            <?= "<button type='submit' name='symbol' value='" .$position["symbol"]. "' class='btn btn-link'>".$position["symbol"]."</button>"?>
                        </form>
                    </td>
                    <td><?= $position["action"] ?></td>
                    <td><?= $position["shares"] ?></td>
                    <td>$<?= number_format($position["price"], 2, '.', ',') ?></td>
                    <td>$<?= number_format($position["total"], 2, '.', ',') ?></td>
                    <td><?= $position["time"] ?></td>
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
</div>
