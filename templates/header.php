<!DOCTYPE html>

<html>
    <head>
        <link href="/public/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/public/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/public/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Finance <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Finance</title>
        <?php endif ?>

        <script src="/public/js/jquery-1.10.2.min.js"></script>
        <script src="/public/js/bootstrap.min.js"></script>
        <script src="/public/js/scripts.js"></script>
    </head>
    
    <body>
    
<div class="navbar navbar-inverse " role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Finance</a>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="history.php">History</a></li>
                <li><a href="leader.php">Leaderboard</a></li>
                <li><a href="comment.php">Comments</a></li>
                <?php if(!empty($_SESSION["id"])) echo "<li><a href='logout.php'>Logout</a></li>";?>
            </ul>
        </div>
        <div class="navbar-collapse collapse">
            <form action="quote.php" method="post" class="navbar-form navbar-right">
                <div class="form-group">
                    <input autofocus class="form-control" name="q" placeholder="Symbol" type="text"/>
                </div>
                <div class="form-group">
                    <button type="submit" value="Search" class="btn btn-default">Search</button>
                </div>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</div>
    
         
            <div class="container">
                    <div id="middle">