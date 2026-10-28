
<?php

require __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
require __DIR__ . '/../app/Http/Controllers/JogosController.php';
require __DIR__ . '/../app/Http/Controllers/IdadeController.php';
require __DIR__ . '/../app/Http/Controllers/NotasController.php';
require __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';

// Rotas do sistema
return [
    'GET' => [
        'portfolio' => [new PortfolioController(), 'index'],
        'helpdesk' => [new HelpdeskController(), 'index'],
        'jogos' => [new JogosController(), 'index'],
        'idade' => [new IdadeController(), 'index'],
        'notas' => [new NotasController(), 'index']
    ],

    'POST' => [
        'helpdesk' => [new HelpdeskController(), 'salvar'],
        'jogos' => [new JogosController(), 'index'],
        'idade' => [new IdadeController(), 'index'],
        'notas' => [new NotasController(), 'index']
    ]
];
