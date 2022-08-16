<?php

if (isset($_POST['action'])) {

    require_once "../model/catalogs.model.php";
    $ControllerCatalogs = new ControllerCatalogs;

    switch ($_POST['action']) {
        case 'SelectCatalog': $ControllerCatalogs -> getDataCatalogs();break;
        case 'addDescription': $ControllerCatalogs -> addDescription();break;
        case 'validateNewData': $ControllerCatalogs -> validateNewData();break;
        case 'Integridad': $ControllerCatalogs -> IntegridadReferencial();break;
        case 'deleteDescription': $ControllerCatalogs -> deleteDescription();break;
        case 'editDescription': $ControllerCatalogs -> editDescription();break;
    }

}

class ControllerCatalogs {

    public static function getCatalogs() {
        return ModelCatalogs::getCatalogs();
    }

    function getDataCatalogs() {
        $nameCatalog = $_POST['catalog'];

        $result = ModelCatalogs::getDataCatalog($nameCatalog);

        $rows = '';
        $attributes = 'class="filasTablita" onclick="seleccionar(this.id);"';

        foreach ($result as $key => $value) {
            $id = 'id="'.$value[0].'"';
            $rows = $rows."<tr $attributes $id> <td>$value[0]</td> <td>$value[1]</td> </tr>";
        }

        echo $rows;
    }

    function addDescription() {
        $columns = $_POST['columns'];
        $nameCatalog = $_POST['catalog'];
        $Description = $_POST['description'];

        ModelCatalogs::addDescription($nameCatalog, $columns[0], $columns[1], $Description);

        echo '';
    }

    function validateNewData() {
        $columns = $_POST['columns'];
        $nameCatalog = $_POST['catalog'];
        $Description = $_POST['description'];

        $result = ModelCatalogs::validateNewData($nameCatalog, $columns[0], $columns[1], $Description);

        if (count($result) == 0) {
            echo 'false';
        } else {
            echo 'true';
        }

    }

    function IntegridadReferencial() {
        $ColCv = $_POST['ColCv'];
        
        $id = $_POST['id'];

        if ($ColCv == 'CvApellido') {

            $res_ape1 = ModelCatalogs::getData('CvApePat', $id);
            $res_ape2 = ModelCatalogs::getData('CvApeMat', $id);

            if ($res_ape1 || $res_ape2){echo'true';}else{echo'false';}

        } else {

            $res = ModelCatalogs::getData($ColCv, $id);

            if ($res){echo'true';}else{echo'false';}

        }
    }


    function deleteDescription() {
        $nameCatalog = $_POST['catalog'];
        $ColCv = $_POST['ColCv'];
        $id = $_POST['id'];

        ModelCatalogs::deleteDescription($nameCatalog, $ColCv, $id);
        echo '';
    }

    function editDescription() {
        $nameCatalog = $_POST['catalog'];
        $columns = $_POST['columns'];

        $id_description = $_POST['id_description'];
        $new_description = $_POST['description'];

        ModelCatalogs::editDescription($nameCatalog, $columns[0], $columns[1], $new_description, $id_description);

        echo '';
    }
}
