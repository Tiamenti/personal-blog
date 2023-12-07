<?php

namespace App\Orchid\Traits;

trait I18nButtons
{
    public static function createButtonLabel(): string
    {
        return __('Create');
    }

    public static function updateButtonLabel(): string
    {
        return __('Update');
    }

    public static function deleteButtonLabel(): string
    {
        return __('Delete');
    }
}
