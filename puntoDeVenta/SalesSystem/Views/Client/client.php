<div class="container p-4">
    <div class="row">
        <div class="form-group">
            <form method="get">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" id="filtrar" name="filtrar" placeholder="Buscar" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <input type="submit" value="Buscar" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php 
    if (is_array($model1["results"])){
        foreach ($model1["results"] as $key => $value) { 
    
    ?>
        <div class="col-xs-6 col-md-2">
            <div class="card text-center">
                <div class="card-header ">
                    <a href="<?php echo URL.'Client/Details/'.$value["IdCliente"]?>">
                        <?php echo "<img class='imageUsers' src='data:image/jpg;base64,".$value["imagen"]."' />";?>
                    </a>
                </div>
                <div class="card-body text-center">
                    <div class="col-md-10">
                        <div class="row">
                            <p><?php echo $value["nombre"];?></p>
                        </div>
                        <div class="row">
                            <p><?php echo $value["apellido"];?></p>
                        </div>
                        <div class="row">
                            <a href="<?php echo URL.'Client/Details/'.$value["IdCliente"]?>"
                                class="btn btn-success text-white">
                                Detalles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
         }
          ?>
    </div>
</div>
<div class="text-center">
<?php
 echo $model1["pagi_info"]; 
 echo "<br>";
   echo $model1["pagi_navegacion"];     
?>
</div>