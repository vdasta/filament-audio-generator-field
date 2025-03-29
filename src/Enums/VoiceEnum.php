<?php

namespace Michaeld555\AudioGeneratorField\Enums;

alloy
ash
ballad
coral
echo
fable
onyx
nova
sage
shimmer

enum VoiceEnum: string
{
    case ALLOY = 'alloy';
    case ASH = 'ash';
    case BALLAD = 'ballad';
    case CORAL = 'coral';
    case ECHO = 'echo';
    case FABLE = 'fable';
    case ONYX = 'onyx';
    case NOVA = 'nova';
    case SAGE = 'sage';
    case SHIMMER = 'shimmer';

    public static function getVoicesByLanguageId(string | null $languageId = null): array
    {
        // languageId is ignored now; included only for compatibility
        return [
            self::ALLOY->value => 'Alloy',
            self::ASH->value => 'Ash',
            self::BALLAD->value => 'Ballad',
            self::CORAL->value => 'Coral',
            self::ECHO->value => 'Echo',
            self::FABLE->value => 'Fable',
            self::ONYX->value => 'Onyx',
            self::NOVA->value => 'Nova',
            self::SAGE->value => 'Sage',
            self::SHIMMER->value => 'Shimmer',
        ];
    }
}
