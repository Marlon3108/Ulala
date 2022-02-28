<?php
class Index_model extends connection
{
    public function __construct() {
        parent::__construct();
    }
    public function Login($model)
    {
        $where = " WHERE email = :email";
        $param = array('email' => $model->email);
        $response = $this->db->Select1("*",'tusers',$where,$param);
        if (is_array($response)) {
            $response = $response['results'];
            if (0 < count($response)) {
                if (password_verify($model->Password,$response[0]["contrasenia"])) {
                    $data = array(
                        "IdUser" => $response[0]["IdUser"],
                        "nombre" => $response[0]["nombre"],
                        "apellido" => $response[0]["apellido"],
                        "rol" => $response[0]["rol"],
                        "usuario" => $response[0]["usuario"],
                        "email" => $response[0]["email"],
                    );
                    Session::setSession("usuario",$data);
                    return 1;
                }else {
                    return "Contraseña incorrecta";
                }
            } else {
                return "El email no esta registrado";
            }
            
        } else {
            return $response;
        }
        
    }
}
?>
