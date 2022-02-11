<html lang="en">
<head>
    <title><?= $title??"FauxRhum" ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        a {
            text-decoration: none;
            margin-right: 1em;
            margin-left: 1em;
        }
    </style>
</head>
<body style="margin: 0;">
<nav style="background-color: #eb6864; height: 3.5em;">
    <div style="display: flex; flex-direction: row; justify-content: space-between; height: 100%; align-items: center;
    margin-left:1.5em; margin-right: 1.5em">
        <a style="color: white;" href="/"><h2>FauxRhum</h2></a>
        <div style="display: flex; flex-direction: row; justify-content: space-evenly; align-items: center;">
            <ul>
                <!--<li class="nav-item">
                    <a class="nav-link active" href="#">Home
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>-->
            </ul>
            <div style="display: flex; flex-direction: row; justify-content: space-evenly; align-items: center;">
                <?php
                use \Framework\Http\Session;
                /** @var Session $session */
                echo $session->get('user-id') !== null
                ?'<a style="color: white" href="/logout">Logout</a>'
                    :'<a style="color: white" href="/register">Register</a><a style="color: white" href="/login">Login</a>'
                ?>
                <i class="bi-person-circle" style="font-size: 2em; color: white;"></i>
            </div>
        </div>
    </div>
</nav>
<?php include __DIR__.'/_messages.html.php' ?>
<main style="margin: 1em;">
    <?php
    /** @var string $innerTemplate */
    include $innerTemplate
    ?>
</main>
</body>
</html>