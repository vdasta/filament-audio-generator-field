<?php

return [
    'labels' => [
        'generate-audio' => 'Generate using AI',
    ],

    'form' => [
        'fields' => [
            'prompt' => 'Prompt',
            'prompt-placeholder' => 'example: `Thanks for calling! Please wait while I connect you.',

            'language' => 'Language',
            'language-hint' => 'Select the audio language.',
            'voice' => 'Voice Style',
            'voice-hint' => 'Select the voice style for the audio.',
        ],

        'errors' => [
            'no-audios-generated' => 'No audio was generated. Please try again.',
        ]
    ],

    'modals' => [
        'generate-an-audio' => [
            'title' => 'Audio Generation',
            'description' => 'Enter the text you would like to have spoken for your greeting.<br />Please wait while the audio is being generated.',
            'generate' => 'Generate',
            'generating' => 'Generating...',
            'add-generated' => 'Add generated audio',
            'cancel' => 'Cancel',
            'select' => 'Select',
            'uploading' => 'Uploading...',
        ]
    ]
];
