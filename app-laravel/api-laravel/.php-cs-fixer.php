<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/app')
    ->in(__DIR__.'/packages');

return (new PhpCsFixer\Config())
    ->setCacheFile(__DIR__.'/bootstrap/cache/.php_cs.cache')
    ->setRules([
        '@PSR12' => true,
        'trailing_comma_in_multiline' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'trim_array_spaces' => true,
        'no_empty_comment' => true,
        'no_alternative_syntax' => true,
        'no_unneeded_control_parentheses' => true,
        'type_declaration_spaces' => true,
        'single_space_around_construct' => true,
        'no_unused_imports' => true,
        'binary_operator_spaces' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'object_operator_without_whitespace' => true,
        'align_multiline_comment' => true,
        'general_phpdoc_tag_rename' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_phpdoc' => true,
        'no_useless_return' => true,
        'no_empty_statement' => true,
        'phpdoc_indent' => true,
        'phpdoc_var_without_name' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_types' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_trim' => true,
        'phpdoc_summary' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_scalar' => true,
        'phpdoc_return_self_reference' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'declare_strict_types' => true,
        'strict_comparison' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true);
