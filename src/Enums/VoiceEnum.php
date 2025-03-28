<?php

namespace Michaeld555\AudioGeneratorField\Enums;

enum VoiceEnum: string
{
    case ALLOY = 'alloy';
    case ECHO = 'echo';
    case FABLE = 'fable';
    case ONYX = 'onyx';
    case NOVA = 'nova';
    case SHIMMER = 'shimmer';

    public static function getVoicesByLanguageId(string | null $languageId = null): array
    {
        // languageId is ignored now; included only for compatibility
        return [
            self::ALLOY->value => 'Alloy',
            self::ECHO->value => 'Echo',
            self::FABLE->value => 'Fable',
            self::ONYX->value => 'Onyx',
            self::NOVA->value => 'Nova',
            self::SHIMMER->value => 'Shimmer',
        ];
    }
}
