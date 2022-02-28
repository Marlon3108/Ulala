<div class="container">
    <h1><?php echo $model1[0]["nombre"]." ".$model1[0]["apellido"];?></h1>
    <div class="row">
        <div class="col-sm ">
            <div class="card text-center" style="width: 21rem;">
                <div class="card-header ">
                    <?php echo "<img class='imageUserDetails' src='data:image/jpg;base64,".$model1[0]["imagen"]."' />";?>

                </div>
                <div class="card-body">
                    <div class="col-md-10">
                        <div class="row">
                            <p> <?php echo $model1[0]["nombre"]." ".$model1[0]["apellido"];?></p>
                        </div>
                        <div class="row">
                            <p>Credito: </p>
                            &nbsp;
                            <?php if ($model1[0]["credito"]){ ?>
                            <p class="text-success">Disponible.</p>
                            <?php }else{ ?>
                            <p class="text-danger">No disponible.</p>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <a class="btn btn-info " href="<?php echo URL.'Client/Reports?id='.$model1[0]["IdCliente"]?>">
                                Reportes
                            </a>
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
                                    Información
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    NID
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["numIdent"];?></p>
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
                                 Session::setSession('model1',serialize(array(
                                    "IdCliente"=>$model1[0]["IdCliente"],
                                    "numIdent"=>$model1[0]["numIdent"],
                                   "nombre"=>$model1[0]["nombre"],
                                   "apellido"=>$model1[0]["apellido"],
                                   "email"=>$model1[0]["email"],
                                   "telefono"=>$model1[0]["telefono"],
                                   "direccion"=>$model1[0]["direccion"],
                                   "credito"=>$model1[0]["credito"],
                                   "dato"=>$model1[0]["dato"],
                                   "estado"=>$model1[0]["estado"],
                                   "imagen"=>$model1[0]["imagen"]
                               )));
                               Session::setSession('model2',serialize(array()));
                                 ?>
                                    <a href="<?php echo URL.'Client/Register'?>" class="btn btn-success ">
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