create table vendedor (
	id serial not null,
	nome varchar(100) not null,
	data_nasc date not null,
	cpf int(11) not null,
	constraint pk_id primary key (id)
);


create table categoria (
	id serial not null,
	nome varchar(200) not null,
	constraint pk_id_categoria primary key (id)
);

insert into categoria (nome) values 
('Calçados'),
('Vestimentas'),
('Acessórios');


create table produtos (
	id serial not null,
	nome varchar(100) not null,
	quantidade integer not null,
    preco float not null,
    descricao text,
	imagem text not null,
	id_categoria integer not null,
	constraint pk_id_produto primary key (id),
	constraint fk_id_categoria foreign key (id_categoria) references categoria(id)
);


create table tipo_pag (
	id serial not null,
	nome varchar(100) not null,
	descricao text,
	constraint pk_id_tipo_pag primary key (id)
);

insert into tipo_pag (nome, descricao) values 
('Pix', ''),
('Crédito', ''),
('Cartão de Débito', ''),
('Boleto', '')


create table vendas (
	id serial not null,
	id_vendedor integer not null,
	id_tipo_pag integer not null,
	data_venda date not null,
	constraint pk_id_vendas primary key (id),
	constraint fk_id_vendedor foreign key (id_vendedor) references vendedor(id),
	constraint fk_id_tipo_pag foreign key (id_tipo_pag) references tipo_pag(id)
);


create table itens_venda (
	id serial not null,
	id_venda integer not null,
	id_produto integer not null,
	quantidade integer not null,
	valor_venda numeric not null,
	constraint pk_id_itens_vendas primary key (id),
	constraint fk_id_venda foreign key (id_venda) references vendas(id),
	constraint fk_id_produto foreign key (id_produto) references produtos(id)
);