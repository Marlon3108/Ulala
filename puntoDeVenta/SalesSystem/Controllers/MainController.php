<?php
class MainController extends Controllers
{
    public function __construct() {
        parent::__construct();
    }
    public function Main(){
        if (null != Session::getSession("usuario")){
            $this->view->Render($this,"main",null,null,null);
        }else{
            header("Location:".URL);
        }
    }
}
?>
