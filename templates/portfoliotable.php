<div id="title">
    <h4><?= $username ?>'s Portfolio</h4>
</div>
<hr>
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Bought Price</th>
                <th>Current Price</th>
                <th>Worth</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
                <tr>
                    <td><?= $position["name"] ?></td>
                    <td>
                        <form action="quote.php" method="post">
                            <?= "<button type='submit' name='q' value='" .$position["symbol"]. "' class='btn btn-link'>".$position["symbol"]."</button>"?>
                        </form>
                    </td>
                    <td><?= $position["shares"] ?></td>
                    <td><?= number_format($position["buyprice"], 2, '.', ',') ?></td>
                    <td>$<?= number_format($position["currentprice"], 2, '.', ',') ?></td>
                    <td>$<?= number_format($position["worth"], 2, '.', ',') ?></td>
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
</div><br>
