<?php
declare(strict_types=1);

function generateUniqueLuckyNumber(PDO $pdo): int
{
    for ($i = 0; $i < 200; $i++) {
        $number = rand(10000, 99999);
        try {
            $stmt = $pdo->prepare("INSERT INTO lucky_numbers_registry (lucky_number) VALUES (?)");
            $stmt->execute([$number]);
            return $number;
        } catch (PDOException $e) {
            continue;
        }
    }
    throw new RuntimeException('Não foi possível gerar número único após 200 tentativas.');
}

function getCurrentDateTime(): string
{
    $tz = new DateTimeZone('America/Sao_Paulo');
    $dt = new DateTime('now', $tz);
    return $dt->format(DateTime::ATOM);
}

function formatDateBR(string $isoDate): string
{
    try {
        $tz = new DateTimeZone('America/Sao_Paulo');
        $dt = new DateTime($isoDate, $tz);
        return $dt->format('d/m/Y H:i');
    } catch (Throwable $e) {
        return $isoDate;
    }
}
