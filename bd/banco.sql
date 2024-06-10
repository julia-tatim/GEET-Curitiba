drop database geet;
create database geet;
use geet;

CREATE TABLE imagem (
    id_imagem INT AUTO_INCREMENT PRIMARY KEY,
    imagem LONGBLOB,
    tipo ENUM('Evento', 'Estabelecimento')
);
CREATE TABLE tipo (
    id_tipo INT PRIMARY KEY,
    tipoLocal VARCHAR(50),
    local ENUM('Evento', 'Estabelecimento')
);   

CREATE TABLE estabelecimento (
    id_estabelecimento INT AUTO_INCREMENT PRIMARY KEY,
    localizacao VARCHAR(250),
    nome VARCHAR(50) UNIQUE,
    horario_abertura TIME,
    descricao TEXT,
    telefone VARCHAR(50) UNIQUE,
    rede_social VARCHAR(500),
    site VARCHAR(500),
    idadeMinima VARCHAR(35),
    horario_fechamento TIME,
    imagem_id INT,
    id_tipo INT,
    FOREIGN KEY (imagem_id) REFERENCES imagem(id_imagem) ON DELETE RESTRICT,
    FOREIGN KEY (id_tipo) REFERENCES tipo(id_tipo) ON DELETE RESTRICT
);
CREATE TABLE usuario (
    email VARCHAR(50) PRIMARY KEY,
    nome VARCHAR(255),
    senha VARCHAR(255),
    data_nascimento DATE,
    imagem LONGBLOB,
    confirmaSenha VARCHAR(255)
);

CREATE TABLE evento (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    horario VARCHAR(50),
    nome VARCHAR(50) UNIQUE,
    localizacao VARCHAR(250),
    descricao TEXT,
    telefone VARCHAR(50),
    rede_social VARCHAR(500),
    site VARCHAR(500),
    idadeMinima VARCHAR(35),
    imagem_id INT,
    id_tipo INT,
    FOREIGN KEY (imagem_id) REFERENCES imagem(id_imagem) ON DELETE RESTRICT,
    FOREIGN KEY (id_tipo) REFERENCES tipo(id_tipo) ON DELETE RESTRICT
);

CREATE TABLE administrador (
    email VARCHAR(50) PRIMARY KEY,
    senha VARCHAR(50)
);


CREATE TABLE comentario_estabelecimento (
    id_comentario INT AUTO_INCREMENT PRIMARY KEY,
    texto TEXT,
    estrelas INT,
    horario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_email VARCHAR(50),
    estabelecimento_id INT,
    FOREIGN KEY (usuario_email) REFERENCES usuario(email),
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id_estabelecimento) ON DELETE CASCADE
);

CREATE TABLE favorito_estabelecimento (
    fk_usuario_email VARCHAR(50),
    fk_estabelecimento_id INT,
    PRIMARY KEY (fk_usuario_email, fk_estabelecimento_id),
    FOREIGN KEY (fk_usuario_email) REFERENCES usuario(email) ON DELETE CASCADE,
    FOREIGN KEY (fk_estabelecimento_id) REFERENCES estabelecimento(id_estabelecimento) ON DELETE CASCADE
);

CREATE TABLE favorito_evento (
    fk_usuario_email VARCHAR(50),
    fk_evento_id INT,
    PRIMARY KEY (fk_usuario_email, fk_evento_id),
    FOREIGN KEY (fk_usuario_email) REFERENCES usuario(email) ON DELETE CASCADE,
    FOREIGN KEY (fk_evento_id) REFERENCES evento(id_evento) ON DELETE CASCADE
);


CREATE TABLE administra_estabelecimento (
    fk_administrador_email VARCHAR(50),
    fk_estabelecimento_id INT,
    PRIMARY KEY (fk_administrador_email, fk_estabelecimento_id),
    FOREIGN KEY (fk_administrador_email) REFERENCES administrador(email) ON DELETE CASCADE,
    FOREIGN KEY (fk_estabelecimento_id) REFERENCES estabelecimento(id_estabelecimento) ON DELETE CASCADE
);

/* INSERTS */
insert into tipo (id_tipo, tipoLocal, local) values 
(1, "Restaurantes", 'Estabelecimento'),
(2, "Restaurantes Veganos", 'Estabelecimento'),
(3, "Restaurantes com Opções Veganas", 'Estabelecimento'),

(4, "Cafés", 'Estabelecimento'),
(5, "Cafés com Opções Veganas", 'Estabelecimento'),

(6, "Entretenimento", 'Estabelecimento'),
(7, "Pontos Turísticos", 'Estabelecimento'),

(30, "$", 'Estabelecimento'),
(31, "$$", 'Estabelecimento'),
(32, "$$%", 'Estabelecimento');
