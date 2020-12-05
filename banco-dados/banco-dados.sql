

# É recomendado que a a estrutura e os dados de exemplos estajam nessa pasta

CREATE DATABASE testefc;

create TABLE medico (
	id INT(11) PRIMARY KEY not null,
    emal VARCHAR (200) not null,
	nome VARCHAR (200) not null,
	senha VARCHAR (200) not null,
    data_criacao timestamp not null DEFAULT CURRENT_DATE(),
    data_alteracao timestamp null DEFAULT null
);
create TABLE horario (
	id INT(11) not null,
    id_medico int(11) not null,
	horario_agendado int(2) not null,
	data_horario timestamp null not null,
    data_criacao timestamp not null DEFAULT CURRENT_DATE(),
    data_alteracao timestamp null DEFAULT null,
    PRIMARY KEY (id),
    FOREIGN KEY (id_medico) REFERENCES medico(id)
);