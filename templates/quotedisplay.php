<div class="btn-group">
    <form action="buysell.php" method="post">
        <input name="stock" type="text" placeholder="Stock" class="form-control" autofocus/>
        <input autofocus name="amount" type="text" placeholder="Amount of shares" class="form-control"/>
        <button type="submit" name="action" value="buy" class="btn btn-default">Buy</button>
        <button type="submit" name="action" value="sell" class="btn btn-default">Sell</button>
    </form>
</div>
<?= require("../templates/company.php"); ?>
 

