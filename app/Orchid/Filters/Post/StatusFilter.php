<?php

namespace App\Orchid\Filters\Post;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Select;

class StatusFilter extends Filter
{
    public function name(): string
    {
        return __('Status');
    }

    public function parameters(): ?array
    {
        return ['is_published'];
    }

    public function run(Builder $builder): Builder
    {
        return $builder->where('is_published', $this->request->get('is_published'));
    }

    public function display(): iterable
    {
        return [
            Select::make('is_published')
                ->options([
                    '' => __('All'),
                    '0' => __('Draft'),
                    '1' => __('Published'),
                ])
                ->value($this->request->get('is_published'))
                ->title(__('Status')),
        ];
    }
}
