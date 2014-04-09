<br>
<div>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Look up a symbol</th>
                    <th>Search Google</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form action="quote.php" method="post">
                            <div class="form-group">
                                <input autofocus class="form-control" name="symbol" placeholder="Symbol" type="text"/>
                                <input type="submit" value="Search"/>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="https://google.com/search" method="get">
			                <input class="form-control" autofocus name="q" type="text" placeholder="Company"/>
			                <input type="submit" value="Search"/>
		                </form>
                    </td>
                </tr>
            </tbody>
        </table>
</div>
<div>
    or <a href="index.php">Return</a> to your account.
</div>
