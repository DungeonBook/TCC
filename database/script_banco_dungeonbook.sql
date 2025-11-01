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
    UNIQUE INDEX `email_unique` (`email` ASC),
    UNIQUE INDEX `apelido_unique` (`apelido` ASC)
) ENGINE = InnoDB;

-- Table `modalidades`
CREATE TABLE IF NOT EXISTS `modalidades` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `descricao` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Table `salas`
CREATE TABLE IF NOT EXISTS `salas` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome_sala` VARCHAR(100) NOT NULL,
    `criador_id` INT NOT NULL,
    `quant_min_jogadores` INT NOT NULL,
    `quant_max_jogadores` INT NOT NULL,
    `data` DATE NOT NULL,
    `hora_inicio` TIME NOT NULL,
    `hora_fim` TIME NOT NULL,
    `localizacao` TEXT DEFAULT NULL,
    `descricao` TEXT DEFAULT NULL,
    `modalidade_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_salas_criador` FOREIGN KEY (`criador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_salas_modalidades` FOREIGN KEY (`modalidade_id`) REFERENCES `modalidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- Table `salas_jogadores`
CREATE TABLE IF NOT EXISTS `salas_jogadores` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `sala_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `usuario_sala_unique`(
                 `usuario_id` ASC,
                 `sala_id` ASC ),

    CONSTRAINT `fk_salas_jogadores_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_salas_jogadores_sala` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Table `chat`
CREATE TABLE IF NOT EXISTS `chat` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `salas_jogadores_id` INT NOT NULL,
    `data_hora` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `mensagem` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_chat_salas_jogadores` FOREIGN KEY (`salas_jogadores_id`) REFERENCES `salas_jogadores` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

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
VALUES
    (
        'Administrador',
        'Eduarda Prestes',
        'Duda',
        'rpeduarda09@gmail.com',
        '45 998389538',
        '2006-10-09',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    ),
    (
        'Administrador',
        'Leonardo',
        'Leo',
        'agathasakamoto14@gmail.com',
        '45 999791332',
        '2006-05-18',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    ),
    (
        'Administrador',
        'Guilherme Pazinato',
        'Pazinato',
        'pazinatoguilherme1@gmail.com',
        '45 988089779',
        '2006-09-01',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    ),
    (
        'Administrador',
        'Raul Carvalho',
        'Raul',
        'raul170507@gmail.com',
        '45 999902914',
        '2007-05-17',
        '$2y$10$RfPcWzc2.0iAXxurnR8qdOSy.9m3Q4jRSkM4hko6QiPWUYgYPmRh.'
    );


INSERT INTO modalidades (descricao)
VALUES ('Fantasia'),
	('Medieval'),
	('Aventura'),
	('Mitologia'),
	('Dark Fantasy'),
	('Romance'),
	('Mistério'),
	('Suspense'),
	('Sobrenatural'),
	('Terror'),
	('Steampunk'),
	('Cyberpunk');


        
        
