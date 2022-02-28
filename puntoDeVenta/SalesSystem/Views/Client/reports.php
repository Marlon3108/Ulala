<div class="container">
    <h3><?php echo $model1[0]["nombre"]." ".$model1[0]["apellido"];?></h3>
    <div class="row">
        <div class="col-sm ">
            <form action="Payment" method="post">
                <div class="card text-center" style="width: 21rem;">
                    <div class="card-header ">
                        <h5>Reportes de pagos</h5>
                    </div>
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-fee" role="tab"
                                    aria-selected="true" onclick="client.SetSection(1)">Cuotas</a>

                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-interests" role="tab"
                                    aria-selected="false" onclick="client.SetSection(2)">Intereses</a>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-fee" role="tabpanel">
                                <div class="col-md-10">
                                    <div class="row">
                                        <p>Deuda: </p>
                                        &nbsp;
                                        <p> <?php echo number_format($model1[0]["deudaAct"]);?> </p>
                                    </div>
                                    <div class="row">
                                        <p>Pago: </p>
                                        &nbsp;
                                        <p><?php echo number_format($model1[0]["ultPago"]);?></p>
                                    </div>
                                    <div class="row">
                                        <p>Cuotas por mes: </p>
                                        &nbsp;
                                        <p><?php echo number_format($model1[0]["mensual"]);?></p>
                                        <input type="hidden" value="<?php echo $model1[0]["mensual"];?>" id="monthly">
                                    </div>
                                    <div class="row">
                                        <p>Fecha del pago: </p>
                                        &nbsp;
                                        <?php if ($model1[0]["fecPago"] == NULL){ ?>
                                        <p class="text-danger">No disponible.</p>
                                        <?php }else{ ?>
                                        <p><?php echo date("d-m-Y", strtotime($model1[0]["fecPago"]));?></p>
                                        <?php } ?>

                                    </div>
                                    <div class="row">
                                        <p>Ticket: </p>
                                        &nbsp;
                                        <p><?php echo $model1[0]["tikect"];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-interests" role="tabpanel">

                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="inlineRadio1" name="radioOptions"
                                        value="1">
                                    <label class="form-check-label" for="inlineRadio1">Cuotas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="inlineRadio2" name="radioOptions"
                                        value="2">
                                    <label class="form-check-label" for="inlineRadio2">Intereses</label>
                                </div>
                                <br />
                                <br />
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" id="Input_Payment" name="payment" placeholder="Pagos"
                                                class="form-control" autofocus
                                                onkeypress="return client.Payments(event,this)" />
                                            <span class="text-danger"></span>
                                            <input type="hidden" value="<?php echo $model1[0]["IdCliente"];?>" name="idClient" >
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <p class="text-danger" id="paymentMessage"><?php echo 
                                                $model3->ultPago ?? "" ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="submit" id="payment" value="Efectuar pago"
                                                class="btn btn-success btn-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>