<br>
<div>
  <p>Buy and sell stock from any company at live market price.
  Get real time quotes, discuss business strategy and see how you stand against your competitors.</p>
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
                            <?= "<button type='submit' name='symbol' value='" .$position["symbol"]. "' class='btn btn-link'>".$position["symbol"]."</button>"?>
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
    <p>You currently have <strong>$<?= number_format($cash, 2, '.', ',') ?></strong>.</p><br>
</div>
<div>
    <strong>Look up a symbol</strong>
    <form action="quote.php" method="post">
        <div class="form-group">
            <input autofocus class="form-control" name="symbol" placeholder="Symbol" type="text"/>
            <button type="submit" value="Search" class="btn btn-default">Search</button>
        </div>
    </form><br>

    <strong>Make a transaction</strong>
    <form action="buysell.php" method="post">
        <input name="stock" type="text" placeholder="Stock" class="form-control" autofocus/>
        <input name="amount" type="text" placeholder="Amount of shares" class="form-control"/>
        <button type="submit" name="action" value="buy" class="btn btn-default">Buy</button>
        <button type="submit" name="action" value="sell" class="btn btn-default">Sell</button>
    </form><br>
</div>

    <!--  class="text-left"  <form action="https://google.com/search" method="get">
        <input class="form-control" autofocus name="q" type="text" placeholder="Company"/>
        <input type="submit" value="Search"/>
    </form>-->
