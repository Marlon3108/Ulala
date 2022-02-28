<?php
class Client_model extends Connection
{
    private $Money = "$";
    public function __construct(){
        parent::__construct();
    }
    public function AddClient($model1,$model2){
        try {
            $this->db->pdo->beginTransaction();
            $model1->credito = $model1->credito == null ? 0 : 1;
            $where = " WHERE email = :email";
            $response = $this->db->Select1("*",'tcliente',$where,array('email' => $model1->email));
            if (is_array($response)){
                $response = $response['results'];
                if (0 == $model1->IdCliente){
                    if (0 == count($response)){
                        $model1->estado = true;
                        $model1->dato = date("Y-m-d");
                        $query1 = "INSERT INTO tcliente (IdCliente,numIdent,nombre,apellido,email,telefono,direccion,imagen,credito,dato,estado) 
                        VALUES (:IdCliente,:numIdent, :nombre,:apellido,:email,:telefono,:direccion,:imagen,:credito,:dato,:estado)";
                        
                        $sth = $this->db->pdo->prepare($query1);
                        $sth->execute((array)$model1);
                        $id = $this->db->pdo->lastInsertId();

                        $model2->debito = 0;
                        $model2->mensual = 0;
                        $model2->cambio = 0;
                        $model2->ultPago = 0;
                        $model2->fecPago = null;
                        $model2->deudaAct = 0;
                        $model2->fechaDeuda = null;
                        $model2->tikect = "0000000000";
                        $model2->fecLimite = null;
                        $model2->IdClientes = $id;

                        $query2 = "INSERT INTO treportes_cliente (IdReporte,debito,mensual,cambio,ultPago,fecPago,deudaAct,fechaDeuda,tikect,fecLimite,IdCliente) 
                        VALUES (:IdReporte,:debito,:mensual,:cambio,:ultPago,:fecPago,:deudaAct,:fechaDeuda,:tikect,:fecLimite,:IdClientes)";

                        $sth = $this->db->pdo->prepare($query2);
                        $sth->execute((array)$model2);
                    }else{
                        return "El email ya esta registrado";
                    }
                }else{
                    $model1->estado = $response[0]["estado"];
                    $model1->dato = $response[0]["dato"];
                    $query2 =  "UPDATE tcliente SET IdCliente = :IdCliente,numIdent = :numIdent,nombre = :nombre,apellido = :apellido,email = :email,telefono = :telefono,
                    direccion = :direccion,imagen = :imagen,credito = :credito,estado = :estado,dato = :dato WHERE IdCliente = ".$model1->IdCliente;
                    if (0 == count( $response )) {
                        $sth = $this->db->pdo->prepare($query2);
                        $sth->execute((array)$model1);
                    } else {
                        if($model1->IdCliente == $response[0]["IdCliente"]){
                            $sth = $this->db->pdo->prepare($query2);
                            $sth->execute((array)$model1);
                        }else{
                            return 'El email ya esta registrado';
                        }
                    }
                    
                }
                $this->db->pdo->commit();
                return $model1->IdCliente;
            }else{
                return $response;
            }
        } catch (\Throwable $th) {
            $this->db->pdo->rollBack();
            return $th->getMessage();
        }
    }

    public function GetClients($paginador,$filter,$page,$register,$method,$url)
    {
        if($paginador != null){
            $where = " WHERE nombre LIKE :nombre OR apellido LIKE :apellido OR email LIKE :email";
            $array = array(
                'nombre' => '%'.$filter.'%',
                'apellido' => '%'.$filter.'%',
                'email' => '%'.$filter.'%'
            );
            return $paginador->paginador("*","tcliente",$method,$register,$page,$where,$array,$url);
        }else{
            $where = " WHERE IdCliente = :IdCliente";
            return  $this->db->select1("*",'tcliente',$where,array('IdCliente' => $filter));
        }
    }

    public function GetTClientReport($idClient)
    {
        $where = " WHERE IdCliente = :IdCliente";
        $condition = "tcliente.IdCliente=treportes_cliente.IdClientes";
        return  $this->db->select3("*",'tcliente','treportes_cliente',$condition,$where,array('IdCliente' => $idClient));
    }

