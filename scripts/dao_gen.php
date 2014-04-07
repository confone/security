<?php
$db_host = "192.168.0.119";
$db_user = "root";
$db_pass = "Langara2";
$db_sche = $argv[1];
$base_class = 'SecurityDaoBase';

$conn = mysqli_connect("p:".$db_host, $db_user, $db_pass, $db_sche.'_0');
$sql = "SHOW TABLES";
$tableResult = $conn->query($sql);

while ($tableRow = $tableResult->fetch_array(MYSQLI_ASSOC)) {
    $table = reset($tableRow);
    echo $table.PHP_EOL;

    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);
    $fields = array();
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($fields, $row["Field"]);
    }

    $sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
    $primaryResult = $conn->query($sql);
    $primaryKeyArr = $primaryResult->fetch_array(MYSQLI_ASSOC);

    $content = genClass($table, $fields, $primaryKeyArr['Column_name']);
    file_put_contents('../dao/parent/'.to_camel_case("_".$table."DaoParent.php"), $content);
}

function genClass($table, $fields, $primaryKey) {
	global $base_class, $db_sche;
    $rv = "<?php".PHP_EOL;
    $class = to_camel_case("_".$table."DaoParent");
    $rv.= "abstract class $class extends $base_class {".PHP_EOL.PHP_EOL;
    $rv.= "    protected function init() {".PHP_EOL;
    foreach ($fields as $field) {
        $rv.= "        \$this->var['$field'] = '';".PHP_EOL;
    }
    $rv.= PHP_EOL;
    foreach ($fields as $field) {
        $rv.= "        \$this->update['$field'] = false;".PHP_EOL;
    }
    $rv.= "    }".PHP_EOL.PHP_EOL;
    foreach ($fields as $field) {
        if ($field!=$primaryKey) {
            $setter = to_camel_case("set_$field(\$$field)");
            $rv.= "    public function $setter {".PHP_EOL;
            $rv.= "        \$this->var['$field'] = \$".to_camel_case($field).";".PHP_EOL;
            $rv.= "        \$this->update['$field'] = true;".PHP_EOL;
            $rv.= "    }".PHP_EOL;
        }
        $getter = to_camel_case("get_$field()");
        $rv.= "    public function $getter {".PHP_EOL;
        $rv.= "        return \$this->var['$field'];".PHP_EOL;
        $rv.= "    }".PHP_EOL.PHP_EOL;
    }
    $rv.= "// ======================================================================================== override".PHP_EOL.PHP_EOL;
    $rv.= "    public function getTableName() {".PHP_EOL;
    $rv.= "        return '$table';".PHP_EOL;
    $rv.= "    }".PHP_EOL.PHP_EOL;
    $rv.= "    protected function getIdColumnName() {".PHP_EOL;
    $rv.= "        return '$primaryKey';".PHP_EOL;
    $rv.= "    }".PHP_EOL.PHP_EOL;
    $rv.= "    public function getShardDomain() {".PHP_EOL;
    $rv.= "        return '$db_sche';".PHP_EOL;
    $rv.= "    }".PHP_EOL;
    $rv.= "}".PHP_EOL."?>";

    return $rv;
}

function from_camel_case($str) {
    $str[0] = strtolower($str[0]);
    $func = create_function('$c', 'return "_" . strtolower($c[1]);');
    return preg_replace_callback('/([A-Z])/', $func, $str);
}

function to_camel_case($str, $capitalise_first_char = false) {
    if($capitalise_first_char) {
        $str[0] = strtoupper($str[0]);
    }
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $str);
}