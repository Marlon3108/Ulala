<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ulala</title>

        <link rel="stylesheet"  href="<?php echo URL.RSC ?>css/bootstrap.css" />
        <link rel="stylesheet"  href="<?php echo URL.RSC ?>css/style.css" />
        </head>
    <body>
    
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white 
            border-bottom box-shadow mb-3">
            <div class="container">
                <a class="navbar-brand" >
                    <img src="<?php echo URL.RSC ?>images/icons/Ulala.png" class="mx-auto w-25 imglogo">
                </a>
                <?php
                    $user = Session::getSession("usuario"); 
                    if(null != $user){
                ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex flex-sm-row-reverse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" title="Manage">Hola
                                <?php echo $user["nombre"]." ".$user["apellido"]?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URL?>Index/Logout"  class="nav-link text-dark" title="Manage">Cerrar Sesión</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a href="<?php echo URL?>Main/Main" class="nav-link text-dark" title="Manage">Inicio</a>
                        </li>
                        <li class="nav-item  dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" 
                            aria-haspopup="true" aria-expanded="false" href="#">Clientes</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo URL?>Client/Client">Lista clientes</a>
                                <a class="dropdown-item" href="<?php echo URL?>Client/Register">Agregar cliente</a>
                            </div>
                        </li>
                        <li class="nav-item  dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" 
                            aria-haspopup="true" aria-expanded="false" href="#">Usuarios</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo URL?>User/User">Lista usuarios</a>
                                <a class="dropdown-item" href="<?php echo URL?>User/Register">Agregar usuario</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php }?>
            </div>
        </nav>
    </header>

