<br>
<div id="title">
    <h4>Last Purchase</h4>
</div>
<hr>
<div>
    <div class="alert alert-success">
      <strong>Congratulations!</strong> Your transaction was successful.
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
                    <td><?= $_GET["action"]?></td>
                    <td><?= $_GET["name"] ?></td>
                    <td><?= $_GET["shares"] ?></td>
                    <td>$<?= number_format($_GET["price"], 2, '.', ',') ?></td>
                    <td>$<?= number_format(abs($_GET["change"]), 2, '.', ',') ?></td>
                </tr>
        </tbody>
    </table>
</div>
<br>
