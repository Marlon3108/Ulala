<?php
class errorController extends controllers
{
    public function __construct() {
        parent::__construct();
    }
    public function Error ($url)
    {
        $this->view->Render($this,"error",$url,null,null);
    }
}
?>
