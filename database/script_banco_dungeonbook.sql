-- Table `usuarios`
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `papel` ENUM('jogador', 'administrador') NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `apelido` VARCHAR(50) NULL DEFAULT NULL,
    `email` VARCHAR(100) NOT NULL,
    `telefone` VARCHAR(20) NULL DEFAULT NULL,
    `data_nascimento` DATE NOT NULL,
    `senha` VARCHAR(255) NOT NULL,
    `foto` VARCHAR(255) NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email` (`email` ASC) VISIBLE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Table `denuncias`
CREATE TABLE IF NOT EXISTS `denuncias` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `texto` TEXT NOT NULL,
    `data_hora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('pendente', 'resolvida') NULL DEFAULT 'pendente',
    PRIMARY KEY (`id`),
    CONSTRAINT `denuncias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Table `modalidades`
CREATE TABLE IF NOT EXISTS `modalidades` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `descricao` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Table `salas`
CREATE TABLE IF NOT EXISTS `salas` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `criador_id` INT NOT NULL,
    `quant_min_jogadores` INT NOT NULL,
    `quant_max_jogadores` INT NOT NULL,
    `data` DATE NOT NULL,
    `hora_inicio` TIME NOT NULL,
    `hora_fim` TIME NOT NULL,
    `descricao` TEXT NULL DEFAULT NULL,
    `modalidades_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `salas_ibfk_1` FOREIGN KEY (`criador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_salas_modalidades1` FOREIGN KEY (`modalidades_id`) REFERENCES `modalidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Table `salas_jogadores`
CREATE TABLE IF NOT EXISTS `salas_jogadores` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `sala_id` INT NOT NULL,
    `data_hora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `avaliacao_nota` INT NULL DEFAULT NULL,
    `avaliacao_comentario` TEXT NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `usuario_id` (
        `usuario_id` ASC,
        `sala_id` ASC
    ),
    CONSTRAINT `salas_jogadores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
    CONSTRAINT `salas_jogadores_ibfk_2` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Table `mensagens`
CREATE TABLE IF NOT EXISTS `mensagens` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `salas_jogadores_id` INT NOT NULL,
    `data_hora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `texto` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`salas_jogadores_id`) REFERENCES `salas_jogadores` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Table `notificacoes`
CREATE TABLE IF NOT EXISTS `notificacoes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `texto` TEXT NOT NULL,
    `data` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('nao_lida', 'lida') NULL DEFAULT 'nao_lida',
    PRIMARY KEY (`id`),
    CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Dados iniciais do base de dados
INSERT INTO
    usuarios (
        papel,
        nome,
        apelido,
        email,
        telefone,
        data_nascimento,
        senha
    )
VALUES (
        'administrador',
        'Eduarda Prestes',
        'Duda',
        'rpeduarda09@gmail.com',
        '45 998389538',
        '2006-10-09',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    );
    VALUES (
        'administrador',
        'Leonardo',
        'Leo',
        'rpeduarda09@gmail.com',
        '45 998389538',
        '2006-10-09',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    );
    VALUES (
        'administrador',
        'Guilherme Pazinato',
        'Pazinato',
        'rpeduarda09@gmail.com',
        '45 998389538',
        '2006-10-09',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    );
    VALUES (
        'administrador',
        'Raul Fagundes',
        'Raul',
        'rpeduarda09@gmail.com',
        '45 998389538',
        '2006-10-09',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    );
/* Senha 123 */