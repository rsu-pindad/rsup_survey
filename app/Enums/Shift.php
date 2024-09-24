<?php

namespace App\Enums;

enum Shift: string
{
    case PAGI  = 'pagi';
    case SIANG = 'siang';
    case MALAM = 'malam';

    public function labels(): string
    {
        return match ($this) {
            self::PAGI  => 'PAGI',
            self::SIANG => 'SIANG',
            self::MALAM => 'MALAM',
        };
    }

    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
