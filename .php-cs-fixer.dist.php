<?php

use PhpCsFixer\Config;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$rules = [
    '@PSR12' => true,
    '@PhpCsFixer' => true,
    '@PHP8x4Migration' => true,
    'no_superfluous_phpdoc_tags' => false,
    'linebreak_after_opening_tag' => true,
    'phpdoc_to_comment' => false,
    'php_unit_test_class_requires_covers' => false,
    'single_line_comment_style' => false,
    'phpdoc_var_without_name' => false,
    'phpdoc_summary' => false,
    'phpdoc_types_order' => [
        'null_adjustment' => 'always_last',
    ],
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'phpdoc_align' => [
        'align' => 'left',
    ],
    'list_syntax' => [
        'syntax' => 'short',
    ],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
    ],
    'concat_space' => [
        'spacing' => 'one',
    ],
    'class_definition' => [
        'single_line' => false,
        'multi_line_extends_each_single_line' => true,
    ],
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'phpdoc_no_alias_tag' => false,
    'phpdoc_line_span' => [
        'property' => 'single',
        'const' => 'single',
    ],
    'single_line_throw' => false,
    'yoda_style' => false,
    'explicit_string_variable' => false,
    'simple_to_complex_string_variable' => false,
    'multiline_comment_opening_closing' => false,
    'phpdoc_order' => true,
    'php_unit_internal_class' => false,
    'phpdoc_tag_type' => [
        'tags' => ['inheritDoc' => 'annotation']
    ],
    'phpdoc_trim' => true,
    'global_namespace_import' => [
        'import_classes' => true,
        'import_constants' => null,
        'import_functions' => null,
    ],
    'declare_strict_types' => [
        'preserve_existing_declaration' => false,
    ],
];

return (new Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__ . '/.rector')
            ->in(__DIR__ . '/config')
            ->in(__DIR__ . '/public')
            ->in(__DIR__ . '/src')
    );
