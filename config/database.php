<?php
declare(strict_types=1);

function getDbConnection(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;

    $serverName = (string)($_SERVER['SERVER_NAME'] ?? '');
    $httpHost   = (string)($_SERVER['HTTP_HOST']   ?? '');

    $isLocal =
        in_array($serverName, ['localhost', '127.0.0.1'], true) ||
        ($httpHost !== '' && strpos($httpHost, 'localhost') !== false) ||
        (PHP_SAPI === 'cli');

    // LOCAL (XAMPP)
    $local = [
        'host'    => 'localhost',
        'db'      => 'asernet_iot',
        'user'    => 'root',
        'pass'    => '',
        'charset' => 'utf8mb4',
        'port'    => 3306,
    ];

    // PRODUÇÃO (KingHost)
    $prod = [
        'host'    => 'mysql.asernet.com.br',
        'db'      => 'asernet01',
        'user'    => 'asernet01',
        'pass'    => 'Theking9913',
        'charset' => 'utf8mb4',
        'port'    => 3306,
    ];

    $cfg = $isLocal ? $local : $prod;

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;port=%d;charset=%s',
        $cfg['host'], $cfg['db'], $cfg['port'], $cfg['charset']
    );

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], $options);
        return $pdo;
    } catch (Throwable $e) {
        error_log('DB CONNECT ERROR: ' . $e->getMessage());
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['ok' => false, 'message' => 'Erro de conexão com o banco de dados.']);
        exit;
    }
}
