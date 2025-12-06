<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\TypeDeclaration\Rector\Class_\PropertyTypeFromStrictSetterGetterRector;
use Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromDocblockSetUpDefinedRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/public',
        __DIR__ . '/config',
    ])
    ->withPhpSets(php84: true)
    ->withTypeCoverageLevel(0)
    ->withTypeCoverageDocblockLevel(0)
    ->withImportNames(removeUnusedImports: true)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0)
    ->withRules([
        TypedPropertyFromDocblockSetUpDefinedRector::class,
        PropertyTypeFromStrictSetterGetterRector::class,
        TypedPropertyFromAssignsRector::class,
        RemoveUselessVarTagRector::class,
        RemoveUselessReturnTagRector::class,
        RemoveUselessParamTagRector::class,
    ])
    ->withSkip([
        ClosureToArrowFunctionRector::class,
    ]);

