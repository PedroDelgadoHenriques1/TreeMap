<?php

for ($i = 1; $i <= 100; $i++) {
    $valor = rand(-100, 100); 
    $cor = $valor > 0 ? 'green' : 'red'; 
    $acoes[] = [
        'nome' => 'Ação ' . $i,
        'valor' => $valor,
        'cor' => $cor
    ];
}


$ganhos = array_filter($acoes, fn($acao) => $acao['valor'] > 0);
$perdas = array_filter($acoes, fn($acao) => $acao['valor'] < 0);


$total_ganhos = array_sum(array_column($ganhos, 'valor'));
$total_perdas = array_sum(array_map(fn($acao) => abs($acao['valor']), $perdas));


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treemap de Ações</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="treemap">
        <div class="coluna ganhos">
        <div class="titulo">Aumento</div>
        <?php foreach ($ganhos as $acao): ?>
            <?php 
                $percentual = $acao['valor'];
                $largura = rand(60, 180); 
                $altura = rand(40, 120); 
                
                
                $opacidade = 0.2 + (0.8 * ($percentual / 100)); 
            ?>
            <div class="quadrado" style="width: <?= $largura ?>px; height: <?= $altura ?>px;">
                <span>
                    <?= htmlspecialchars($acao['nome']) ?><br>
                    <?= htmlspecialchars(number_format($percentual, 2)) ?>%
                </span>
                <div style="background-color: rgba(0, 128, 0, <?= $opacidade ?>);"></div>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="coluna perdas">
            <div class="titulo">Declínio</div>
            <?php foreach ($perdas as $acao): ?>
                <?php 
                    $percentual = abs($acao['valor']);
                    $largura = rand(60, 180); 
                    $altura = rand(40, 120); 
                    
                    
                    $opacidade = 0.2 + (0.8 * ($percentual / 300));
                ?>
                <div class="quadrado" style="width: <?= $largura ?>px; height: <?= $altura ?>px;">
                    <span>
                        <?= htmlspecialchars($acao['nome']) ?><br>
                        <?= htmlspecialchars(number_format($percentual, 2)) ?>%
                    </span>
                    <div style="background-color: rgba(255, 0, 0, <?= $opacidade ?>);"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
