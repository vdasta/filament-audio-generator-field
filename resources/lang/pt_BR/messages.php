<?php

return [
    'labels' => [
        'generate-audio' => 'Gerar usando IA',
    ],

    'form' => [
        'fields' => [
            'prompt' => 'Prompt',
            'prompt-placeholder' => 'exemplo: `Eu gosto de comer frutas, mas não gosto de caminhar`. Não se esqueça de manter a escrita com acentuação correta.',

            'language' => 'Linguagem',
            'language-hint' => 'Selecione a linguagem do áudio.',
            'voice' => 'Estilo de Voz',
            'voice-hint' => 'Selecione o estilo da voz do áudio.',
        ],

        'errors' => [
            'no-audios-generated' => 'Nenhum áudio foi gerado. Por favor tente novamente.',
        ]
    ],

    'modals' => [
        'generate-an-audio' => [
            'title' => 'Geração de Áudio',
            'description' => 'Descreva detalhadamente o áudio que deseja gerar.<br />Aguarde enquanto o áudio está sendo gerado.',
            'generate' => 'Gerar',
            'generating' => 'Gerando...',
            'add-generated' => 'Adicionar áudio gerado',
            'cancel' => 'Cancelar',
            'select' => 'Selecionar',
            'uploading' => 'Enviando...',
        ]
    ]
];
