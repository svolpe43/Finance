<div id="title">
    <h4>Leader Board</h4>
</div>
<hr>
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Cash</th>
                <th>Stock Worth</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
                <tr>
                    <td><?= $position["rank"] ?></td>
                    <td>
                        <form action="userlook.php" method="post">
                            <?= "<button type='submit' name='userid' value='" . $position["userid"]. "' class='btn btn-link'>".$position["name"]."</button>"?>
                        </form>
                    </td>
                    <td>$<?= number_format($position["cash"], 2, '.', ',') ?></td>
                    <td>$<?= number_format($position["stocktotal"], 2, '.', ',') ?></td>
                    <td style="width:200px">$<?= number_format($position["total"], 2, '.', ',') ?></td>
                    <td style="width:50px">
                        <form action="history.php" method="post">
                            <?= "<button type='submit' name='user' value='" . $position["userid"]. "' class='btn btn-link'>history</button>"?>
                        </form>
                    </td>
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
</div>
