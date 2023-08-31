<?php

namespace App\Enums;

enum ProductCategory : int
{
    case ELECTRONIC = 1;
    case CLOTHING = 2;
    case HOME_FURNITURE = 3;
    case BEAUTY_PERSONAL_CARE = 4;
    case SPORT_OUTDOOR = 5;

    public function label() : string
    {
        return match($this)
        {
            self::ELECTRONIC => 'Electonics',
            self::CLOTHING => 'Clothing',
            self::HOME_FURNITURE => 'Home & Furnitures',
            self::BEAUTY_PERSONAL_CARE => 'Beauty & Personal Care',
            self::SPORT_OUTDOOR => 'Sports & Outdoors'
        };
    }

    public static function search(string $type) : array
    {
        $matches = [];

        foreach (self::cases() as $case) {
            $name = (new self($case))->name();

            if (str_contains(strtolower($name), strtolower($type))) {
                $matches[] = $value;
            }
        }

        return $matches;
    }
}