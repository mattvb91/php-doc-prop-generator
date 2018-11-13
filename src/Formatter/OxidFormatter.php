<?php

namespace mattvb91\DocPropGenerator\Formatter;

use mattvb91\LightModel\DB\Column;
use mattvb91\LightModel\DB\Table;

/**
 * Class OxidFormatter
 * @package mattvb91\DocPropGenerator\Formatter
 */
class OxidFormatter implements FormatterInterface
{

    public function formatField(Table $table, Column $column): string
    {
        return strtolower($table->getName() . '__' . $column->getField());
    }
}