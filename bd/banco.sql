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
    horario_abertura VARCHAR(5),
    descricao TEXT,
    telefone VARCHAR(50) UNIQUE,
    rede_social VARCHAR(500),
    site VARCHAR(500),
    idadeMinima VARCHAR(35),
    horario_fechamento VARCHAR(5),
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
    imagem BLOB,
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
    estrelas INT,
    texto TEXT,
    horario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fk_usuario_email VARCHAR(50),
    fk_estabelecimento_id INT,
    FOREIGN KEY (fk_usuario_email) REFERENCES usuario(email),
    FOREIGN KEY (fk_estabelecimento_id) REFERENCES estabelecimento(id_estabelecimento) ON DELETE CASCADE
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

(6, "Entreterimentos", 'Estabelecimento'),
(7, "Pontos Turísticos", 'Estabelecimento'),

(30, "$", 'Estabelecimento'),
(31, "$$", 'Estabelecimento'),
(32, "$$%", 'Estabelecimento');

insert into estabelecimento values 
("Alameda Dr. Carlos de Carvalho, 1148 - Batel", "Degusto Café", "09:00", "Diversos tipos de cafés gourmets, além de brownies, cupcakes e tortas, em espaço inspirado nos Estados Unidos"," 41 992865127", "https://www.instagram.com/degustocafe/", "https://www.degustocafe.com.br/", "livre", "21:00", 1, 4);

id_estabelecimento INT AUTO_INCREMENT PRIMARY KEY,
    localizacao VARCHAR(250),
    nome VARCHAR(50) UNIQUE,
    horario_abertura VARCHAR(5),
    descricao TEXT,
    telefone VARCHAR(50) UNIQUE,
    rede_social VARCHAR(500),
    site VARCHAR(500),
    idadeMinima VARCHAR(35),
    horario_fechamento VARCHAR(5),
    imagem_id INT,
    id_tipo INT,

insert into usuario values 
("thais@gmail.com","thais","" "Restaurantes"),

/*

-- Trigger para inserção de evento
DELIMITER //
CREATE TRIGGER after_insert_evento
AFTER INSERT ON evento
FOR EACH ROW
BEGIN
    INSERT INTO adm_administra (operacao, data_hora, fk_evento_id_evento, fk_administrador_login) VALUES ('inserir_evento', NOW(), NEW.id_evento, admin_login);
END;
//
DELIMITER ;
-- Trigger para atualização de evento
DELIMITER //
CREATE TRIGGER after_update_evento
AFTER UPDATE ON evento
FOR EACH ROW
BEGIN
    DECLARE admin_login VARCHAR(50);
    SET admin_login = (SELECT admin_login FROM administrador WHERE login = '{admin_login}');

    INSERT INTO adm_administra (operacao, data_hora, fk_evento_id_evento, fk_administrador_login) VALUES ('atualizar_evento', OLD.id_evento, admin_login);
END;
//
DELIMITER ;
-- Trigger para exclusão de evento
DELIMITER //
CREATE TRIGGER after_delete_evento
AFTER DELETE ON evento
FOR EACH ROW
BEGIN
    DECLARE admin_login VARCHAR(50);
    SET admin_login = (SELECT admin_login FROM administrador WHERE login = '{admin_login}');

    INSERT INTO adm_administra (operacao, data_hora, fk_evento_id_evento, fk_administrador_login) VALUES ('excluir_evento', OLD.id_evento, admin_login);
END;
//
DELIMITER ;



DELIMITER //
CREATE TABLE usuario_auditoria (
    acao varchar(10),
    nome varchar(50),
    senha varchar(50),
    email varchar(50),
    data_nascimento date,
    data_hora timestamp
);
DELIMITER //
CREATE TRIGGER delete_usuario_auditoria_trigger
AFTER DELETE ON usuario
FOR EACH ROW
BEGIN
	DELETE FROM usuario_comenta WHERE fk_usuario_email = OLD.email;
    DELETE FROM favorita WHERE fk_usuario_email = OLD.email;
    DELETE FROM favorito WHERE fk_usuario_email = OLD.email;
    INSERT INTO usuario_auditoria (acao, nome, senha, email, data_nascimento, data_hora)
    VALUES ('DELETE', OLD.nome, OLD.senha, OLD.email, OLD.data_nascimento, NOW());
END //
CREATE TRIGGER update_usuario_auditoria_trigger
AFTER UPDATE ON usuario
FOR EACH ROW
BEGIN
	UPDATE usuario_comenta SET fk_usuario_email = NEW.email WHERE fk_usuario_email = OLD.email;
    UPDATE favorita SET fk_usuario_email = NEW.email WHERE fk_usuario_email = OLD.email;
    UPDATE favorito SET fk_usuario_email = NEW.email WHERE fk_usuario_email = OLD.email;
    INSERT INTO usuario_auditoria (acao, nome, senha, email, data_nascimento, data_hora)
    VALUES ('UPDATE', NEW.nome, NEW.senha, NEW.email, NEW.data_nascimento, NOW());
END //
CREATE TRIGGER insert_usuario_auditoria_trigger
AFTER INSERT ON usuario
FOR EACH ROW
BEGIN
    INSERT INTO usuario_auditoria (acao, nome, senha, email, data_nascimento, data_hora)
    VALUES ('INSERT', NEW.nome, NEW.senha, NEW.email, NEW.data_nascimento, NOW());
END //
*/
