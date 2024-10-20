<div x-data="{
    init() {
            let openModalListener = addEventListener('open-modal', (event) => {
                if (event.detail.id === 'generate-an-audio') {
                    $store.generateAudio.statePath = event.detail.statePath ?? null;
                    $store.generateAudio.disk = event.detail.disk ?? null;
                    $store.generateAudio.generator = event.detail.generator ?? null;

                    $dispatch('update-audio-generator', { generator: event.detail.generator });
                }
            });

            let generatedAudioUploadedListener = addEventListener('generated-audio-uploaded', (event) => {
                $dispatch('close-modal', { id: 'generate-an-audio' });
                this.isDownloading = false;

                $dispatch('set-generated-audio', { uuid: event.detail.uuid, localFileName: event.detail.localFileName, statePath: event.detail.statePath });
            });
        },

        isGenerating: false,
        isEmpty: true,
        isDownloading: false,

        generateAudio() {
            this.isGenerating = true;
            this.isEmpty = true;

            $wire.generateAudio($store.generateAudio.generator)
                .then(() => {
                    this.isGenerating = false;

                    $store.generateAudio.selectedAudio.url = $wire.url;

                    this.isEmpty = $wire.generatedAudios.length === 0;

                    refreshFsLightbox();
                });
        },
        selectAudio(key) {
            $wire.selectAudio(key)
                .then(() => {
                    $store.generateAudio.selectedAudio.url = $wire.url;
                    document.getElementById('audio' + key).classList.add('!border-primary-500');
                });
        }
}" x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-audio-generator-field', package: 'michaeld555/filament-audio-generator-field'))]" x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('filament-audio-generator-field', package: 'michaeld555/filament-audio-generator-field'))]">
    <x-filament::modal
        id="generate-an-audio"
        width="{{ config('filament-audio-generator-field.modal.width') ?? '6xl' }}"
        heading="true"
        displayClasses="generate-an-audio"
        closeButton="true"
    >
        <x-slot name="header">
            <strong>{{ __('filament-audio-generator-field::messages.modals.generate-an-audio.title') }}</strong>
        </x-slot>

        <div>
                <div class="grid gap-8 lg:grid-cols-5">
                    <div class="rounded dark:bg-neutral-800 lg:col-span-3">
                        <div class="h-full overflow-hidden rounded-xl">
                            <div class="flex h-full items-center justify-center" x-show="isGenerating || isEmpty">
                                <svg viewBox="0 0 512 512" class="h-48 text-neutral-100" x-bind:class="isGenerating ? 'animate-[spin_5s_linear_infinite]' : ''">
                                    <use xlink:href="#sparkless"></use>
                                </svg>
                            </div>

                            <div class="flex items-center justify-center h-full place-content-center gap-4"
                                x-show="!isGenerating && !isEmpty"
                            >
                                @include('filament-audio-generator-field::components.audio-player', ['url' => $url, 'language' => $language, 'voice' => $voice])
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="mb-8 rounded-lg bg-blue-100 px-4 py-3 text-blue-900 shadow-sm dark:bg-blue-800 dark:text-blue-100" role="alert">
                            <div class="flex">
                                <p class="text-sm">
                                    {!! __('filament-audio-generator-field::messages.modals.generate-an-audio.description') !!}
                                </p>
                            </div>
                        </div>

                        {{ $this->promptForm }}

                        <div class="mt-4 flex flex-col-reverse">
                            <x-filament::button x-on:click="generateAudio()" class="btn-ag-generate" x-bind:disabled="isGenerating">
                                <div class="flex gap-4">
                                    <x-filament::loading-indicator class="h-5 w-5" x-show="isGenerating"></x-filament::loading-indicator>

                                    <svg viewBox="0 0 576 512" class="h-5 w-5" x-show="!isGenerating">
                                        <use xlink:href="#magic-wand"></use>
                                    </svg>

                                    <span x-show="!isGenerating">{{ Str::ucfirst(__('filament-audio-generator-field::messages.modals.generate-an-audio.generate')) }}</span>
                                    <span x-show="isGenerating">{{ Str::ucfirst(__('filament-audio-generator-field::messages.modals.generate-an-audio.generating')) }}</span>
                                </div>
                            </x-filament::button>
                        </div>
                    </div>
                </div>
        </div>

        <x-slot name="footer">
            <div class="flex flex-row-reverse justify-between">
                <div class="flex">
                    <x-filament::button color="gray" class="mr-2" x-on:click="isOpen = false">
                        {{ Str::ucfirst(__('filament-audio-generator-field::messages.modals.generate-an-audio.cancel')) }}
                    </x-filament::button>

                    <x-filament::button
                        color="primary"
                        @click="$dispatch('add-selected-audio', { statePath: $store.generateAudio.statePath, disk: $store.generateAudio.disk }); isDownloading = true;"
                        x-show="$store.generateAudio?.selectedAudio.url !== null"
                        x-bind:disabled="isDownloading"
                    >
                        <div class="flex gap-4">
                            <x-filament::loading-indicator class="h-5 w-5" x-show="isDownloading"></x-filament::loading-indicator>

                            <span
                                x-text="isDownloading ? '{{ Str::ucfirst(__('filament-audio-generator-field::messages.modals.generate-an-audio.uploading')) }}' : '{{ Str::ucfirst(__('filament-audio-generator-field::messages.modals.generate-an-audio.add-generated')) }}'"
                            ></span>

                        </div>
                    </x-filament::button>
                </div>
            </div>
        </x-slot>
    </x-filament::modal>

    @include('filament-audio-generator-field::partials.svg-defs')

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('generateAudio', {
                selectedAudio: {
                    url: null,
                },
                statePath: null,
                disk: null,
                generator: null,
            })
        })
    </script>
</div>
