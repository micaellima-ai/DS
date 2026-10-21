<?php 
    require __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
   // require __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';

 // listando em arrays as rotas que vamos criar.
    return [
        'GET' => [
            'portfolio' => [new PortfolioController(), 'index'],
            //'helpdesk' => [new HelpdeskController(), 'index'],
            //'jogos' => [],
            //'idade' => [],
            //'notas' => []
        ],
        
        'POST' => [
            //'helpdesk' =>[new HelpdeskController(), '']
        ]

    ];
?>