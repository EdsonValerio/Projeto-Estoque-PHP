<?php

// Arquivo: config/database.php

// --- Configurações do Banco de Dados ---
// Essas são as credenciais para acessar o seu banco de dados MySQL via XAMPP.
$host = 'localhost';      // O servidor do banco de dados (geralmente 'localhost' no XAMPP)
$dbname = 'estoque_db';   // O nome do banco de dados que criamos
$user = 'root';           // O usuário padrão do MySQL no XAMPP
$pass = '';               // A senha padrão do MySQL no XAMPP é vazia
$charset = 'utf8mb4';     // Conjunto de caracteres para garantir compatibilidade com acentos e emojis

// --- Conexão PDO ---
// DSN (Data Source Name) - define a fonte dos dados
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Opções do PDO para otimizar a conexão
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna os resultados como arrays associativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa 'prepared statements' nativos do DB
];

try {
    // Tenta criar uma nova instância do PDO para conectar ao banco de dados
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Se a conexão falhar, exibe uma mensagem de erro e encerra o script.
    // Em um sistema em produção, você registraria o erro em um log em vez de exibi-lo na tela.
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Ao final, a variável $pdo estará disponível para ser usada em outros arquivos que incluírem este.