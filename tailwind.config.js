const preset = require('./vendor/filament/filament/tailwind.config.preset')

module.exports = {
    presets: [preset],
    content: [
        './src/**/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    plugins: [
        require('@tailwindcss/aspect-ratio')
    ],

    safelist: [
        '2xl',
        '3xl',
        '4xl',
        '5xl',
        '6xl',
        '!border-primary-500'
    ]
}
