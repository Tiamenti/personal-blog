<?php

namespace App\Orchid\Resources;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PostResource extends Resource
{
    public static $model = \App\Models\Post::class;

    public function with(): array
    {
        return ['category'];
    }

    public function fields(): array
    {
        return [
            Select::make('category_id')
                ->title(__('Category'))
                ->fromModel(PostCategory::class, 'name', 'id')
                ->empty(__('No category')),

            Input::make('title')
                ->title(__('Name'))
                ->maxlength(255)
                ->required(),

            Input::make('slug')
                ->title(__('Slug'))
                ->maxlength(255)
                ->required(),

            Quill::make('content')
                ->title(__('Content'))
                ->required(),

            Picture::make('image')
                ->title(__('Image'))
                ->targetRelativeUrl(),

            CheckBox::make('is_published')
                ->title(__('Published'))
                ->sendTrueOrFalse(),
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('image', __('Image'))->render(fn($model) => $this->renderImage($model)),

            TD::make('title', __('Name')),

            TD::make('category.name', __('Category')),

            TD::make('created_at', 'Date of creation'),

            TD::make('is_published', __('Status'))->render(fn($model) => $this->renderBadge($model)),
        ];
    }

    public function legend(): array
    {
        return [
            Sight::make('id', 'ID'),

            Sight::make('category.name', __('Category')),

            Sight::make('title', __('Name')),

            Sight::make('slug', __('Slug')),

            Sight::make('content', __('Content'))->render(function ($model) {
                return $model->content;
            }),

            Sight::make('image', __('Image'))->render(fn($model) => $this->renderImage($model)),

            Sight::make('is_published', __('Status'))->render(fn($model) => $this->renderBadge($model)),

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
            'category_id' => 'nullable|exists:post_categories,id',
            'title' => 'required|max:255',
            'slug' => [
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique(self::$model, 'slug')->ignore($model),
            ],
            'content' => 'required|max:10000',
            'image' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
        ];
    }

    private function renderImage($model): View
    {
        return view('platform.crud.partials.image-thumbnail', [
            'src' => $model->image,
            'alt' => $model->title,
        ]);
    }

    private function renderBadge($model): View
    {
        return view('platform.crud.partials.badge', [
            'color' => $model->is_published ? 'success' : 'secondary',
            'label' => __($model->is_published ? 'Published' : 'Draft'),
        ]);
    }
}
