<?php

namespace App\Orchid\Filters\Post;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class CategoryFilter extends Filter
{
    public function name(): string
    {
        return __('Categories');
    }

    public function parameters(): ?array
    {
        return ['category_id'];
    }

    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('category', function (Builder $builder) {
            $builder->where('id', $this->request->get('category_id'));
        });
    }

    public function display(): iterable
    {
        return [
            Select::make('category_id')
                ->fromModel(PostCategory::class, 'name', 'id')
                ->empty()
                ->value($this->request->get('category_id'))
                ->title(__('Categories')),
        ];
    }
}
