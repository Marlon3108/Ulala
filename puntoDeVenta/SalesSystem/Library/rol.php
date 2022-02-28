<?php
    declare (strict_types = 1);
    class rol extends connection
    {
        public function __construct() {
            parent::__construct();
        }
        public function asignarRoles()
        {
            try {
                $this->db->pdo->beginTransaction();
                //aquí van los roles que quiero en el sistema
                $listRoles = array("Admin","User");
                $where = "WHERE Role = :Role";
                foreach ($listRoles as $key => $value){
                    $roles = $this->db->select1("Role",'troles',$where,array('Role' => $value));
                    if (is_array($roles)){
                        if (0 == count($roles['results'])) {
                            $query = "INSERT INTO troles (Role) VALUES (:Role)";
                            $sth = $this->db->pdo->prepare($query);
                            $sth->execute((array)$this->troles(array($value)));
                        }
                    }else{
                        break;
                        return $roles;
                    }
                }
                $this->db->pdo->commit();
            } catch (\Throwable $th) {
                $this->db->pdo->rollBack();
                return $th->getMessage();
            }
        }
        public function troles(array $array){
            return new class($array){
                var $Role;
                function __construct($array){
                    if(0 < count($array)){
                        $this->Role = $array[0];
                    }
                }
            };
        }
        public function getRoles()
        {
            $roles = $this->db->select1("*",'troles',null,null);
            if (is_array($roles)) {
                if(0 < count($roles['results'])){
                    return $roles['results'];
                }
            } else {
                return $roles;
            }
            
        }
    }
    
?>
