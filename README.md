# Audio Generator Form Field for Filament Form

[![Latest Version on Packagist](https://img.shields.io/packagist/v/michaeld555/filament-audio-generator-field.svg?style=flat-square)](https://packagist.org/packages/michaeld555/filament-audio-generator-field)
[![Total Downloads](https://img.shields.io/packagist/dt/michaeld555/filament-audio-generator-field.svg?style=flat-square)](https://packagist.org/packages/michaeld555/filament-audio-generator-field)

This custom field allows you to generate audios with different languages and voices using free AI voice generator.
It extends the FileUpload field and adds a button to open the audio generator modal where you can generate the audio file.

<img src="https://i.ibb.co/NYFHDYn/filament-audio.png" alt="filament audio generator ai" width="1920" height="auto" class="filament-hidden" style="width: 100%;" />

# Installation

Before you begin, you must have the Laravel Filament package installed and configured. If you haven't done this yet, you can find the installation instructions [here](https://filamentadmin.com/docs/installation).

## Install the package via composer

Run the following command in your terminal to install the package:

```bash
composer require michaeld555/filament-audio-generator-field
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-audio-generator-field-config"
```

Optionally, you can publish the translations files:

```bash
php artisan vendor:publish --tag="filament-audio-generator-field-translations"
```

## Usage

![tutorial](https://i.ibb.co/ZLL9dfD/Audio-Generator-Field-ezgif-com-video-to-gif-converter.gif)

Just add new Field or replace your FileUpload field with AudioGenerator field in your form schema definition:

```php
use \Michaeld555\AudioGeneratorField\Forms\Components\AudioGenerator;

[...]
public static function form(Form $form): Form
{
    return $form
        ->schema([
            AudioGenerator::make('audio'),
        ]);
}
```

You could use all the same options as FileUpload field, for example:

```php
use \Michaeld555\AudioGeneratorField\Forms\Components\AudioGenerator;

AudioGenerator::make('audio')
    ->disk('private')
    ->audioGenerator(false) // hide the 'Generate with AI' button,
```

After you add the field to your form, you should see a button next to the file input. When you click the button, the audio generator modal will open.

![modal image](https://i.ibb.co/r03ykvb/image.png)

## Credits

- [Michael Douglas](https://github.com/michaeld555)
- [Filament Image Generator - naturalGroove](https://github.com/naturalGroove/laravel-filament-image-generator-field)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

