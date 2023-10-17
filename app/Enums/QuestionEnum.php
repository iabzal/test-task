<?php

declare(strict_types = 1);

namespace App\Enums;

enum QuestionEnum:string {
    case created = 'Создан';
    case answered = 'Отвечен';

    /**
     * @param string $name
     * @return string
     */
    public static function fromName(string $name): mixed
    {
        return constant("self::$name")->value;
    }
}
