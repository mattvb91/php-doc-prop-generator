<?php

namespace mattvb91\DocPropGenerator\Formatter;

use mattvb91\LightModel\DB\Column;
use mattvb91\LightModel\DB\Table;

/**
 * Interface FormatterInterface
 *
 * Format a field name.
 */
interface FormatterInterface
{

    public function formatField(Table $table, Column $column): string;
}