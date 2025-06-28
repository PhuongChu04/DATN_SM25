<?php

namespace App\Enums;

enum OrderStatus: string
{
    // Progress steps
    case Confirming = 'confirming';
    case Pending    = 'pending';
    case Processing = 'processing';
    case Shipping   = 'shipping';
    case Delivered  = 'delivered';
    case Returned   = 'returned';
    case Canceled   = 'canceled';

    /**
     * Những trạng thái admin được phép chỉnh (ngoại trừ delivered, canceled, returned)
     */
    public static function editableStatuses(): array
    {
        return [
        self::Confirming->value,
        self::Pending->value,
        self::Processing->value,
        self::Shipping->value,
        self::Delivered->value,
        self::Returned->value,
        self::Canceled->value,
    ];
    }

    /**
     * 5 bước chính cho progress bar
     */
    public static function progressSteps(): array
    {
        return [
            self::Confirming->value,
            self::Pending->value,
            self::Processing->value,
            self::Shipping->value,
            self::Delivered->value,
        ];
    }

    /**
     * Tất cả giá trị enum (dùng validate chung)
     */
    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }
}
