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
    <div class = "navbar navbar-inverse">
    <a class="navbar-brand" href="index.php">Finance</a>
    </div>
        <div class="container">
            <div id="top">
                <ul class="nav nav-tabs">
                      <li class="active"><a href="index.php">Home</a></li>
                      <li><a href="history.php">History</a></li>
                      <li><a href="leader.php">Leaderboard</a></li>
                      <li><a href="talk.php">Comments</a></li>
                </ul>
            </div>
            <div id="middle">
