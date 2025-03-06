<?php 
class Table {
    private $name;
    private $fields;

    public function __construct($name, $fields) {
        $this->name = $name;
        $this->fields = $fields;
    }

    public function select($mysqli, $modifiers = "") {
        $sql = "SELECT ";
        $keys = count($this->fields);
        $current = 1;
        foreach($this->fields as $field => $type) {
            $sql .= "`$field`";
            if($current != $keys) {
                $sql .= ", ";
            }
            $current++;
        }
        $sql .= " FROM $this->name".($modifiers == "" ? ";":" $modifiers;");

        $result = $mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

class Database {
    private $msqli;
    private $tables;

    public function __construct($hostname, $username, $password, $name) {
        $this->msqli = new mysqli($hostname, $username, $password, $name);
        $this->tables = [];
    }

    public function mapTable($tableName, $fieldsAssoc) {
        $this->tables[$tableName] = new Table($tableName, $fieldsAssoc);
    }

    public function getTable($tableName) {
        return $this->tables[$tableName];
    }

    public function getMysqli() {
        return $this->msqli;
    }

    public function __destruct() {
        $this->msqli->close();
    }

}

?>