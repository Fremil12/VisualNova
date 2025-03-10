<?php 
class Table {
    private $name;
    private $fields;
    /**
     * @param string $name
     * @param array $fields
     */
    public function __construct($name, $fields) {
        $this->name = $name;
        $this->fields = $fields;
    }

    /**
     * @param mysqli $mysqli
     * @param string $modifiers
     */
    public function select($mysqli, $modifiers = "") {
        $sql = "SELECT ";
        $fields = $this->getFields(true);
        $keys = count($fields);
        $current = 1;
        foreach($fields as $field => $type) {
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

    /**
     * @param mysqli $mysqli
     * @param array $updatedEntry
     * @param string $modifiers
     */
    public function update($mysqli, $updatedEntry, $modifiers) {
        $sql = "UPDATE `$this->name` SET ";
        $fields = $this->getFields();
        $keys = count($fields);
        $types = "";
        $values = [];
        $current = 1;
        foreach($fields as $field => $type) {
            $sql .= "`$field` = ?";
            $values[] = $updatedEntry[$field];
            $types .= $type;
            if($current != $keys) {
                $sql .= ", ";
            }
            $current++;
        }
        $sql .= $modifiers == "" ? ";":" $modifiers;";
        $stmnt = $mysqli->prepare($sql);
        $stmnt->bind_param($types, ...$values);
        $result = $stmnt->execute();
        return $result;
    }
    /**
     * @param mysqli $mysqli
     * @param array $entry
     */
    public function insert($mysqli, $entry) {
        $sql = "INSERT INTO `$this->name` (";
        $fields = $this->getFields();
        $keys = count($fields);
        $current = 1;
        foreach($fields as $field => $type) {
            $sql .= "`$field`";
            if($current != $keys) {
                $sql .= ", ";
            }
            $current++;
        }
        $sql .= ") VALUES (";
        $values = [];
        $types = "";
        $current = 1;
        foreach($fields as $field => $type) {
            $sql .= "?";
            $types .= $type;
            $values[] = $entry[$field];
            if($current != $keys) {
                $sql .= ", ";
            }
            $current++;
        }
        $sql .= ");";
        $stmnt = $mysqli->prepare($sql);
        $stmnt->bind_param($types, ...$values);
        $result = $stmnt->execute();
        return $result;
    }
    /**
     * @param mysqli $mysqli
     * @param string $modifiers
     */
    public function delete($mysqli, $modifiers) {
        $sql = "DELETE FROM `$this->name` $modifiers;";
        $result = $mysqli->query($sql);
        return $result;
    }
    /**
     * @param boolean $all
     * @return array
     */
    private function getFields($all = false) {
        $fieldAssoc = [];
        foreach($this->fields as $field => $value) {
            if(is_array($value)) {
                if($value["read_only"] === false || $all === true) {
                    $fieldAssoc[$value["name"]] = $value["type"];
                }
            }else {
                $fieldAssoc[$field] = $value;
            }
        }
        return $fieldAssoc;
    }
}

class Database {
    private $msqli;
    private $tables;

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $name
     */
    public function __construct($hostname, $username, $password, $name) {
        $this->msqli = new mysqli($hostname, $username, $password, $name);
        $this->tables = [];
    }
    /**
     * A táblához szükséges tömb formátuma: ["mező_név" => "típus "]
     * A típusok lehetnek: i (integer), d (double), s (string) <br>
     * Csak olvasható (vagyis módosíthatatlan és nem kötelező megadni insertnél) mezőket ilyen formátummal lehet megadni:<br>
     * [["name" => "mező_név", "type" => "típus", "read_only" => true]]<br>
     * A kétféle mező típust egy tömbbe is be lehet rakni pl.: <br>
     * [["name"=>"szemely_id", "type"=>"i", "read_only"=>true], "szemely_nev" => "s", "szemely_eletkor" => "i"]
     * @param string $tableName
     * @param array $fieldsAssoc
     * @return void
     */
    public function mapTable($tableName, $fieldsAssoc) {
        $this->tables[$tableName] = new Table($tableName, $fieldsAssoc);
    }
    /**
     * @param string $tableName
     * @return Table
     */
    public function getTable($tableName) {
        return $this->tables[$tableName];
    }
    /**
     * @return mysqli
     */
    public function getMysqli() {
        return $this->msqli;
    }

    public function __destruct() {
        $this->msqli->close();
    }

}

?>