<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\ClassMethod\ExplicitReturnNullRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;

return RectorConfig::configure()
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withPaths([
        '.',
    ])
    ->withSkip([
        __DIR__ . '/vendor/*',
        ExplicitReturnNullRector::class, // No add return null
        ExplicitBoolCompareRector::class,
        UseIdenticalOverEqualWithSameTypeRector::class,
        AddVoidReturnTypeWhereNoReturnRector::class, // TypeCoverageLevel(20)
        ReturnNeverTypeRector::class, // TypeCoverageLevel(45) php 8.1
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
    );
