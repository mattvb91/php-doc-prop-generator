<?php

include __DIR__ . '/../vendor/autoload.php';

$pdo = new PDO('mysql:dbname=oxid;host=127.0.0.1', 'root', 'root');
\mattvb91\LightModel\LightModel::init($pdo);

/**   $tables */
$tables = $pdo->prepare('SHOW TABLES');
$tables->execute();
$tables = $tables->fetchAll(PDO::FETCH_COLUMN);

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

if (! is_dir(__DIR__ . '/generated'))
{
    mkdir(__DIR__ . '/generated');
}

foreach ($tables as $table)
{
    $table = new \mattvb91\LightModel\DB\Table($table);

    $res = '<?php' . PHP_EOL . PHP_EOL . 'namespace docProps;' . PHP_EOL . PHP_EOL;
    $res .= '/**' . PHP_EOL;
    $res .= ' * AUTO GENERATED! ONLY USE FOR @mixin documentation' . PHP_EOL;

    /** @var \mattvb91\LightModel\DB\Column $column */
    foreach ($table->getColumns() as $column)
    {
        $res .= ' * @property ' . (array_key_exists($column->getType(), $casts) ? $casts[$column->getType()] : $column->getType()) . ' ' . $column->getField() . PHP_EOL;
    }

    $res .= ' */' . PHP_EOL;
    $res .= 'class ' . $table->getName() . 'Props {}';

    file_put_contents(__DIR__ . '/generated/' . $table->getName() . 'Props.php', $res . PHP_EOL);
}

/**
 * Class article
 * @mixin \docProps\oxarticlesProps
 */
class article
{

    public function test()
    {
    }
}
