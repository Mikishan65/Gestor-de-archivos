<?php
session_start();
if (isset($_SESSION['login_id'])) {
    header("location:index.php?page=home");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin | Sitio de Blog</title>
    <?php include('./header.php'); ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f7f7f7;
        }

        #login-section {
            display: flex;
            flex-direction: row;
            width: 80%;
            max-width: 900px;
            height: 70%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
        }

        #login-left {
            width: 50%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        #login-right {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .logo {
            font-size: 6rem;
        }

        .card-body {
            width: 50%;
        }
    </style>
</head>

<body>
    <div id="login-section">
        <div id="login-left">
            <div class="logo">
                <i class="fa fa-share-alt"></i>
            </div>
        </div>
        <div id="login-right">
            <div class="card-body">
                <form id="login-form">
                    <div class="form-group">
                        <label for="username" class="control-label">Nombre de usuario</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
    document.getElementById('login-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const button = document.querySelector('#login-form button[type="submit"]');
        button.disabled = true;
        button.textContent = 'Iniciando sesión...';
        const alertDanger = document.querySelector('.alert-danger');
        if (alertDanger) alertDanger.remove();

        fetch('ajax.php?action=login', {
            method: 'POST',
            body: new FormData(this)
        })
        .then(response => response.text())
        .then(resp => {
            console.log("Respuesta del servidor:", resp);  // Depuración
            if (resp.trim() == '1') {
                window.location.href = 'index.php?page=home';
            } else {
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger';
                alert.textContent = 'Nombre de usuario o contraseña incorrectos.';
                this.prepend(alert);
                button.disabled = false;
                button.textContent = 'Iniciar sesión';
            }
        })
        .catch(err => {
            console.error(err);
            button.disabled = false;
            button.textContent = 'Iniciar sesión';
        });
    });
</script>


</body>

</html>
