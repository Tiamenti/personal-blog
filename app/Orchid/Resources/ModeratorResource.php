<?php

namespace App\Orchid\Resources;

use App\Orchid\Traits\I18nButtons;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ModeratorResource extends Resource
{
    use I18nButtons;

    private ?Role $role;
    public static $model = \App\Models\User::class;

    public function __construct()
    {
        $this->role = Role::where('slug', 'moderator')->first();
    }

    public function fields(): array
    {
        return [
            Input::make('name')
                ->title(__('Name'))
                ->maxlength(255)
                ->required(),

            Input::make('email')
                ->type('email')
                ->title(__('Email'))
                ->maxlength(255)
                ->required(),

            Password::make('password')
                ->title(__('Password'))
                ->maxlength(255),
        ];
    }

    public function columns(): array
    {
        return [
            TD::make('id', 'ID'),

            TD::make('name', __('Name')),

            TD::make('email', __('Email')),

            TD::make('created_at', __('Date of creation')),
        ];
    }

    public function legend(): array
    {
        return [
            Sight::make('id', 'ID'),

            Sight::make('name', __('Name')),

            Sight::make('email', __('Email')),

            Sight::make('created_at', __('Date of creation')),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function save(ResourceRequest $request, Model $model): void
    {
        if (!$this->role) {
            return;
        }

        $validated = collect($request->validated()['model'])->filter();
        $model->fill($validated->toArray())->save();

        if (!$model->exists) {
            $model->addRole($this->role);
        }
    }

    public function rules(Model $model): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => [
                'nullable',
                Rule::requiredIf(fn() => !$model->exists),
                'string',
                'max:255',
            ],
        ];
    }

    public static function permission(): ?string
    {
        return 'moderators';
    }

    public function modelQuery(ResourceRequest $request, Model $model): Builder
    {
        return $this->query($model);
    }

    public function paginationQuery(ResourceRequest $request, Model $model): Builder
    {
        return $this->query($model);
    }

    private function query(Model $model): Builder
    {
        if ($this->role) {
            $userIds = $this->role->users()->pluck('id')->toArray();
            return $model->whereIn('id', $userIds);
        }

        return $model->where('id', 0);
    }

    public static function icon(): string
    {
        return 'bs.people';
    }

    public static function label(): string
    {
        return __('Moderators');
    }

    public static function singularLabel(): string
    {
        return __('Moderator');
    }
}
