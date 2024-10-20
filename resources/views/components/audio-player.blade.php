<div x-data="{
    isPlaying: false,
    progress: 0,
    volume: 100,
    audio: null,
    init() {
        this.audio = this.$refs.audio;
        this.audio.volume = this.volume / 100;
        this.audio.currentTime = 0;
        this.audio.addEventListener('timeupdate', () => {
            if (this.audio.duration > 0) {
                this.progress = (this.audio.currentTime / this.audio.duration) * 100;
            }
        });
        this.audio.addEventListener('ended', () => {
            this.isPlaying = false;
            this.progress = 0;
            this.audio.currentTime = 0;
        });
    },
    togglePlayPause() {
        if (this.audio.paused) {
            this.audio.play();
            this.isPlaying = true;
        } else {
            this.audio.pause();
            this.isPlaying = false;
        }
    },
    seek() {
        const seekTime = (this.progress / 100) * this.audio.duration;
        this.audio.currentTime = seekTime;
    },
    updateVolume() {
        this.audio.volume = this.volume / 100;
    }
}" x-init="init">

<div class="bg-gray-800 text-white rounded-lg shadow-lg p-6 w-96">

    @if (!is_null($language) && !is_null($voice))

        <div class="text-center mb-4">
            <h2 class="text-xl font-semibold">{{ Michaeld555\AudioGeneratorField\Enums\VoiceEnum::getLanguagesWithId()[$language] ?? '-' }}</h2>
            <p class="text-gray-400">{{ Michaeld555\AudioGeneratorField\Enums\VoiceEnum::getVoicesByLanguageId($language)[$voice] ?? '-' }}</p>
        </div>

    @endif


    <div class="mb-4">
        <input type="range" class="w-full h-1 bg-gray-700 rounded-lg appearance-none cursor-pointer"
               min="0" max="100" x-model="progress" @input="seek">
    </div>


    <div class="flex items-center justify-center space-x-6">
        <button @click="togglePlayPause" class="bg-indigo-500 hover:bg-indigo-600 text-white p-2 rounded-full">

            <x-filament::icon x-show="!isPlaying"
                icon="heroicon-m-play"
                class="h-6 w-6"
            />
            <x-filament::icon x-show="isPlaying"
                icon="heroicon-m-pause"
                class="h-6 w-6"
            />
            
        </button>


        <input type="range" class="w-24 h-1 bg-gray-700 rounded-lg appearance-none cursor-pointer"
               min="0" max="100" x-model="volume" @input="updateVolume">
    </div>
</div>

<audio x-ref="audio" src="{{$url}}"></audio>
</div>
