<?php

namespace App\Enums;

enum Nilai: string
{
    case SANGATPUAS     = 'Sangat Puas';
    case PUAS           = 'Puas';
    case CUKUPPUAS      = 'Cukup Puas';
    case TIDAKPUAS      = 'Tidak Puas';
    case SANGATIDAKPUAS = 'Sangat Tidak Puas';

    public function labels(): string
    {
        return match ($this) {
            self::SANGATPUAS     => 'SANGAT PUAS',
            self::PUAS           => 'PUAS',
            self::CUKUPPUAS      => 'CUKUP PUAS',
            self::TIDAKPUAS      => 'TIDAK PUAS',
            self::SANGATIDAKPUAS => 'SANGATIDAKPUAS',
        };
    }

    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
