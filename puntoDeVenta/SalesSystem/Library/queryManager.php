<?php
class queryManager
{
    public $pdo;
    function __construct($USER,$PASSWORD,$DB) {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname='.$DB.';charset=utf8',$USER, $PASSWORD,
            [PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (\Throwable $th) {
            print "!Error¡: " . $th->getMessage();
            die();
        }
    }

    public function select1($attr,$table,$where,$param)
    {
        try {
            $where = $where ?? "";
            $query = "SELECT ".$attr." FROM ".$table.$where;
            $sth = $this->pdo->prepare($query);
            $sth->execute($param);
            $response = $sth->fetchAll(PDO::FETCH_ASSOC);
            return array("results" => $response);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        $pdo = null;
    }

    function select2($attr,$table,$pagi_inicial,$pagi_cuantos,$where,$param){
        try{
            $query = "SELECT ".$attr." FROM ".$table.$where." LIMIT $pagi_inicial,$pagi_cuantos";
            $sth = $this->pdo->prepare($query);
            $sth->execute($param);
            $response = $sth->fetchAll(PDO::FETCH_ASSOC);
            return array("results" => $response);
        }catch (PDOException $e){
            return $e->getMessage();
        }
        $pdo = null;
    }

    public function select3($attr,$table1,$table2,$condition,$where,$param)
    {
        try {
            $where = $where ?? "";
            $query = "SELECT ".$attr." FROM ".$table1." INNER JOIN ".$table2." ON ".$condition.$where;
            $sth = $this->pdo->prepare($query);
            $sth->execute($param);
            $response = $sth->fetchAll(PDO::FETCH_ASSOC);
            return array("results" => $response);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        $pdo = null;
    }
}
?>
