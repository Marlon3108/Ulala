<?php

class Views 
{
    public function Render($controllers,$view,$model1,$model2,$model3)
    {
        $array = explode("Controller",get_class($controllers));
        $controller = $array[0];
        require VIS.DFT."head.php";
        require VIS.$controller.'/'.$view.'.php';
        require VIS.DFT."footer.php";
    }
}
?>
