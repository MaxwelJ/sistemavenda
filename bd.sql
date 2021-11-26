create table vendedor (
	id serial not null,
	nome varchar(100) not null,
	data_nasc date not null,
	cpf varchar(11) not null,
	constraint pk_id primary key (id)
);

insert into vendedor (nome, data_nasc, cpf) values 
('Maxwel Jonson', '2004-06-03', '63139127308'),
('José Miguel', '2000-07-09', '63139127309')

select * from vendedor

create table produtos (
	id serial not null,
	nome varchar(100) not null,
	quantidade integer not null,
	constraint pk_id_produto primary key (id)
);

insert into produtos (nome, quantidade) values 
('Sapato Maculino', 20),
('Blusa feminina', 50

ALTER TABLE produtos ADD COLUMN imagem text NOT NULL default '';

ALTER TABLE produtos ADD COLUMN id_categoria integer NOT NULL default 1;

alter table produtos drop column id_categoria;

ALTER TABLE produtos
ADD CONSTRAINT fk_id_categoria FOREIGN KEY (id_categoria) REFERENCES categoria(id);

alter table produtos add column descricao text;

select * from produtos

create table categoria (
	id serial not null,
	nome varchar(200) not null,
	constraint pk_id_categoria primary key (id)
);

insert into categoria (nome) values 
('Calçados'),
('Vestimentas'),
('Acessórios');

select * from categoria;

select * from produtos p 

drop table categoria;

create table tipo_pag (
	id serial not null,
	nome varchar(100) not null,
	descricao text,
	constraint pk_id_tipo_pag primary key (id)
);

insert into tipo_pag (nome, descricao) values 
('Pix', ' '),
('Crédito', 'parcelado em 2 vezes')

insert into tipo_pag (nome, descricao) values 
('Cartão de Débito', ''),
('Boleto', '')

update tipo_pag 
	set 
		nome = 'Cartão de Crédito',
		descricao = ''
	where 
		id = 2

select * from tipo_pag

create table vendas (
	id serial not null,
	id_vendedor integer not null,
	id_tipo_pag integer not null,
	data_venda date not null,
	constraint pk_id_vendas primary key (id),
	constraint fk_id_vendedor foreign key (id_vendedor) references vendedor(id),
	constraint fk_id_tipo_pag foreign key (id_tipo_pag) references tipo_pag(id)
);

select * from vendas; 

create table itens_venda (
	id serial not null,
	id_venda integer not null,
	id_produto integer not null,
	quantidade integer not null,
	constraint pk_id_itens_vendas primary key (id),
	constraint fk_id_venda foreign key (id_venda) references vendas(id),
	constraint fk_id_produto foreign key (id_produto) references produtos(id)
);

alter table itens_venda add column valor_venda numeric NOT NULL default 0

select * from itens_venda;

SELECT
                p.*, 
                c.nome as nome_cat
            FROM produtos p
            INNER JOIN categoria c ON p.id_categoria = c.id 
            WHERE p.id='1'
            order by id asc
            
SELECT
                v.*,
                vend.nome as nome_vendedor,
                tp.nome as tipo_pag_nome
            FROM vendas v
            INNER JOIN vendedor vend 
                ON v.id_vendedor = vend.id
            INNER JOIN tipo_pag tp
                ON v.id_tipo_pag = tp.id 
            order by id asc
            
SELECT * FROM itens_venda WHERE id=50;

SELECT 
            iv.id, --cod item
            p.id, --cod produto
            p.nome, --produto
            p.preco,
            c.nome,
            iv.quantidade
        FROM itens_venda iv
        INNER JOIN produtos p ON iv.id_produto = p.id
        inner join categoria c on p.id_categoria = c.id
        WHERE iv.id_venda=87
