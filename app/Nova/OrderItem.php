<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderItem extends Resource
{
    public static $model = \App\Models\OrderItem::class;

    public static $title = 'product_name';

    public static $displayInNavigation = false;

    public static function label()
    {
        return 'รายการสินค้าในคำสั่งซื้อ';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('คำสั่งซื้อ', 'order', Order::class),

            BelongsTo::make('สินค้า', 'product', Product::class)
                ->nullable(),

            Text::make('ชื่อสินค้า', 'product_name')
                ->readonly(),

            Currency::make('ราคา', 'product_price')
                ->currency('THB')
                ->readonly(),

            Number::make('จำนวน', 'quantity')
                ->readonly(),

            Currency::make('ยอดรวม', 'subtotal')
                ->currency('THB')
                ->readonly(),
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
