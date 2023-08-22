<?php

use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return function (RectorConfig $rectorConfig) {

    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/routes'
    ]);

    $rectorConfig->sets([
        LevelSetList::class::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE
    ]);
};
