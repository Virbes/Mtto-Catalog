<?php

require_once 'conexion.php';

class ModelPersonalData {

    /** Get All Tip Persons */
    public static function getTipPerson() {
        $sql = 'SELECT * FROM cTipPerson';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All Names */
    public static function getNames() {
        $sql = 'SELECT * FROM cNombre';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All LastNames */
    public static function getLastNames() {
        $sql = 'SELECT * FROM cApellido';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All Genders */
    public static function getGenders() {
        $sql = 'SELECT * FROM cGenero';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All States */
    public static function getStates() {
        $sql = 'SELECT * FROM cEstado';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All Municipalities */
    public static function getMunicipalities() {
        $sql = 'SELECT * FROM cMunicipio';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All Colonies */
    public static function getColonies() {
        $sql = 'SELECT * FROM cColonia';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All Streets */
    public static function getStreets() {
        $sql = 'SELECT * FROM cCalle';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Get All People in mPersonas */
    public static function getDataPerson($id) {
        $sql = "SELECT * FROM mPersona WHERE CvPerson = :CvPerson";

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> bindParam(":CvPerson", $id, PDO::PARAM_STR);
        $stmt -> execute();

        return $stmt -> fetch();
        $stmt = null;
    }

    /** Get All People in mPersonas */
    public static function getDataTable() {
        $sql = "SELECT persona.CvPerson, nombre.DsNombre 'Nombre', apepat.DsApellido 'ApePat', apemat.DsApellido 'ApeMat', persona.FecNac, estado.DsEstado 'Estado', municipio.DsMunicipio 'Municipio', colonia.DsColonia 'Colonia', calle.DsCalle 'Calle', persona.Numero, persona.Cp 
                FROM cNombre nombre, cApellido apepat, cApellido apemat, mPersona persona, cEstado estado, cMunicipio municipio, cColonia colonia, cCalle calle
                WHERE 
                persona.CvNombre = nombre.CvNombre AND
                persona.CvApePat = apepat.CvApellido AND
                persona.CvApeMat = apemat.CvApellido AND
                persona.CvEstado = estado.CvEstado AND
                persona.CvMunicipio = municipio.CvMunicipio AND
                persona.CvColonia = colonia.CvColonia AND
                persona.CvCalle = calle.CvCalle";

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll();
        $stmt = null;
    }

    /** Add a New Person */
    public static function addNewPerson($TipPerson, $Name, $LastName, $MotherLastName, $Date, $Gender, $Phone, $Email, $Curp, $Rfc, $State, $Municipality, $Suburb, $Street, $Number, $PostalCode) {
        $sql = "INSERT INTO mPersona(CvTipPerson, CvNombre, CvApePat, CvApeMat, FecNac, CvGenero, Telefono, Email, Curp, Rfc, CvEstado, CvMunicipio, CvColonia, CvCalle, Numero, Cp) VALUES(:CvTipPerson, :CvNombre, :CvApePat, :CvApeMat, :FecNac, :CvGenero, :Telefono, :Email, :Curp, :Rfc, :CvEstado, :CvMunicipio, :CvColonia, :CvCalle, :Numero, :Cp)";

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> bindParam(":CvTipPerson", $TipPerson, PDO::PARAM_STR);
        $stmt -> bindParam(":CvNombre", $Name, PDO::PARAM_STR);
        $stmt -> bindParam(":CvApePat", $LastName, PDO::PARAM_STR);
        $stmt -> bindParam(":CvApeMat", $MotherLastName, PDO::PARAM_STR);
        $stmt -> bindParam(":FecNac", $Date, PDO::PARAM_STR);
        $stmt -> bindParam(":CvGenero", $Gender, PDO::PARAM_STR);
        $stmt -> bindParam(":Telefono", $Phone, PDO::PARAM_STR);
        $stmt -> bindParam(":Email", $Email, PDO::PARAM_STR);
        $stmt -> bindParam(":Curp", $Curp, PDO::PARAM_STR);
        $stmt -> bindParam(":Rfc", $Rfc, PDO::PARAM_STR);
        $stmt -> bindParam(":CvEstado", $State, PDO::PARAM_STR);
        $stmt -> bindParam(":CvMunicipio", $Municipality, PDO::PARAM_STR);
        $stmt -> bindParam(":CvColonia", $Suburb, PDO::PARAM_STR);
        $stmt -> bindParam(":CvCalle", $Street, PDO::PARAM_STR);
        $stmt -> bindParam(":Numero", $Number, PDO::PARAM_STR);
        $stmt -> bindParam(":Cp", $PostalCode, PDO::PARAM_STR);
        $stmt -> execute();
        $stmt = null;
    }

    public static function deletePerson($CvPerson) {
        $sql = 'DELETE FROM mPersona WHERE CvPerson = :CvPerson';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> bindParam(":CvPerson", $CvPerson, PDO::PARAM_STR);
        $stmt -> execute();
        $stmt = null;
    }

    public static function editPerson($CvPerson, $TipPerson, $Name, $LastName, $MotherLastName, $Date, $Gender, $Phone, $Email, $Curp, $Rfc, $State, $Municipality, $Suburb, $Street, $Number, $PostalCode) {
        $sql = 'UPDATE mPersona SET CvTipPerson = :CvTipPerson, Curp = :Curp, Rfc = :Rfc, Email = :Email, CvNombre = :CvNombre, CvApePat = :CvApePat, CvApeMat = :CvApeMat, FecNac = :FecNac, CvGenero = :CvGenero, Telefono = :Telefono, CvEstado = :CvEstado, CvMunicipio = :CvMunicipio, CvColonia = :CvColonia, CvCalle = :CvCalle, Numero = :Numero, Cp = :Cp
                WHERE CvPerson = :CvPerson';

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> bindParam(":CvTipPerson", $TipPerson, PDO::PARAM_STR);
        $stmt -> bindParam(":Curp", $Curp, PDO::PARAM_STR);
        $stmt -> bindParam(":Rfc", $Rfc, PDO::PARAM_STR);
        $stmt -> bindParam(":Email", $Email, PDO::PARAM_STR);
        $stmt -> bindParam(":CvNombre", $Name, PDO::PARAM_STR);
        $stmt -> bindParam(":CvApePat", $LastName, PDO::PARAM_STR);
        $stmt -> bindParam(":CvApeMat", $MotherLastName, PDO::PARAM_STR);
        $stmt -> bindParam(":FecNac", $Date, PDO::PARAM_STR);
        $stmt -> bindParam(":CvGenero", $Gender, PDO::PARAM_STR);
        $stmt -> bindParam(":Telefono", $Phone, PDO::PARAM_STR);
        $stmt -> bindParam(":CvEstado", $State, PDO::PARAM_STR);
        $stmt -> bindParam(":CvMunicipio", $Municipality, PDO::PARAM_STR);
        $stmt -> bindParam(":CvColonia", $Suburb, PDO::PARAM_STR);
        $stmt -> bindParam(":CvCalle", $Street, PDO::PARAM_STR);
        $stmt -> bindParam(":Numero", $Number, PDO::PARAM_STR);
        $stmt -> bindParam(":Cp", $PostalCode, PDO::PARAM_STR);
        $stmt -> bindParam(":CvPerson", $CvPerson, PDO::PARAM_STR);

        $stmt -> execute();
        $stmt = null;
    }

    public static function existsCURP($Curp) {
        $sql = "SELECT persona.CvPerson, nombre.DsNombre, apepat.DsApellido FROM mPersona persona, cNombre nombre, cApellido apepat WHERE nombre.CvNombre = persona.CvNombre AND apepat.CvApellido = persona.CvApePat AND Curp = :Curp";
        
        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> bindParam(":Curp", $Curp, PDO::PARAM_STR);
        $stmt -> execute();

        return $stmt -> fetch();
        $stmt = null;
    }

    public static function deleteByCurp($CURP) {
        $sql = "DELETE FROM mPersona WHERE CvPerson = :CvPerson";

        $stmt = Conexion::conectar() ->prepare($sql);
        $stmt -> bindParam(":CvPerson", $CURP, PDO::PARAM_STR);
        $stmt -> execute();

        $stmt = null;
    }

    public static function existsUser($CvPerson) {
        $sql = "SELECT * FROM Users WHERE CvPerson = :CvPerson";

        $stmt = Conexion::conectar() -> prepare($sql);
        $stmt -> bindParam(":CvPerson", $CvPerson, PDO::PARAM_STR);
        $stmt -> execute();

        return $stmt -> fetch();
        $stmt = null;
    }

}