<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    public static $model = \App\Models\Order::class;

    public static $title = 'order_number';

    public static $search = [
        'id',
        'order_number',
        'customer_name',
        'customer_email',
    ];

    public static function label()
    {
        return 'คำสั่งซื้อ';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('เลขที่คำสั่งซื้อ', 'order_number')
                ->sortable()
                ->readonly(),

            BelongsTo::make('ลูกค้า', 'user', User::class)
                ->nullable()
                ->showOnIndex(),

            Badge::make('สถานะ', 'status')->map([
                'pending' => 'warning',
                'processing' => 'info',
                'shipped' => 'info',
                'delivered' => 'success',
                'cancelled' => 'danger',
            ])->sortable(),

            Select::make('สถานะ', 'status')
                ->options([
                    'pending' => 'รอชำระเงิน',
                    'processing' => 'กำลังจัดเตรียม',
                    'shipped' => 'จัดส่งแล้ว',
                    'delivered' => 'ได้รับสินค้าแล้ว',
                    'cancelled' => 'ยกเลิก',
                ])
                ->displayUsingLabels()
                ->hideFromIndex(),

            Currency::make('ยอดรวม', 'subtotal')
                ->currency('THB')
                ->sortable(),

            Currency::make('ค่าจัดส่ง', 'shipping')
                ->currency('THB'),

            Currency::make('ยอดรวมทั้งหมด', 'total')
                ->currency('THB')
                ->sortable(),

            Text::make('ชื่อลูกค้า', 'customer_name')
                ->sortable(),

            Text::make('อีเมล', 'customer_email')
                ->hideFromIndex(),

            Text::make('เบอร์โทร', 'customer_phone')
                ->hideFromIndex(),

            Textarea::make('ที่อยู่จัดส่ง', 'shipping_address')
                ->hideFromIndex(),

            Select::make('วิธีชำระเงิน', 'payment_method')
                ->options([
                    'transfer' => 'โอนเงิน',
                    'cod' => 'เก็บเงินปลายทาง',
                ])
                ->displayUsingLabels()
                ->hideFromIndex(),

            Textarea::make('หมายเหตุ', 'notes')
                ->hideFromIndex()
                ->nullable(),

            DateTime::make('สั่งซื้อเมื่อ', 'created_at')
                ->sortable()
                ->readonly(),

            HasMany::make('รายการสินค้า', 'items', OrderItem::class),
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
