<?php

namespace Michaeld555\AudioGeneratorField\Forms\Components;

use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;

class AudioGenerator extends FileUpload
{

    public static bool $isComponentRegistered = false;

    protected string $view = 'filament-audio-generator-field::forms.components.audio-generator';

    public bool | Closure $audioGenerator = true;

    protected function setUp(): void
    {

        parent::setUp();

        $this->acceptedFileTypes([
            'audio/aac',
            'audio/midi',
            'audio/mpeg',
            'audio/ogg',
            'audio/wav',
            'audio/webm',
            'audio/x-m4a',
        ]);

        $this->columnSpanFull();

        $this->maxFiles(1);

        $this->hintAction(

            Action::make('generateNewAudio')
    ->label(Str::ucfirst(__('filament-audio-generator-field::messages.labels.generate-audio')))
    ->icon('heroicon-m-sparkles')
    ->visible($this->audioGenerator)
    ->action(fn (LivewireComponent $livewire) => 
        $livewire->dispatch('open-modal',
            id: 'generate-an-audio',
            statePath: $this->getStatePath(),
            generator: [
                'disk' => $this->getDiskName(),
                'directory' => $this->getDirectory(),
            ],
            ))
        );

        if (!static::$isComponentRegistered) {

            FilamentView::registerRenderHook(
                'panels::content.end',
                fn (): View => view('filament-audio-generator-field::modals.generate-an-audio'),
            );

            static::$isComponentRegistered = true;

        }

    }

    public function audioGenerator(bool | Closure $audioGenerator): static
    {

        $this->audioGenerator = $audioGenerator;

        return $this;

    }

    public function getFieldWrapperView(?string $scope = null): string
    {
        if ($scope === 'generator') {

            return $this->getCustomFieldWrapperView() ??
                $this->getContainer()->getCustomFieldWrapperView() ??
                'filament-forms::field-wrapper';

        }

        return 'filament-audio-generator-field::blank-field-wrapper';

    }
    public function getDehydratedState(): mixed
    {
        $state = parent::getState();
    
        // If it's already a string (e.g., "greetings/abc.mp3"), just return it
        if (is_string($state)) {
            return $state;
        }
    
        // If it's an array with one file, extract its path
        if (is_array($state) && count($state) === 1) {
            return reset($state); // returns the first value in the array
        }
    
        return $state;
    }
    
    public function getState(): mixed
{
    $state = parent::getState();

    // If the state is already a string (e.g., a path), fake a file upload array
    if (is_string($state)) {
        return [
            Str::uuid()->toString() => $state,
        ];
    }

    return $state;
}

    

}
