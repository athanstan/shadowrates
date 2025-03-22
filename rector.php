<?php

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
    ]);

    // register sets
    $rectorConfig->sets([
        SetList::PHP_80,
        SetList::CODE_QUALITY,
    ]);
};
