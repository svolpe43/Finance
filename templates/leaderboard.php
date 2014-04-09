<br>
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
                    <td><form action="userlook.php" method="post">
                            <?= "<button type='submit' name='ref' value='" . $position["userid"]. "' class='btn btn-link'>".$position["name"]."</button>"?>
                        </form>
                    </td>
                    <td>$<?= number_format($position["cash"], 2, '.', ',') ?></td>
                    <td>$<?= number_format($position["stocktotal"], 2, '.', ',') ?></td>
                    <td>$<?= number_format($position["total"], 2, '.', ',') ?></td>
                    
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
</div>
