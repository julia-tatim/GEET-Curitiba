create database geet;
use geet;

CREATE TABLE usuario (
    nome varchar(255),
    senha varchar(50),
    email varchar(50) PRIMARY KEY,
    data_nascimento date,
    imagem BLOB,
    confirmaSenha varchar(255)
);

CREATE TABLE evento (
    id_evento INT PRIMARY KEY,
    horario varchar(50),
    nome varchar(50),
    localizacao varchar(250),
    descricao varchar(200),
    telefone varchar(50),
    rede_social varchar(50),
    site varchar(200),
    restricao_idade boolean,
    imagem BLOB
);

CREATE TABLE estabelecimento (
    id_estabelecimento INT PRIMARY KEY,
    localizacao varchar(250),
    nome varchar(50),
    horario varchar(250),
    descricao varchar(200),
    telefone varchar(50),
    rede_social varchar(50),
    site varchar(200),
    restricao_idade boolean,
    imagem BLOB
);

CREATE TABLE administrador (
    email varchar(50) PRIMARY KEY,
    senha varchar(50)
);

CREATE TABLE usuario_comenta (
    estrelas INT,
    texto varchar(500),
    horario timestamp,
    fk_usuario_email varchar(50),
    fk_estabelecimento_id_estabelecimento INT
);

CREATE TABLE tipo (
    tipo_estabelecimento varchar(50),
    id_tipo INT PRIMARY KEY
);

CREATE TABLE adm_administra (
    operacao varchar(50),
    data_hora timestamp,
    fk_evento_id_evento INT,
    fk_administrador_email varchar(50)
);

CREATE TABLE tem (
    fk_estabelecimento_id_estabelecimento INT,
    fk_tipo_id_tipo INT
);

CREATE TABLE favorita (
    fk_usuario_email varchar(50),
    fk_estabelecimento_id_estabelecimento INT
);

CREATE TABLE favorito (
    fk_usuario_email varchar(50),
    fk_evento_id_evento INT
);

CREATE TABLE administra_estabelecimento (
    fk_estabelecimento_id_estabelecimento INT,
    fk_administrador_email varchar(50)
);
 
ALTER TABLE usuario_comenta ADD CONSTRAINT FK_usuario_comenta_1
    FOREIGN KEY (fk_usuario_email)
    REFERENCES usuario (email);
 
ALTER TABLE usuario_comenta ADD CONSTRAINT FK_usuario_comenta_2
    FOREIGN KEY (fk_estabelecimento_id_estabelecimento)
    REFERENCES estabelecimento (id_estabelecimento);
 
ALTER TABLE adm_administra ADD CONSTRAINT FK_adm_administra_1
    FOREIGN KEY (fk_evento_id_evento)
    REFERENCES evento (id_evento);
 
ALTER TABLE adm_administra ADD CONSTRAINT FK_adm_administra_2
    FOREIGN KEY (fk_administrador_email)
    REFERENCES administrador (email);
 
ALTER TABLE tem ADD CONSTRAINT FK_tem_1
    FOREIGN KEY (fk_estabelecimento_id_estabelecimento)
    REFERENCES estabelecimento (id_estabelecimento)
    ON DELETE RESTRICT;
 
ALTER TABLE tem ADD CONSTRAINT FK_tem_2
    FOREIGN KEY (fk_tipo_id_tipo)
    REFERENCES tipo (id_tipo)
    ON DELETE RESTRICT;
 
ALTER TABLE favorita ADD CONSTRAINT FK_favorita_1
    FOREIGN KEY (fk_usuario_email)
    REFERENCES usuario (email)
    ON DELETE SET NULL;
 
ALTER TABLE favorita ADD CONSTRAINT FK_favorita_2
    FOREIGN KEY (fk_estabelecimento_id_estabelecimento)
    REFERENCES estabelecimento (id_estabelecimento)
    ON DELETE SET NULL;
 
ALTER TABLE favorito ADD CONSTRAINT FK_favorito_1
    FOREIGN KEY (fk_usuario_email)
    REFERENCES usuario (email)
    ON DELETE SET NULL;
 
ALTER TABLE favorito ADD CONSTRAINT FK_favorito_2
    FOREIGN KEY (fk_evento_id_evento)
    REFERENCES evento (id_evento)
    ON DELETE SET NULL;
 
ALTER TABLE administra_estabelecimento ADD CONSTRAINT FK_administra_estabelecimento_1
    FOREIGN KEY (fk_estabelecimento_id_estabelecimento)
    REFERENCES estabelecimento (id_estabelecimento)
    ON DELETE RESTRICT;
 
ALTER TABLE administra_estabelecimento ADD CONSTRAINT FK_administra_estabelecimento_2
    FOREIGN KEY (fk_administrador_email)
    REFERENCES administrador (email)
    ON DELETE RESTRICT;

/* INSERTS */
insert into tipo (id_tipo, tipo_estabelecimento) values 
(1, "Restaurante"),
(2, "Café"),
(3, "Evento"),
(4, "Entreterimento"),
(5, "Pontos Turísticos"),
(20, "Vegano"),
(21, "Opções Veganas"),
(30, "$"),
(31, "$$"),
(32, "$$%"),
(33, "Entrada gratuita");


insert into estabelecimento (id_estabelecimento, localizacao, nome, horario, descricao, telefone, rede_social) values 
(2,"Rodovia, BR-116, 15560 - Novo Mundo, Curitiba - PR, 81690-200", "RA Kart Curitiba", "terça-feira 17:00–22:00, quarta-feira 17:00–22:00, quinta-feira 17:00–22:00, 
sexta-feira 17:00–22:00, sábado 14:00–22:00, domingo 14:00–22:00, segunda-feira Fechado", "Pista de Kart", "(41) 99805-6466", "https://www.instagram.com/rakartoficial/"),
(3, "R. Mal. Hermes, 999 - Centro Cívico, Curitiba - PR, 80530-230", "Museu Oscar Niemeyer", "terça-feira	10:00–18:00 quarta-feira	10:00–18:00 quinta-feira	
10:00–18:00 sexta-feira	10:00–18:00 sábado	10:00–18:00 domingo	10:00–18:00 segunda-feira	Fechado", "O Museu Oscar Niemeyer, também conhecido como Museu do Olho, 
é um museu de arte localizado na cidade de Curitiba", "999", "https://www.museuoscarniemeyer.org.br/"),
(4, "Alameda Dr. Carlos de Carvalho, 1148 - Batel, Curitiba - PR, 80430-180", "Degusto Café", "terça-feira	09:00–21:00, quarta-feira	
09:00–21:00, quinta-feira	09:00–21:00, sexta-feira	09:00–21:00, sábado	09:00–21:00, domingo	15:00–20:30, segunda-feira	09:00–21:00",
"Diversos tipos de cafés gourmets, além de brownies, cupcakes e tortas, em espaço inspirado nos Estados Unidos.", "41 992865127", "https://www.degustocafe.com.br/pt/"),
(1, "R. Manoel Eufrásio, 637 - Ahú, Curitiba - PR, 80540-010", "Baraquias", "terça-feira	11:45–23:00 quarta-feira	
11:45–23:00 quinta-feira	11:45–23:00 sexta-feira	11:45–23:00 sábado	11:45–23:00 domingo	11:45–23:00 segunda-feira	
11:45–23:00", "Bar e restaurante informal inspirado no Oriente Médio, com esfirras, quibes, beirutes e sobremesas.", "(41) 3387-9056", "baraquias.com");              

insert into tem values
(1, 1),
(1, 20),
(2, 4),
(3, 5),
(4, 2);




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

