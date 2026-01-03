<?php

namespace App\Support;

class AuditContext
{
    protected static ?int $userId = null;

    public static function setUser(?int $userId): void
    {
        self::$userId = $userId;
    }

    public static function userId(): ?int
    {
        return self::$userId;
    }
}
