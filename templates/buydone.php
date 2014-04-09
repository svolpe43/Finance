<br>
<div>
    <div class="alert alert-success">
      <strong>Congratulations!</strong> Your purchase was successful.
    </div>
    <div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Action</th>
                <th>Company</th>
                <th>Shares</th>
                <th>Share Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Bought</td>
                    <td><?= $name ?></td>
                    <td><?= $amount ?></td>
                    <td>$<?= number_format($price, 2, '.', ',') ?></td>
                    <td>$<?= number_format($cashchange, 2, '.', ',') ?></td>
                </tr>
        </tbody>
    </table>
    <p>You currently have <strong>$<?= number_format($cash, 2, '.', ',') ?></strong>.</p>
    <h4><a href="index.php">Back</a></h4>
</div>
