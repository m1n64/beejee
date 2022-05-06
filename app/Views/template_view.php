<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная</title>

    <link href="public/css/app.css" rel="stylesheet" type="text/css">

</head>
<body class="bg-light bg-gradient">
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" >
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(!\Beejee\App\Core\Classes\Auth::check()): ?>
                        <li class="nav-item ">
                            <button class="nav-link btn btn-outline-dark" data-mdb-toggle="modal" data-mdb-target="#loginModal">Login</button>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ">
                            <button class="nav-link btn btn-outline-dark" id="exitButton">Logout</button>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <div class="main-view">
        <?php include 'app/Views/'.$content_view.".php"; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Login (Admin)</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body form-wrapper">
                <form>
                    <div class="form-group">
                        <label class="form-label" for="login">Login</label>
                        <input type="text" id="login" name="login" required class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" required class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-mdb-dismiss="modal">Close</button>
                <button type="button" id="loginButton" class="btn btn-outline-primary">Login</button>
            </div>
        </div>
    </div>
</div>

<script src="public/js/app.js"></script>
</body>
</html>