<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licorera</title>
    <?php include_once "shared/head.php"?>
    <link rel="stylesheet" href="css/funciones.css">
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;
            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 125vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
</head>
<body>
    <!-- INICIO LOGIN -->

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="http://assets.stickpng.com/images/584c5ddc2aff9b091abaab85.png"
                                        style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Rapitienda y Licores La 28</h4>
                                    </div>

                                    <form action="#" method="POST" name="form-login">
                                        <p>Ingrese con su cuenta</p>

                                        <div class="form-outline mb-4">
                                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                        </div>
                                        <p id="errorLogin" class="errorCampos">Datos Inválidos.</p>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary" type="button" onclick="Loguearse();">Iniciar Sesión</button>
                                            <a class="text-muted" href="#!">Olvidaste la contraseña?</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Bienvenido al sistema registrador</h4>
                                    <p class="small mb-0">Este sistema se encuentra en su base beta y 
                                        ha sido creado para mantener un mayor control de inventarios,
                                        ventas y demás. -z4nd3r</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FIN LOGIN-->
    <?php include_once "shared/script.php"?>
</body>
</html>
