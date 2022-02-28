<?php
class ClientController extends Controllers
{
    public function __construct() {
        parent::__construct();
    }
    public function Register()
    {
        if (null != Session::getSession("usuario")) {
            $model1 = Session::getSession("model1");
            $model2 = Session::getSession("model2");
            if(null != $model1 || null != $model2){
                $array1 = unserialize( $model1);
                $array2 = unserialize( $model2);
                if(is_array($array1) && is_array($array2)){
                    $model1 = $this->TClient($array1);
                    $model2 = $this->TClient($array2);
                    $this->view->Render($this,"register",$model1,$model2,null);
                }else {
                    $this->view->Render($this,"register",null,null,null); 
                }
            }else {
                $this->view->Render($this,"register",$this->TClient(array()),null,null); 
            }
        } else {
            header("Location:".URL);
        } 
    }

    public function addClient(){
        $user = Session::getSession("usuario");
        if(null != $user){
            if ("Admin"== $user["rol"]){
                $execute = true;
                $image = null;
                if (empty($_POST["nid"])){
                    $nid = "Ingrese el nid";
                    $execute = false;
                }
                if (empty($_POST["name"])){
                    $name = "Ingrese el nombre";
                    $execute = false;
                }
                if (empty($_POST["lastname"])){
                    $lastname = "Ingrese el apellido";
                    $execute = false;
                }
                if (empty($_POST["email"])){
                    $email = "Ingrese el email";
                    $execute = false;
                }else{
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                        $email = "Ingrese un email valido";
                        $execute = false;
                    }
                }
            
                if (empty($_POST["phone"])){
                    $phone = "Ingrese el telefono";
                    $execute = false;
                }
                if (empty($_POST["direction"])){
                    $direction = "Ingrese la direccion";
                    $execute = false;
                }
            
                if (isset($_FILES['file'])){
                    $archivo =  $_FILES['file']["tmp_name"];
                    if($archivo != null){
                        $contents = file_get_contents($archivo); 
                        $image = base64_encode($contents);
                    }else{
                        $model1 = Session::getSession("model1");
                        if(null != $model1){
                            $array1 = unserialize($model1);
                            $image = $array1["Image"];
                        }else{
                            $img = file_get_contents(URL.RSC."images/default.png"); 
                            $image = base64_encode($img);
                        }
                    }
                }
                $model1 = array(
                    "IdCliente"=>$_POST["idclient"] ?? null,
                    "numIdent"=>$_POST["nid"] ?? null,
                    "nombre"=>$_POST["name"] ?? null,
                    "apellido"=>$_POST["lastname"] ?? null,                            
                    "email"=>$_POST["email"] ?? null,
                    "telefono"=>$_POST["phone"] ?? null,
                    "direccion"=>$_POST["direction"] ?? null,
                    "imagen"=>$image ?? null,
                    "credito"=>$_POST["credit"] ?? null
                );
                Session::setSession('model1',serialize($model1));
                if ($execute){
                    $value = $this->model->AddClient(
                        $this->TClient($model1),
                        $this->TReports_clients(array())
                    );
                    if (is_numeric($value)){
                        Session::setSession('model1',"");
                        Session::setSession('model2',"");
                        if ($value == 0) {
                            header('Location: Client');
                        } else {
                            header('Location: '.URL.'Client/Details/'.$value);
                        }
                        
                        
                    }else{
                        Session::setSession('model2',serialize(array(
                            "credit"=>$value,
                        )));
                        header('Location: Register');
                    }
                }else{
                    Session::setSession('model2',serialize(array(
                        "numIdent"=>$nid ?? null,
                        "nombre"=>$name ?? null,
                        "apellido"=>$lastname ?? null,
                        "email"=>$email ?? null,
                        "telefono"=>$phone ?? null,
                        "direccion"=>$direction ?? null,
                        "credito"=>$_POST["credit"] ?? null
                    )));
                    header('Location: Register');
                }
                
            }else{
                Session::setSession('model1',serialize(array()));
                Session::setSession('model2',serialize(array(
                    "email"=>"No cuenta con los permisos requeridos para ejecutar esta acción",
                )));
                header('Location: Register');
            }
        }
    }

    public function Client($page)
    {
        if (null != Session::getSession("usuario")) {
            $filter = (isset($_GET["filtrar"])) ? $_GET["filtrar"] : "" ;
            $response = $this->model->GetClients($this->paginador,$filter,
            $page,1,"Client/Client",URL);
            if (is_array($response)) {
                if (0 < count($response["results"])){
                    $response =$response;
                }else{
                    $response = array(
                        "results" => null,
                        "pagi_info" => null,
                        "pagi_navegacion" => "No hay datos que mostrar"
                    );
                }
            } else {
                $response = array(
                    "results" => null,
                    "pagi_info" => null,
                    "pagi_navegacion" => $response
                );
            }
            
            $this->view->Render($this,"client",$response,null,null);
        } else {
            header("Location:".URL);
        } 
    }

    public function Details($id)
    {
        if (null != Session::getSession("usuario")){
            $response = $this->model->GetClients(null,$id,
            null,null,null,null);
            if (is_array($response)) {
                if (0 < count($response["results"])){
                    $this->view->Render($this,"details",$response["results"],null,null);
                }else{
                    header("Location:".URL." Client/Client");
                }
            } else {
                header("Location:".URL." Client/Client");
            }
            
        }else {
            header("Location:".URL);
        }
    }

    public function Reports()
    {
        if (null != Session::getSession("usuario")){
            $idClient = $_GET["id"];
            $response = $this->model->GetTClientReport($idClient);
            if (is_array($response)) {
                if (0 < count($response["results"])) {
                    Session::setSession('idClient',$idClient);
                    $model3 = Session::getSession("model3");
                    if (null != $model3) {
                        $array3 = unserialize( $model3);
                        if (is_array($array3)) {
                            $model3 = $this->TReports_clients($array3);
                            $this->view->Render($this,"reports",$response["results"],null,$model3);
                        }else {
                            $this->view->Render($this,"reports",$response["results"],null,$this->TReports_clients(array()));
                        }
                    } else {
                        $this->view->Render($this,"reports",$response["results"],null,$this->TReports_clients(array()));
                    }
                    
                } else {
                    header("Location:".URL.'Client/Details/'.Session::getSession("idClient"));
                }
                
            } else {
                header("Location:".URL.'Client/Details/'.Session::getSession("idClient"));
            }
            
        }else{
            header("Location:".URL); 
        }
    }

    public function Payment()
    {
        $user = Session::getSession("usuario");
        if (null != $user) {
            $value = $this->model->Payment($_POST["radioOptions"],
            $_POST["payment"],$_POST["idClient"],$this->TReports_clients(array())
            ,$this->TPayments_clients(array()),$user);
            if (is_numeric($value)){
                Session::setSession('model3',"");
                header('Location: '.URL.'Client/Reports?id='.$value);
            }else{
                Session::setSession('model3',serialize(array(
                    "ultPago"=>$value,
                )));
                header('Location: '.URL.'Client/Reports?id='.Session::getSession("idClient"));
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
