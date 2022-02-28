<?php 
class UserController extends Controllers
{
    public function __construct() {
        parent::__construct();
        //session_start();
    }
    public function Register(){
        if (null != Session::getSession("usuario")){
            $roles = $this->role->getRoles();
            $model1 = session::getSession("model1");
            $model2 = session::getSession("model2");
            if (null != $model1 || null != $model2) {
                $array1 = unserialize( $model1);
                $array2 = unserialize( $model2);
                if (is_array($array1) && is_array($array2)) {
                    $model1 = $this->TUser($array1);
                    $model2 = $this->TUser($array2);
                    $rol = array(array("Role" => $model1->rol));
                    $i = 1;
                    foreach ($roles as $key => $value){
                        if ($model1->rol != $value["Role"]){
                            $rol[$i] = array("Role" => $value["Role"]);
                            $i++;
                        }
                    }
                    $this->view->Render($this,"register",$model1,$model2,$rol); 
                }else {
                    $this->view->Render($this,"register",null,null,$roles);
                }
            }else {
                $this->view->Render($this,"register",null,null,$roles);
            }
        }else{
            header("Location:".URL);
        }
    }

    public function addUser(){
        $user = Session::getSession("usuario");
        if (null != $user) {
            if ("Admin"== $user["rol"]){
                $execute = true;
                $image = null;
            if (empty($_POST["nid"])) {
                $nid = "Número de identidad";
                $execute = false;
            }
            if (empty($_POST["name"])) {
                $name = "Ingrese un nombre";
                $execute = false;
            }
            if (empty($_POST["lastname"])) {
                $lastname = "Ingrese un apellido";
                $execute = false;
            }
            if (empty($_POST["email"])) {
                $email = "Ingrese un Email";
                $execute = false;
            }else {
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $email = "Ingrese un email valido";
                    $execute = false;
                }
            }
            //Revisar
            if (0 ==$_POST["iduser"]) {
                if (empty($_POST["password"])) {
                    $password = "Ingrese una contraseña";
                    $execute = false;
                }
            }
            if (empty($_POST["phone"])) {
                $phone = "Ingrese un número de teléfono";
                $execute = false;
            }
            if (empty($_POST["direction"])) {
                $direction = "Ingrese una dirección";
                $execute = false;
            }
            if (empty($_POST["user"])) {
                $user = "Ingrese un nombre de usuario";
                $execute = false;
            }
            if ("Seleccione un rol" == $_POST["role"]){
                $role = "Seleccione un rol";
                $execute = false;
            }
            if (isset($_FILES['file'])) {
                $archivo = $_FILES['file']["tmp_name"];
                if ($archivo != null) {
                    $contents = file_get_contents($archivo);
                    $image = base64_encode($contents);
                }else {
                    $model1 = Session::getSession("model1");
                    if (null != $model1) {
                        $array1 = unserialize($model1);
                        $image = $array1["Image"];
                    }else {
                        $img = file_get_contents(URL.RSC."images/default.png"); 
                        $image = base64_encode($img);
                    }
                }
            }
            $model1 = array(
                "IdUser"=>$_POST["iduser"] ?? null,
                "numIdent"=>$_POST["nid"] ?? null,
                "nombre"=>$_POST["name"] ?? null,
                "apellido"=>$_POST["lastname"] ?? null,
                "email"=>$_POST["email"] ?? null,
                "contraseña"=>$_POST["password"] ?? null,
                "telefono"=>$_POST["phone"] ?? null,
                "direccion"=>$_POST["direction"] ?? null,
                "usuario"=>$_POST["user"] ?? null,
                "rol"=>$_POST["role"] ?? null,
                "imagen"=>$image ?? null
            );
            session::setSession('model1',serialize($model1));
            if ($execute) {
                $value = $this->model->AddUser($this->TUser($model1));
                if (is_numeric($value)) {
                    Session::setSession('model1',"");
                    Session::setSession('model2',"");
                    if ($value == 0) {
                        header('Location: User');
                    } else {
                        header('Location: '.URL.'User/Details/'.$value);
                    }
                    
                } else {
                    Session::setSession('model2',serialize(array(
                        "rol"=>$value,
                    )));
                    header('Location: Register');
                }
                    
                }else{
                    session::setSession('model1',serialize(array(
                        "numIdent"=>$nid ?? null,
                        "nombre"=>$name ?? null,
                        "apellido"=>$lastname ?? null,
                        "email"=>$email ?? null,
                        "contrasenia"=>$password ?? null,
                        "telefono"=>$phone ?? null,
                        "direccion"=>$direction ?? null,
                        "usuario"=>$user ?? null,
                        "rol"=>$role ?? null,
                    )));
                    header('Location: Register');
                }
            } else {
                Session::setSession('model1',serialize(array()));
                Session::setSession('model2',serialize(array(
                    "rol"=>"No cuenta con los permisos requeridos para ejecutar esta acción",
                )));
                header('Location: Register');
            }
        }
    }

    public function User($page){
        if (null != Session::getSession("usuario")) {
            $item = null;
            $filter = (isset($_GET["filtrar"])) ? $_GET["filtrar"] : "" ;
            $response = $this->model->getUsers($this->paginador,$filter,$page,1,"User/User",URL);
            if (is_array($response)){
                if (0 < count($response["results"])){
                    $response =$response;
                    //echo var_dump($response);
                }else{
                    $response = array(
                        "results" => null,
                        "pagi_info" => null,
                        "pagi_navegacion" => "No hay datos que mostrar"
                    );
                }
            }else {
                $response = array(
                    "results" => null,
                    "pagi_info" => null,
                    "pagi_navegacion" => $response
                );
            }
            $this->view->Render($this,"user",$response,null,null); 
        } else {
            header("Location:".URL);
        }
    }

    public function Details($id){
        if (null != Session::getSession("usuario")) {
            $response = $this->model->getUsers(null,$id,null,null,null,null);
            if (is_array($response)) {
                if (0 < count($response["results"])){
                    $this->view->Render($this,"details",$response["results"],null,null); 
                }else {
                    header('Location: User/User');
                }
            } else {
                header('Location: User/User');
            }
            
        } else {
            header("Location:".URL);
        }
    }

    public function Cancel(){
        Session::setSession('model1',"");
        Session::setSession('model2',"");
        header('Location: Register');
    }
}
?>
