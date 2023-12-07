<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class PerPageFilter extends Filter
{
    public function name(): string
    {
        return __('Show records:');
    }

    public function parameters(): ?array
    {
        return ['per_page'];
    }

    public function run(Builder $builder): Builder
    {
        return $builder;
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Input::make('per_page')
                ->type('number')
                ->min(1)
                ->title(__('Show records:')),
        ];
    }
}