    public function Payment($radioOptions, $payment, $idClient, $model1, $model2,$user)
    {
        switch ($radioOptions) {
            case '1':
            try {
                $this->db->pdo->beginTransaction();
                $dataClient =  $this->GetTClientReport($idClient);
                $dataClient = $dataClient['results'];
                if ($dataClient[0]['debito'] == '0.0') {
                    $message = 'El cliente no contiene deuda';
                } else {
                    $payment = ( float )$payment;
                    $monthly = ( float )$dataClient[0]['mensual'];
                    if ($payment >= $monthly ) {
                        $currentDebt = ( float )$dataClient[0]['deudaAct'];
                        $ticket = Codes::codigoTikects( $dataClient[0]['tikect'] );
                        if ($payment == $currentDebt || $payment > $currentDebt ) {
                            $change = $payment - $currentDebt;
                            $currentDebt = 0.0;
                            $message = 'Cambio para el cliente '.$this->Money.number_format( $change );
                        }else {
                            $change = $payment - $monthly;
                            $currentDebt = $currentDebt - $monthly;
                            $message = 'Cambio para el cliente '.$this->Money.number_format( $change );
                        }
                        $_payment = number_format( $payment );
                        $_debt = number_format( $dataClient[0]['debito'] );
                        $_currentDebt = number_format( $currentDebt );
                        $_currentDebtClient = number_format( $dataClient[0]['deudaAct'] );

                        $_monthly = number_format( $dataClient[0]['mensual'] );

                            $currentDate = date( 'Y-m-d' );
                            //sumo 1 mes
                            $newDate = date( 'Y-m-d', strtotime( $currentDate.'+ 1 month' ) );
                            $_deadline = $currentDebt == 0.0 ? $currentDate : $newDate;

                            if ($currentDebt == 0.0 || $currentDebt == 0) {
                                $model1->debito = 0.0;
                                $model1->mensual = 0.0;
                                $model1->cambio = 0.0;
                                $model1->ultPago = 0.0;
                                $model1->fecPago = null;
                                $model1->deudaAct = 0.0;
                                $model1->fechaDeuda = null;
                                $model1->tikect = '0000000000';
                                $model1->fecLimite = null;
                                $model1->IdClientes = $idClient;
                                
                            }else {
                                $model1->debito = $dataClient[0]['debito'];
                                $model1->mensual = $dataClient[0]['mensual'];
                                $model1->cambio = $change;
                                $model1->ultPago = $payment;
                                $model1->fecPago = $currentDate;
                                $model1->deudaAct = $currentDebt;
                                $model1->fechaDeuda = $dataClient[0]['fechaDeuda'];
                                $model1->tikect = $ticket;
                                $model1->fecLimite = $_deadline;
                                $model1->IdClientes = $idClient;
                                
                            }
                            $query1 =  'UPDATE treportes_cliente SET IdReporte = :IdReporte,debito = :debito,mensual = :mensual,cambio = :cambio,ultPago = :ultPago,
                            fecPago = :fecPago,deudaAct = :deudaAct,fechaDeuda = :fechaDeuda,tikect = :tikect,fecLimite = :fecLimite,IdClientes = :IdClientes 
                            WHERE IdReporte = '.$dataClient[0]['IdReporte'];

                            $sth = $this->db->pdo->prepare( $query1 );
                            $sth->execute( ( array )$model1 );

                            $model2->debito = $dataClient[0]['debito'];
                            $model2->pago = $payment;
                            $model2->cambio = $change;
                            $model2->deudaAct = $currentDebt;
                            $model2->mensual = $dataClient[0]['mensual'];
                            $model2->deudaAnt = $dataClient[0]['deudaAnt'] ;
                            $model2->dato = $currentDate;
                            $model2->datoLimite = $_deadline;
                            $model2->datoDeuda = $dataClient[0]['fechaDeuda'];
                            $model2->tikect = $ticket;
                            $model2->IdUser = $user['IdUser'];
                            $model2->usuario = $user['nombre'].' '.$user['apellido'];
                            $model2->IdClientes = $idClient;
                            

                            $query2 = 'INSERT INTO tpagos_cliente (IdPago,debito,mensual,cambio,pago,dato,deudaAnt,deudaAct,datoDeuda,tikect,datoLimite,IdUser,usuario,IdClientes) 
                            VALUES (:IdPago,:debito,:mensual,:cambio,:pago,:dato, :deudaAnt,:deudaAct,:datoDeuda,:tikect,:datoLimite,:IdUser,:usuario,:IdClientes)';
                            
                            $sth = $this->db->pdo->prepare( $query2 );
                            $sth->execute( ( array )$model2 );
                            $this->db->pdo->commit();
                            
                            return $idClient;
                    } else {
                        $message = 'El pago debe ser '.$this->Money.number_format( $monthly );
                    }
                    
                }
            } catch (\Throwable $th) {
                $this->db->pdo->rollBack();
                return $th->getMessage();
            }
            break;
            
            default:
                # code...
            break;
        }
    }
}
