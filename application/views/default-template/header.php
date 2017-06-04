<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Your title</title>
    <link href="<?= base_url() . '../application/assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . '../application/assets/css/custom-styles.css' ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?= base_url() . '../application/assets/js/jquery.min.js' ?>"></script>
    <script src="<?= base_url() . '../application/assets/js/bootstrap.min.js' ?>"></script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url() ?>">Your Brand</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li>
                    <p class="navbar-btn">
                        <?php if (is_logged_in() && $current_page_name != CURRENT_PAGE_LOGOUT): ?>
                            <a href="<?= base_url() ?>index.php/user/logout" class="btn btn-primary">Logout</a>
                        <?php elseif (!is_logged_in() && $current_page_name != CURRENT_PAGE_LOGIN): ?>
                            <a href="<?= base_url() ?>index.php/user/login" class="btn btn-primary">Login</a>
                        <?php endif; ?>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container page-content">