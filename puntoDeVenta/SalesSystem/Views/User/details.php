<div class="container">
    <h1><?php echo $model1[0]["nombre"]." ".$model1[0]["apellido"];?></h1>
    <div class="row">
        <div class="col-sm ">
            <div class="card text-center" style="width: 21rem;">
                <div class="card-header ">
                <?php echo "<img class='imageUserDetails' src='data:imagen/jpg;base64,".$model1[0]["imagen"]."' />";?>
                    
                </div>
                <div class="card-body">
                    <div class="col-md-10">
                        <div class="row">
                            <p> <?php echo $model1[0]["nombre"]." ".$model1[0]["apellido"];?></p>
                        </div>
                        <div class="row">
                        <p>Rol: </p>
                            &nbsp;
                            <p> <?php echo $model1[0]["rol"];?></p>
                        </div>
                        <div class="row">
                           <p>Estado: </p>
                            &nbsp;
                            <?php if ($model1[0]["estado"]){ ?>                               
                                <p class="text-success">Disponible.</p>
                            <?php }else{ ?>
                                <p class="text-danger">No disponible.</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <table class="tableCursos">
                        <tbody>
                            <tr>
                                <th>
                                    Informacion
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Número de identidad
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["numIdent"];?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Nombre
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["nombre"]." ".$model1[0]["apellido"];?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Teléfono
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["telefono"];?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Correo electronico
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["email"];?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                 <?php 
                                 session::setSession('model1',serialize(array(
                                    "IdUser"=>$model1[0]["IdUser"],
                                    "numIdent"=>$model1[0]["numIdent"],
                                    "nombre"=>$model1[0]["nombre"],
                                    "apellido"=>$model1[0]["apellido"],
                                    "email"=>$model1[0]["email"],
                                    "telefono"=>$model1[0]["telefono"],
                                    "direccion"=>$model1[0]["direccion"],
                                    "usuario"=>$model1[0]["usuario"],
                                    "rol"=>$model1[0]["rol"],
                                    "imagen"=>$model1[0]["imagen"]
                               )));
                               session::setSession('model2',serialize(array()));
                                 ?>
                                    <a href="<?php echo URL.'User/Register'?>" class="btn btn-success ">
                                    Editar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
