<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Arr('title');
    $field->displayName('Display Name')
        ->instructions('Enter the title')
        ->visibility(VisibilityOption::Hidden)
        ->required()
        ->instructionsPosition('below')
        ->listable()
        ->replicatorPreview(true)
        ->width(50);

    expect($field->toArray()['field']['display'])->toBe('Display Name');

    expect($field->toArray()['field']['instructions'])->toBe('Enter the title');

    expect($field->toArray()['field']['visibility'])->toBe('hidden');

    expect($field->toArray()['field']['validate'])->toBe(['required']);

    expect($field->toArray()['field']['instructions_position'])->toBe('below');

    expect($field->toArray()['field']['listable'])->toBe(true);

    expect($field->toArray()['field']['replicator_preview'])->toBe(true);

    expect($field->toArray()['field']['width'])->toBe(50);

    expect($field->toArray()['field']['type'])->toBe('array');
});

it('can render to a array with mode', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Arr('title');
    $field->mode(\Tdwesten\StatamicBuilder\Enums\ArrayModeOption::Dynamic);

    expect($field->toArray()['field']['mode'])->toBe('dynamic');
});

it('can render to a array with keys', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Arr('title');
    $field->keys([
        'country' => 'United States',
        'city' => 'New York',
    ]);

    expect($field->toArray()['field']['keys'])->toBe([
        'country' => 'United States',
        'city' => 'New York',
    ]);
});
