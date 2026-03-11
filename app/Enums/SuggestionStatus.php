<?php

namespace App\Enums;

enum SuggestionStatus: string
{
    case Unreviewed = 'unreviewed';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Unreviewed => 'Unreviewed',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Unreviewed => 'gray',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }
}
