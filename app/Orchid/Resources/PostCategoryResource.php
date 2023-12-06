<?php

namespace App\Orchid\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PostCategoryResource extends Resource
{
    public static $model = \App\Models\PostCategory::class;

    public function fields(): array
    {
        return [
            Input::make('name')
                ->title(__('Name'))
                ->maxlength(255)
                ->required(),

            Input::make('slug')
                ->title(__('Slug'))
                ->maxlength(255)
                ->required(),
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('id', 'ID'),

            TD::make('name', __('Name')),

            TD::make('slug', __('Slug')),

            TD::make('created_at', 'Date of creation'),
        ];
    }

    public function legend(): array
    {
        return [
            Sight::make('id', 'ID'),

            Sight::make('name', __('Name')),

            Sight::make('slug', __('Slug')),

            Sight::make('created_at', 'Date of creation'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function rules(Model $model): array
    {
        return [
            'name' => 'required|max:255',
            'slug' => [
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique(self::$model, 'slug')->ignore($model),
            ],
        ];
    }
}
