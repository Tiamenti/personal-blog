<?php

namespace App\Orchid\Resources;

use App\Orchid\Traits\I18nButtons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PostCategoryResource extends Resource
{
    use I18nButtons;

    public static $model = \App\Models\PostCategory::class;

    public function with(): array
    {
        return ['posts'];
    }

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

            TD::make('posts_count', __('Posts count'))->render(fn($model) => $model->posts->count()),

            TD::make('created_at', __('Date of creation')),
        ];
    }

    public function legend(): array
    {
        return [
            Sight::make('id', 'ID'),

            Sight::make('name', __('Name')),

            Sight::make('slug', __('Slug')),

            Sight::make('posts', __('Posts'))
                ->render(fn($model) => view('platform.crud.resources.post-category.posts-list', [
                    'model' => $model,
                ])),

            Sight::make('created_at', __('Date of creation')),
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

    public static function permission(): ?string
    {
        return 'posts.create';
    }

    public static function icon(): string
    {
        return 'bs.tag';
    }

    public static function label(): string
    {
        return __('Categories');
    }

    public static function singularLabel(): string
    {
        return __('Category');
    }
}
