<?php

namespace Michaeld555\AudioGeneratorField\Components;

use Michaeld555\AudioGeneratorField\Enums\VoiceEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Michaeld555\AudioGeneratorField\Services\DownloadAudioFromUrl;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class GenerateForm extends Component implements HasForms
{
    use InteractsWithForms;

    public array $generatedAudios = [];

    public ?string $url = null;

    public ?string $generatorName = null;

    public string $audioGenerator = 'https://neos-tts.apithis.net/v1/generate';

    public ?string $prompt = null;

    public ?string $language = null;

    public ?string $voice = null;

    public function mount(): void
    {
        //
    }

    public function render(): View
    {
        return view('filament-audio-generator-field::livewire.generate-form');
    }

    protected function getForms(): array
    {

        return [

            'promptForm' => $this->makeForm()
                ->columns(2)
                ->schema([

                    Select::make('language')
                    ->translateLabel()
                    ->label('filament-audio-generator-field::messages.form.fields.language')
                    ->options(fn () => VoiceEnum::getLanguagesWithId())
                    ->default($this->language)
                    ->columnSpan(2)
                    ->afterStateUpdated(fn (Set $set) => $set('voice', null))
                    ->live(onBlur: true)
                    ->required(),

                    Select::make('voice')
                    ->translateLabel()
                    ->label('filament-audio-generator-field::messages.form.fields.voice')
                    ->options(fn (Get $get) => VoiceEnum::getVoicesByLanguageId($get('language')))
                    ->default($this->voice)
                    ->columnSpan(2)
                    ->required(),

                    Textarea::make('prompt')
                        ->translateLabel()
                        ->label('filament-audio-generator-field::messages.form.fields.prompt')
                        ->columnSpan(2)
                        ->placeholder(__('filament-audio-generator-field::messages.form.fields.prompt-placeholder'))
                        ->rows(5)
                        ->rules(['string', 'min:10'])
                        ->default($this->prompt)
                        ->required(),

                ])

        ];

    }

    public function generateAudio(): void
    {

        $this->generatedAudios = [];

        $this->url = null;

        $this->validate();

        try {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'User-Agent' => 'tiktok-epic-voice-globalelite2/1.0.0',
                'Accept' => 'application/json',
            ])->post($this->audioGenerator, [
                'text' => $this->prompt,
                'voice' => $this->voice,
                'module_version' => 2,
            ]);

            $body = $response->body();

            if (preg_match('/https?:\/\/[^\s]+/', $body, $matches)) {

                $link = $matches[0];

                $this->url = $link;

                $this->generatedAudios[] = [
                    'url' => $link
                ];

            } else {

                $this->addError('prompt', __('filament-audio-generator-field::messages.form.errors.no-audios-generated'));

            }

        } catch (\Exception $e) {

            $this->addError('prompt', $e->getMessage());

        }

    }

    public function selectAudio(int $index): void
    {
        $this->url = $this->generatedAudios[$index]['url'];
    }

    #[On('update-audio-generator')]
    public function updateAudioGenerator(): void
    {

        $defaultFields = [];

        $this->getForm('promptForm')?->fill(
            array_merge(
                $defaultFields
            )
        );

    }

    #[On('add-selected-audio')]
    public function addSelected(string $statePath, string $disk): void
    {

        $response = Http::get($this->url);

        $localFileName = (new DownloadAudioFromUrl())->saveToDisk($response->body(), $disk);

        $this->dispatch('generated-audio-uploaded', uuid: Str::uuid()->toString(), localFileName: $localFileName, statePath: $statePath);

    }

}
