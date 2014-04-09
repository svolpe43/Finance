<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Finance <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Finance</title>
        <?php endif ?>

        <script src="/js/jquery-1.10.2.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>
    </head>
    
    <body style>
    <div class = "navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Finance</a>
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="history.php">History</a></li>
                    <li> <a href="leader.php">Leaderboard</a></li>
                    <li> <a href="talk.php">Comments</a></li>
                </ul>
            </div>
        </div>
    </div>
        <div class="container">
            
            <div id="middle">
