<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    public static $model = \App\Models\Category::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
        'slug',
    ];

    public static function label()
    {
        return 'หมวดหมู่สินค้า';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('ชื่อหมวดหมู่', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:categories,name')
                ->updateRules('unique:categories,name,{{resourceId}}'),

            Text::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:categories,slug')
                ->updateRules('unique:categories,slug,{{resourceId}}')
                ->help('URL-friendly version of the name'),

            Image::make('รูปภาพ', 'image')
                ->disk('public')
                ->nullable(),

            Boolean::make('เปิดใช้งาน', 'is_active')
                ->sortable()
                ->default(true),

            HasMany::make('สินค้า', 'products', Product::class),
        ];
    }

    public function cards(NovaRequest $request): array
    {
        return [];
    }

    public function filters(NovaRequest $request): array
    {
        return [];
    }

    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
