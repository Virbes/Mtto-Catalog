<?php

require_once "controller/layout.controller.php";

//require_once "controller/users.controller.php";
require_once "controller/usuarios.controller.php"; // Modulo de Mtto Usuarios
require_once "controller/categories.controller.php";
require_once "controller/products.controller.php";
require_once "controller/clients.controller.php";
require_once "controller/sales.controller.php";
require_once "controller/catalogs.controller.php";
require_once "controller/datperson.controller.php";
require_once "controller/password.controller.php";

//require_once "model/users.model.php";
require_once "model/usuarios.model.php"; // Modulo de Mtto Usuarios
require_once "model/categories.model.php";
require_once "model/products.model.php";
require_once "model/clients.model.php";
require_once "model/sales.model.php";
require_once "model/catalogs.model.php";
require_once "model/datperson.model.php";
require_once "model/password.model.php";

$layout = new ControllerLayout();
$layout -> ctrLayout();