<?php
declare (strict_types = 1);
class clasesAnonimas
{
    public function TUser(array $array)
    {
        return new class($array){
            public $IdUser = 0;
            public $numIdent;
            public $nombre;
            public $apellido;
            public $email;
            public $contrasenia;
            public $telefono;
            public $direccion;
            public $usuario;
            public $rol;
            public $imagen;
            public $is_active;
            public $estado;
            public $dato;
            function __construct($array) {
                if (0 < count($array)) {
                    if (!empty($array["IdUser"])) {$this->IdUser = $array["IdUser"];}
                    if (!empty($array["numIdent"])) {$this->numIdent = $array["numIdent"];}
                    if (!empty($array["nombre"])) {$this->nombre = $array["nombre"];}
                    if (!empty($array["apellido"])) {$this->apellido = $array["apellido"];}
                    if (!empty($array["email"])) {$this->email = $array["email"];}
                    if (!empty($array["contrasenia"])) {$this->contrasenia = $array["contrasenia"];}
                    if (!empty($array["telefono"])) {$this->telefono = $array["telefono"];}
                    if (!empty($array["direccion"])) {$this->direccion = $array["direccion"];}
                    if (!empty($array["usuario"])) {$this->usuario = $array["usuario"];}
                    if (!empty($array["rol"])) {$this->rol = $array["rol"];}
                    if (!empty($array["imagen"])) {$this->imagen = $array["imagen"];}
                    if (!empty($array["is_active"])){$this->is_active = $array["is_active"];}
                    if (!empty($array["estado"])){$this->estado = $array["estado"];}
                    if (!empty($array["dato"])){$this->dato = $array["dato"];}
                }
            }
        };
    }

    public function TClient(array $array)
    {
        return new class($array){
            public $IdCliente = 0;
            public $numIdent;
            public $nombre;
            public $apellido;
            public $email;
            public $telefono;
            public $direccion;
            public $imagen;
            public $credito;
            public $dato;
            public $estado;
            function __construct($array) {
                if (0 < count($array)) {
                    if (!empty($array["IdCliente"]))   {$this->IdCliente = $array["IdCliente"];}
                    if (!empty($array["numIdent"]))    {$this->numIdent = $array["numIdent"];}
                    if (!empty($array["nombre"]))      {$this->nombre = $array["nombre"];}
                    if (!empty($array["apellido"]))    {$this->apellido = $array["apellido"];}
                    if (!empty($array["email"]))       {$this->email = $array["email"];}
                    if (!empty($array["telefono"]))    {$this->telefono = $array["telefono"];}
                    if (!empty($array["direccion"]))   {$this->direccion = $array["direccion"];}
                    if (!empty($array["imagen"]))      {$this->imagen = $array["imagen"];}
                    if (!empty($array["credito"]))     {$this->credito = $array["credito"];}
                    if (!empty($array["dato"]))        {$this->dato = $array["dato"];}
                    if (!empty($array["estado"]))      {$this->estado = $array["estado"];}
                }
            }
        };
    }

    public function TReports_clients(array $array)
    {
        return new class($array){
            public $IdReporte =0;
            public $debito;
            public $mensual;
            public $cambio;
            public $ultPago;
            public $fecPago;
            public $deudaAct;
            public $fechaDeuda;
            public $tikect;
            public $fecLimite;
            public $IdClientes;
            function __construct($array)
            {
                if (0 < count($array)) {
                    if (!empty($array["IdReporte"]))    {$this->IdReporte = $array["IdReporte"];}
                    if (!empty($array["debito"]))       {$this->debito = $array["debito"];}
                    if (!empty($array["mensual"]))      {$this->mensual = $array["mensual"];}
                    if (!empty($array["cambio"]))       {$this->cambio = $array["cambio"];}
                    if (!empty($array["ultPago"]))      {$this->ultPago = $array["ultPago"];}
                    if (!empty($array["fecPago"]))      {$this->fecPago = $array["fecPago"];}
                    if (!empty($array["deudaAct"]))     {$this->deudaAct = $array["deudaAct"];}
                    if (!empty($array["fechaDeuda"]))   {$this->fechaDeuda = $array["fechaDeuda"];}
                    if (!empty($array["tikect"]))       {$this->tikect = $array["tikect"];}
                    if (!empty($array["fecLimite"]))    {$this->fecLimite = $array["fecLimite"];}
                    if (!empty($array["IdCliente"]))    {$this->IdClientes = $array["IdCliente"];}
                }
            }
        };
    }

    public function TPayments_clients(array $array)
    {
        return new class($array){
            public $IdPago = 0;
            public $debito;
            public $mensual;
            public $cambio;
            public $pago;
            public $dato;
            public $deudaAnt;
            public $deudaAct;
            public $datoDeuda;
            public $tikect;
            public $datoLimite;
            public $IdUser;
            public $usuario;
            public $IdClientes;
            function __construct($array){
                if(0 < count($array)){
                    if (!empty($array["IdPago"]))       {$this->IdPago = $array["IdPago"];}
                    if (!empty($array["debito"]))       {$this->debito = $array["debito"];}
                    if (!empty($array["mensual"]))      {$this->mensual = $array["mensual"];}
                    if (!empty($array["cambio"]))       {$this->cambio = $array["cambio"];}
                    if (!empty($array["pago"]))         {$this->pago = $array["pago"];}
                    if (!empty($array["dato"]))         {$this->dato = $array["dato"];}
                    if (!empty($array["deudaAnt"]))     {$this->deudaAnt = $array["deudaAnt"];}
                    if (!empty($array["deudaAct"]))     {$this->deudaAct = $array["deudaAct"];}
                    if (!empty($array["datoDeuda"]))    {$this->datoDeuda = $array["datoDeuda"];}
                    if (!empty($array["tikect"]))       {$this->tikect = $array["tikect"];}
                    if (!empty($array["datoLimite"]))   {$this->datoLimite = $array["datoLimite"];}
                    if (!empty($array["IdUser"]))       {$this->IdUser = $array["IdUser"];}
                    if (!empty($array["usuario"]))      {$this->usuario = $array["usuario"];}
                    if (!empty($array["IdClientes"]))   {$this->IdClientes = $array["IdClientes"];}
                }
            }
        };
    }
}
?>
