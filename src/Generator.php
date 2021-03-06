<?php

namespace mattvb91\DocPropGenerator;

use mattvb91\LightModel\DB\Table;
use mattvb91\LightModel\LightModel;

/**
 * Class Generator
 * @package mattvb91\DocPropGenerator
 */
class Generator
{

    private $_pdo, $_namespace;

    public function __construct(string $dbHost,
                                string $dbName,
                                string $dbUser,
                                string $dbPass,
                                string $namespace = "DocProps"
    )
    {
        $this->_pdo = new \PDO('mysql:dbname=' . $dbName . ';host=' . $dbHost, $dbUser, $dbPass);
        LightModel::init($this->_pdo);

        $this->_namespace = $namespace;
    }

    public function generate()
    {
        $tables = $this->_pdo->prepare('SHOW TABLES');
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

        if (! is_dir(__DIR__ . '/../generated'))
        {
            mkdir(__DIR__ . '/../generated');
        }

        foreach ($tables->fetchAll(\PDO::FETCH_COLUMN) as $table)
        {
            $table = new Table($table);

            $out = '<?php' . PHP_EOL . PHP_EOL . 'namespace ' . $this->_namespace . ';' . PHP_EOL . PHP_EOL;
            $out .= '/**' . PHP_EOL;
            $out .= ' * AUTO GENERATED! ONLY USE FOR @mixin documentation' . PHP_EOL;

            /** @var \mattvb91\LightModel\DB\Column $column */
            foreach ($table->getColumns() as $column)
            {
                $out .= ' * @property ' . (array_key_exists($column->getType(), $casts) ? $casts[$column->getType()] : $column->getType()) . ' ' . $column->getField() . PHP_EOL;
            }

            $out .= ' */' . PHP_EOL;
            $out .= 'final class ' . $table->getName() . 'Props {}';

            file_put_contents(__DIR__ . '/../generated/' . $table->getName() . 'Props.php', $out . PHP_EOL);
        }
    }
}