<br>
<div>
	<form action="talk.php" method="post">
        <div class="form-group">
		    <textarea cols="50" rows="1" autofocus name="comment" class="form-control"></textarea>
		    <input class="btn btn-default" type="submit" value="Submit"/>
		</div>
	</form>
	<div id="title">
        <h4>Comments</h4>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Comment</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
                <tr>
                    <td><?= $position["username"] ?></td>
                    <td><?= $position["comment"] ?></td>
                    <td><?= $position["time"] ?></td>
                    <td>
                        <form action="delete.php" method="post">
                            <?= "<button type='submit' name='ref' value='" .$position["ref"]. "' class='btn btn-link'>Delete</button>"?>
                        </form>
                    </td>
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
    
</div><br>
