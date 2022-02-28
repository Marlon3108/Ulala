<?php
class User_model extends Connection
{
    public function __construct(){
        parent::__construct();
    }
    public function AddUser($model){
    try {
        $this->db->pdo->beginTransaction();
        $where = " WHERE email = :email";
        $response = $this->db->Select1("email",'tusers',$where,array('email' => $model->email));
        if (is_array($response)){
            $response = $response['results'];
            if (0 == $model->IdUser) {
                if (0 == count($response)){
                    $model->is_active = true;
                    $model->estado = true;
                    $model->dato = date("Y-m-d");
                    $model->contrasenia = password_hash($model->contrasenia,PASSWORD_DEFAULT);
                    $query = "INSERT INTO tusers (IdUser,numIdent,nombre,apellido,email,contrasenia,telefono,direccion,usuario,rol,imagen,is_active,estado,dato) 
                    VALUES (:IdUser,:numIdent,:nombre,:apellido,:email,:contrasenia,:telefono,:direccion,:usuario,:rol,:imagen,:is_active,:estado,:dato)";
                }else {
                    return "El email ya esta registrado";
                }
            } else {
                $model->is_active = $response[0]["is_active"];
                $model->estado = $response[0]["estado"];
                $model->dato = $response[0]["dato"];
                $model->contrasenia = $response[0]["contrasenia"];
                $query =  "UPDATE tusers SET IdUser = :IdUser,numIdent = :numIdent,nombre = :nombre,apellido = :apellido,email = :email,
                contrasenia = :contrasenia,telefono = :telefono,direccion = :direccion,usuario = :usuario,rol = :rol,imagen = :imagen,is_active = :is_active,
                estado = :estado,dato = :dato WHERE IdUser = ".$model->IdUser;
            }
            $sth = $this->db->pdo->prepare($query);
            $sth->execute((array)$model);
            $this->db->pdo->commit();
            return $model->IdUser;
        }else {
            return $response;
        }
    } catch (\Throwable $th) {
        $this->db->pdo->rollBack();
        return $th->getMessage();
    }
    }

    public function getUsers($paginador,$filter,$page,$register,$method,$url){
        if ($paginador != null) {
            $where = " WHERE nombre LIKE :nombre OR apellido LIKE :apellido OR email LIKE :email";
            $array = array(
                'nombre' => '%'.$filter.'%',
                'apellido' => '%'.$filter.'%',
                'email' => '%'.$filter.'%'
            );
            return $paginador->paginador("*","tusers",$method,$register,$page,$where,$array,$url);
        }else {
            $where = " WHERE IdUser = :IdUser";
            return  $this->db->select1("*",'tusers',$where,array('IdUser' => $filter));
        }
    }
}
?>
