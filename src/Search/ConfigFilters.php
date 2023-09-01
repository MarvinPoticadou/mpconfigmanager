<?php
namespace Mp\Module\MpConfigManager\Search;

use PrestaShop\PrestaShop\Core\Search\Filters;

final class ConfigFilters extends Filters
{
    public static function getDefaults(): array
    {
        return [
            'limit' => 0,
            'offset' => 0,
            'orderBy' => 'id_configuration',
            'sortOrder' => 'desc',
            'filters' => [],
        ];
    }
}
