<?php

namespace mattvb91\DocPropGenerator;

use mattvb91\LightModel\DB\Table;
use mattvb91\LightModel\LightModel;
use PDO;

class Generator
{
    private $_pdo;

    public function __construct()
    {
        LightModel::init($this->getPdo());
    }

    public function generate()
    {
        $tables = $this->getPdo()->prepare('SHOW TABLES');
        $tables->execute();

        $casts = [
            'char'      => 'string',
            'blob'      => 'string',
            'varchar'   => 'string',
            'text'      => 'string',
            'double'    => 'float',
            'timestamp' => 'string',
            'enum'      => 'mixed',
            'datetime'  => 'string',
            'date'      => 'string',
        ];

        if (!is_dir(__DIR__ . '/generated')) {
            mkdir(__DIR__ . '/generated');
        }

        foreach ($tables->fetchAll(PDO::FETCH_COLUMN) as $table) {
            $table = new Table($table);

            $res = '<?php' . PHP_EOL . PHP_EOL . 'namespace DocProps;' . PHP_EOL . PHP_EOL;
            $res .= '/**' . PHP_EOL;
            $res .= ' * AUTO GENERATED! ONLY USE FOR @mixin documentation' . PHP_EOL;

            /** @var \mattvb91\LightModel\DB\Column $column */
            foreach ($table->getColumns() as $column) {
                $res .= ' * @property ' . (array_key_exists($column->getType(), $casts) ? $casts[$column->getType()] : $column->getType()) . ' ' . $column->getField() . PHP_EOL;
            }

            $res .= ' */' . PHP_EOL;
            $res .= 'class ' . $table->getName() . 'Props {}';

            file_put_contents(__DIR__ . '/generated/' . $table->getName() . 'Props.php', $res . PHP_EOL);
        }
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        if (!$this->_pdo) {
            $this->_pdo = new PDO('mysql:dbname=oxid;host=127.0.0.1', 'root', 'root');
        }

        return $this->_pdo;
    }
}