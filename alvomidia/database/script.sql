CREATE DATABASE meu_projeto;

USE meu_projeto;

CREATE TABLE adm (    
  id_adm int(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  login VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(150) NOT NULL,
  CONSTRAINT adm_id_pk PRIMARY KEY (id_adm)
);

CREATE TABLE usuarios (    
  id_usuario int(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  cpf_cnpj VARCHAR(20) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL,
  senha varchar(250) NOT NULL,
  plano varchar(250) NOT NULL,
  CONSTRAINT usuario_id_pk PRIMARY KEY (id_usuario)
);

CREATE TABLE tarefas (    
  id_tarefa INT(11) NOT NULL AUTO_INCREMENT,
  cliente_cod INT(11) NOT NULL,
  descricao VARCHAR(100) NOT NULL,
  data_hora VARCHAR(30) NOT NULL,
  status VARCHAR(20) NOT NULL,
  administrador VARCHAR(50) NOT NULL,
  CONSTRAINT tarefa_id_pk PRIMARY KEY (id_tarefa)
);

CREATE TABLE tarefas_stories (    
  id_tarefa_stories INT(11) NOT NULL AUTO_INCREMENT,
  cliente_cod INT(11) NOT NULL,
  descricao VARCHAR(100) NOT NULL,
  data_hora VARCHAR(30) NOT NULL,
  status VARCHAR(20) NOT NULL,
  administrador VARCHAR(50) NOT NULL,
  CONSTRAINT tarefa_id_pk PRIMARY KEY (id_tarefa_stories) 
);

CREATE TABLE tarefas_video (    
  id_tarefa_video INT(11) NOT NULL AUTO_INCREMENT,
  cliente_cod INT(11) NOT NULL,
  descricao VARCHAR(100) NOT NULL,
  data_hora VARCHAR(30) NOT NULL,
  status VARCHAR(20) NOT NULL,
  administrador VARCHAR(50) NOT NULL,
  CONSTRAINT tarefa_id_pk PRIMARY KEY (id_tarefa_video) 
);

CREATE TABLE arquivos (
  id_arquivo INT(11) NOT NULL AUTO_INCREMENT,
  id_tarefa INT(11) NULL,  -- Relacionamento com tarefas
  id_tarefa_story INT(11) NULL,  -- Relacionamento com tarefas_stories
  id_tarefa_video INT(11) NULL,  -- Relacionamento com tarefas_video
  tipo_arquivo ENUM('imagem', 'video') NOT NULL,
  nome_arquivo VARCHAR(255) NOT NULL,
  caminho_arquivo VARCHAR(255) NOT NULL,
  data_upload DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_arquivo),
  CONSTRAINT fk_tarefa FOREIGN KEY (id_tarefa) REFERENCES tarefas(id_tarefa) ON DELETE CASCADE,
  CONSTRAINT fk_tarefa_story FOREIGN KEY (id_tarefa_story) REFERENCES tarefas_stories(id_tarefa_stories) ON DELETE CASCADE,
  CONSTRAINT fk_tarefa_video FOREIGN KEY (id_tarefa_video) REFERENCES tarefas_video(id_tarefa_video) ON DELETE CASCADE
);

#Adicionando Chave estrangeira nas tabelas de tarefas
ALTER TABLE tarefas ADD COLUMN arquivo_code_feed INT(11) NULL;
ALTER TABLE tarefas ADD CONSTRAINT fk_arquivos_feed FOREIGN KEY (arquivo_code_feed) REFERENCES arquivos(id_arquivo) ON DELETE CASCADE;

ALTER TABLE tarefas_stories ADD COLUMN arquivo_code_storie INT(11) NULL;
ALTER TABLE tarefas_stories ADD CONSTRAINT fk_arquivos_stories FOREIGN KEY (arquivo_code_storie) REFERENCES arquivos(id_arquivo) ON DELETE CASCADE;

ALTER TABLE tarefas_video ADD COLUMN arquivo_code_video INT(11) NULL;
ALTER TABLE tarefas_video ADD CONSTRAINT fk_arquivos_video FOREIGN KEY (arquivo_code_video) REFERENCES arquivos(id_arquivo) ON DELETE CASCADE;


#senha 1234
INSERT INTO adm VALUES(1, 'Administrador', 'adm', '$2y$10$zgMEmoQMuJLsAVUrbGnZ.OmuUyLL/K/z0M7y.rnHqXve7D/Xl9ujq'); 

INSERT INTO usuarios VALUES(1, 'José', '12245578800', 'jose123@gmail.com', '$2y$10$zgMEmoQMuJLsAVUrbGnZ.OmuUyLL/K/z0M7y.rnHqXve7D/Xl9ujq', 'premium'); 
