<?php
// 1. Captura User-Agent e IP
$useragent = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];

// 2. Lista dos bots conhecidos
$bots = ['facebookexternalhit', 'Facebot', 'Googlebot', 'Bingbot', 'Slurp', 'DuckDuckBot', 'Baiduspider', 'YandexBot', 'Sogou'];

// 3. Define variável para saber se é bot
$isBot = false;
foreach($bots as $bot) {
    if (stripos($useragent, $bot) !== false) {
        $isBot = true;
        break;
    }
}

// 4. IP range block (exemplo com Facebook)
$blockIPs = ['69.63.', '66.220.', '66.249.', '31.13.']; // Facebook & Google ranges iniciais

foreach ($blockIPs as $blockIP) {
    if (strpos($ip, $blockIP) === 0) {
        $isBot = true;
        break;
    }
}

// 5. Cloaking action
if ($isBot) {
    // Bot: redireciona pra página "fake"
    header('Location: https://g1.globo.com/');
    exit;
} else {
    // User real: carrega conteúdo real (a sua oferta braba)
    include('index.html');
}
?>
