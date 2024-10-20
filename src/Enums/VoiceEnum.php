<?php

namespace Michaeld555\AudioGeneratorField\Enums;
use Illuminate\Support\Str;

enum VoiceEnum: string
{

    case AMERICAN_ENGLISH = '1';
    case BRITISH_ENGLISH = '2';
    case AUSTRALIAN_ENGLISH = '3';
    case SPECIAL_ENGLISH = '4';
    case SINGING_ENGLISH = '5';
    case FRENCH = '6';
    case GERMAN = '7';
    case INDONESIAN = '8';
    case ITALIAN = '9';
    case JAPANESE = '10';
    case KOREAN = '11';
    case PORTUGUESE = '12';
    case SPANISH = '13';

    public static function getLanguagesWithId(): array
    {
        return [
            self::AMERICAN_ENGLISH->value => Str::ucfirst(__('filament-audio-generator-field::languages.american_english')),
            self::BRITISH_ENGLISH->value => Str::ucfirst(__('filament-audio-generator-field::languages.british_english')),
            self::AUSTRALIAN_ENGLISH->value => Str::ucfirst(__('filament-audio-generator-field::languages.australian_english')),
            self::SPECIAL_ENGLISH->value => Str::ucfirst(__('filament-audio-generator-field::languages.special_english')),
            self::SINGING_ENGLISH->value => Str::ucfirst(__('filament-audio-generator-field::languages.singing_english')),
            self::FRENCH->value => Str::ucfirst(__('filament-audio-generator-field::languages.french')),
            self::GERMAN->value => Str::ucfirst(__('filament-audio-generator-field::languages.german')),
            self::INDONESIAN->value => Str::ucfirst(__('filament-audio-generator-field::languages.indonesian')),
            self::ITALIAN->value => Str::ucfirst(__('filament-audio-generator-field::languages.italian')),
            self::JAPANESE->value => Str::ucfirst(__('filament-audio-generator-field::languages.japanese')),
            self::KOREAN->value => Str::ucfirst(__('filament-audio-generator-field::languages.korean')),
            self::PORTUGUESE->value => Str::ucfirst(__('filament-audio-generator-field::languages.portuguese')),
            self::SPANISH->value => Str::ucfirst(__('filament-audio-generator-field::languages.spanish')),
        ];
    }


