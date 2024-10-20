<?php

namespace Michaeld555\AudioGeneratorField;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Livewire;
use Michaeld555\AudioGeneratorField\Components\GenerateForm;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AudioGeneratorFieldServiceProvider extends PackageServiceProvider
{

    public static string $name = 'filament-audio-generator-field';

    public static string $viewNamespace = 'filament-audio-generator-field';

    public function configurePackage(Package $package): void
    {

        $package->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews();

        $package->hasInstallCommand(function (InstallCommand $command) {

            $command
                ->startWith(function (InstallCommand $command) {

                    if ($command->confirm('Would you like to publish the config file?', false)) {
                        $command->callSilent('vendor:publish', ['--tag' => 'filament-audio-generator-field-config', '--force' => true]);
                    }

                    if ($command->confirm('Would you like to publish the translations?', false)) {
                        $command->callSilent('vendor:publish', ['--tag' => 'filament-audio-generator-field-translations', '--force' => true]);
                    }
                })
                ->publishAssets()
                ->endWith(function (InstallCommand $command) {

                    $command->info('Enjoy using Filament Audio Generator Field!');

                });

        });

        Livewire::component('filament-audio-generator-field::generate-form', GenerateForm::class);

        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

    }

    /**
     * @return array<\Filament\Support\Assets\Asset>>
     */
    protected function getAssets(): array
    {
        return [
            Css::make('filament-audio-generator-field', __DIR__ . '/../resources/dist/filament-audio-generator-field.css')->loadedOnRequest(),
            Js::make('filament-audio-generator-field', __DIR__ . '/../resources/dist/filament-audio-generator-field.js')->loadedOnRequest()
        ];
    }

    protected function getAssetPackageName(): string
    {
        return 'michaeld555/filament-audio-generator-field';
    }

}
