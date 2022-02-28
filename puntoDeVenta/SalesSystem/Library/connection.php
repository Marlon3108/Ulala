<?php
class connection
{
    function __construct() {
        $this->db = new queryManager("root","","SalesSystem");
    }
}
?>
