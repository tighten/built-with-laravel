<?php

namespace App\Enums;

enum SuggestionStatus: string
{
    case Unreviewed = 'unreviewed';
    case Accepted = 'accepted';
    case RejectedForNow = 'rejected_for_now';

    public function label(): string
    {
        return match ($this) {
            self::Unreviewed => 'Unreviewed',
            self::Accepted => 'Accepted',
            self::RejectedForNow => 'Rejected for Now',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Unreviewed => 'gray',
            self::Accepted => 'success',
            self::RejectedForNow => 'danger',
        };
    }
}
