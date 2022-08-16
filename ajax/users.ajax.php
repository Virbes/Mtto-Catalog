<?php 

require_once '../controller/users.controller.php';
require_once '../model/users.model.php';

class AjaxUsers {
    /** Edit User */
    public $id_user;

    public function ajaxEditUser() {
        $res = ControllerUsers::getUser($this -> id_user);

        echo json_encode($res);
    }
}

/** Edit User */
if (isset($_POST['idUser'])) {
    $edit = new AjaxUsers();
    $edit -> id_user = $_POST['idUser'];
    $edit -> ajaxEditUser();
}
