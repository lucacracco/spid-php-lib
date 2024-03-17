<?php

$method = 'GET';
$idp = 'spid-demo';
$level = 1;

if (isset($_GET) && isset($_GET['selected_idp'])) {
    $idp = $_GET['selected_idp'];
    $method = 'GET';
}
if (isset($_POST) && isset($_POST['selected_idp'])) {
    $idp = $_POST['selected_idp'];
    $method = 'POST';
}

switch ($method) {
    case 'GET':
        $url = $sp->login($idp, 0, 1, $level, null, true);
        break;
    case 'POST':
        $url = $sp->loginPost($idp, 0, 1, $level, null, true);
        break;
}
?>

<?php
if (!$url) {
    ?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Example Docker-based demo application</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-italia/dist/css/bootstrap-italia.min.css">
    </head>
    <body>

    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <span class="fs-4">Example Docker-based demo application</span>
            </a>
        </header>
        <main>
            <h1 class="text-body-emphasis">You are already logged!</h1>
            <a class="btn btn-success" role="button" href="/">Home</a>
            <a class="btn btn-danger" role="button" href="/logout">Logout</a>
        </main>
        <footer class="pt-5 my-5 text-body-secondary border-top">
            Created for tests.
        </footer>
    </div>
    </body>
    </html>
    <?php
} else {
    echo $url;
}
?>
