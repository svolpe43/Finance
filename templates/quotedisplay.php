<div>
    <form action="transaction1.php" method="post">
        <input name="company" type="text" placeholder="Stock" class="form-control" autofocus/>
        <input name="shares" type="text" placeholder="Amount of shares" class="form-control"/>
        <button type="submit" name="action" value="buy" class="btn btn-default">Buy</button>
        <button type="submit" name="action" value="sell" class="btn btn-default">Sell</button>
    </form><br>
</div>
<?= require("../templates/company.php"); ?>
 