    public static function getVoicesByLanguageId(string | null $languageId): array
    {
        return match ($languageId) {
            '1' => [
                'en_us_002' => 'Jessie',
                'en_us_006' => 'Joey',
                'en_us_007' => 'Professor',
                'en_us_009' => 'Scientist',
                'en_us_010' => 'Confidence',
            ],
            '2' => [
                'en_uk_001' => 'Narrator (Chris)',
                'en_uk_003' => 'UK Male 2',
            ],
            '3' => [
                'en_au_001' => 'Metro (Eddie)',
                'en_au_002' => 'Smooth (Alex)',
            ],
            '4' => [
                'en_female_emotional' => 'Peaceful',
                'en_female_samc' => 'Empathetic',
                'en_male_cody' => 'Serious',
                'en_male_narration' => 'Story Teller',
                'en_male_funny' => 'Wacky',
                'en_male_jarvis' => 'Alfred',
                'en_male_santa_narration' => 'Author',
                'en_female_betty' => 'Bae',
                'en_female_makeup' => 'Beauty Guru',
                'en_female_richgirl' => 'Bestie',
                'en_male_cupid' => 'Cupid',
                'en_female_shenna' => 'Debutante',
                'en_male_ghosthost' => 'Ghost Host',
                'en_female_grandma' => 'Grandma',
                'en_male_ukneighbor' => 'Lord Cringe',
                'en_male_wizard' => 'Magician',
                'en_male_trevor' => 'Marty',
                'en_male_deadpool' => 'Mr. GoodGuy (Deadpool)',
                'en_male_ukbutler' => 'Mr. Meticulous',
                'en_male_pirate' => 'Pirate',
                'en_male_santa' => 'Santa',
                'en_male_santa_effect' => 'Santa (w/ effect)',
                'en_female_pansino' => 'Varsity',
                'en_male_grinch' => 'Trickster (Grinch)',
                'en_us_ghostface' => 'Ghostface (Scream)',
                'en_us_chewbacca' => 'Chewbacca (Star Wars)',
                'en_us_c3po' => 'C-3PO (Star Wars)',
                'en_us_stormtrooper' => 'Stormtrooper (Star Wars)',
                'en_us_stitch' => 'Stitch (Lilo & Stitch)',
                'en_us_rocket' => 'Rocket (Guardians of the Galaxy)',
                'en_female_madam_leota' => 'Madame Leota (Haunted Mansion)',
            ],
            '5' => [
                'en_male_sing_deep_jingle' => 'Song: Caroler',
                'en_male_m03_classical' => 'Song: Classic Electric',
                'en_female_f08_salut_damour' => 'Song: Cottagecore (Salut d\'Amour)',
                'en_male_m2_xhxs_m03_christmas' => 'Song: Cozy',
                'en_female_f08_warmy_breeze' => 'Song: Open Mic (Warmy Breeze)',
                'en_female_ht_f08_halloween' => 'Song: Opera (Halloween)',
                'en_female_ht_f08_glorious' => 'Song: Euphoric (Glorious)',
                'en_male_sing_funny_it_goes_up' => 'Song: Hypetrain (It Goes Up)',
                'en_male_m03_lobby' => 'Song: Jingle (Lobby)',
                'en_female_ht_f08_wonderful_world' => 'Song: Melodrama (Wonderful World)',
                'en_female_ht_f08_newyear' => 'Song: NYE 2023',
                'en_male_sing_funny_thanksgiving' => 'Song: Thanksgiving',
                'en_male_m03_sunshine_soon' => 'Song: Toon Beat (Sunshine Soon)',
                'en_female_f08_twinkle' => 'Song: Pop Lullaby',
                'en_male_m2_xhxs_m03_silly' => 'Song: Quirky Time',
            ],
            '6' => [
                'fr_001' => 'French Male 1',
                'fr_002' => 'French Male 2',
            ],
            '7' => [
                'de_001' => 'German Female',
                'de_002' => 'German Male',
            ],
            '8' => [
                'id_male_darma' => 'Darma',
                'id_female_icha' => 'Icha',
                'id_female_noor' => 'Noor',
                'id_male_putra' => 'Putra',
            ],
            '9' => [
                'it_male_m18' => 'Italian Male',
            ],
            '10' => [
                'jp_001' => 'Miho (美穂)',
                'jp_003' => 'Keiko (恵子)',
                'jp_005' => 'Sakura (さくら)',
                'jp_006' => 'Naoki (直樹)',
                'jp_male_osada' => 'モリスケ (Morisuke)',
                'jp_male_matsuo' => 'モジャオ (Matsuo)',
                'jp_female_machikoriiita' => 'まちこりーた (Machikoriiita)',
                'jp_male_matsudake' => 'マツダ家の日常 (Matsudake)',
                'jp_male_shuichiro' => '修一朗 (Shuichiro)',
                'jp_female_rei' => '丸山礼 (Maruyama Rei)',
                'jp_male_hikakin' => 'ヒカキン (Hikakin)',
                'jp_female_yagishaki' => '八木沙季 (Yagi Saki)',
            ],
            '11' => [
                'kr_002' => 'Korean Male 1',
                'kr_004' => 'Korean Male 2',
                'kr_003' => 'Korean Female',
            ],
            '12' => [
                'br_003' => 'Júlia',
                'br_004' => 'Ana',
                'br_005' => 'Lucas',
                'pt_female_lhays' => 'Lhays Macedo',
                'pt_female_laizza' => 'Laizza',
            ],
            '13' => [
                'es_002' => 'Spanish Male',
                'es_male_m3' => 'Julio',
                'es_female_f6' => 'Alejandra',
                'es_female_fp1' => 'Mariana',
                'es_mx_002' => 'Álex (Warm)',
                'es_mx_female_supermom' => 'Super Mamá',
            ],
            default => [],
        };
    }

}
