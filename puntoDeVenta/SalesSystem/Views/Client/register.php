    <div class="container p-4">
        <form method="post" action="addClient" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card text-center">
                        <div class="card-header ">
                            <output id="imageClient">
                                <img src="<?php
                                            if ($model1 != null) {
                                                if ($model1->imagen != null) {
                                                    echo 'data:imagen/jpeg;base64,' . $model1->imagen;
                                                } else {
                                                    echo URL . RSC . 'images/default.png';
                                                }
                                            } else {
                                                echo URL . RSC . 'images/default.png';
                                            }

                                            ?>" class="responsive-img">
                            </output>
                        </div>
                        <div class="card-body">
                            <div class="caption text-center">
                                <label class="btn btn-primary" for="files">Cargar foto</label>
                                <input accept="image/*" type="file" name="file" id="files">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-5">
                    <div class="panel  panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registrar clientes</h3>
                        </div>
                        <div class="panel-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div id="header" class="bg-info">
                                            <h2 class="mb-0 t">
                                                <button class="btn btn-link text-light " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Ingresar información
                                                </button>
                                            </h2>
                                        </div>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" name="nid" placeholder="Número de identidad" class="form-control" value="<?php echo $model1->numIdent ?? "" ?>" onkeypress="new Client().ClearMessages(this);" autofocus />
                                                <span id="nid" class="text-danger"><?php echo $model2->numIdent ?? "" ?></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" value="<?php echo $model1->nombre ?? "" ?>" onkeypress="new Client().ClearMessages(this);" />
                                                <span id="name" class="text-danger"><?php echo $model2->nombre ?? "" ?></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="lastname" placeholder="Ingrese un apellido" class="form-control" value="<?php echo $model1->apellido ?? "" ?>" onkeypress="new Client().ClearMessages(this);" />
                                                <span id="lastname" class="text-danger"><?php echo $model2->apellido ?? "" ?></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="phone" placeholder="Ingrese un número de teléfono" class="form-control" value="<?php echo $model1->telefono ?? "" ?>" onkeypress="new Client().ClearMessages(this);" />
                                                <span id="phone" class="text-danger"><?php echo $model2->telefono ?? "" ?></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="direction" placeholder="Ingrese una dirección" class="form-control" value="<?php echo $model1->direccion ?? "" ?>" onkeypress="new Client().ClearMessages(this);" />
                                                <span id="direction" class="text-danger"><?php echo $model2->direccion ?? "" ?></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Ingrese un Email" class="form-control" value="<?php echo $model1->email ?? "" ?>" onkeypress="new Client().ClearMessages(this);" />
                                                <span id="email" class="text-danger"><?php echo $model2->email ?? "" ?></span>
                                            </div>
                                            <div class="form-group">
                                            <?php if($model1->credito == 0){ ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="check1" name="credit">
                                                    <label class="form-check-label" for="check1">
                                                    Credito
                                                </label>
                                            <?php }else{ ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="check1" name="credit" checked>
                                                    <label class="form-check-label" for="check1">
                                                    Credito
                                                    </label>
                                                </div>
                                            <?php } ?>
                                            <span class="text-danger"><?php echo $model2->credito ?? "" ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-success">Registrar</button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <a href="<?php echo URL ?>Client/Cancel" class="btn btn-warning text-white">Cancelar</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="idclient" value="<?php echo $model1->IdCliente ?? 0 ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>