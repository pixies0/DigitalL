CREATE TABLE "Livro" (
	"Cod_livro" serial NOT NULL UNIQUE,
	"Titulo" VARCHAR(45) NOT NULL UNIQUE,
	"Nome_editora" VARCHAR(45) NOT NULL,
	CONSTRAINT "LIVRO_pk" PRIMARY KEY ("Cod_livro")
) WITH (
  OIDS=FALSE
);

ALTER TABLE "Livro" OWNER TO postgres;

CREATE TABLE "Livro_autor" (
	"Cod_livro_autor" integer NULL,
	"Nome_autor" VARCHAR(50) NULL,
	CONSTRAINT "LIVRO_AUTOR_pk" PRIMARY KEY ("Cod_livro_autor","Nome_autor")
) WITH (
  OIDS=FALSE
);

ALTER TABLE "Livro_autor" OWNER TO postgres;

ALTER TABLE "Livro_autor" ALTER COLUMN "Cod_livro_autor" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Livro_autor_Cod_livro_seq2"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);

CREATE TABLE "Editora" (
	"Cod_editora" integer NOT NULL,
	"Nome" VARCHAR(50) NOT NULL UNIQUE,
	"Endereco" VARCHAR(100) NULL,
	"Telefone" VARCHAR(15) NOT NULL,
	CONSTRAINT "EDITORA_pk" PRIMARY KEY ("Nome")
) WITH (
  OIDS=FALSE
);

ALTER TABLE "Editora" OWNER TO postgres;

ALTER TABLE "Editora" ALTER COLUMN "Cod_editora" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME "Cod_unidade_seq2"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


CREATE TABLE "Livro_copias" (
	"Cod_livro_copias" integer NOT NULL,
	"Cod_unidade_copias" integer NOT NULL,
	"Qt_copia" integer NOT NULL,
	CONSTRAINT "Livro_copias_pk" PRIMARY KEY ("Cod_livro_copias","Cod_unidade_copias")
) WITH (
  OIDS=FALSE
);

ALTER TABLE "Livro_copias" OWNER TO postgres;

CREATE TABLE "Livro_emprestimo" (
	"Cod_livro_emprestimo" integer NOT NULL,
	"Cod_unidade_emprestimo" integer NOT NULL,
	"Nr_cartao_emprestimo" integer NOT NULL,
	"Data_emprestimo" date NOT NULL,
	"Data_devolucao" date NOT NULL,
	CONSTRAINT "Livro_emprestimo_pk" PRIMARY KEY ("Cod_livro_emprestimo","Cod_unidade_emprestimo","Nr_cartao_emprestimo")
) WITH (
  OIDS=FALSE
);

ALTER TABLE "Livro_emprestimo" OWNER TO postgres;


CREATE TABLE "Unidade_Biblioteca" (
	"Cod_unidade" serial NOT NULL,
	"Nome_unidade" VARCHAR(45) NOT NULL,
	"Cidade" VARCHAR(45) NOT NULL,
	"Estado" VARCHAR(2) NOT NULL,
	CONSTRAINT "UNIDADE_BIBLIOTECA_pk" PRIMARY KEY ("Cod_unidade")
) WITH (
  OIDS=FALSE
);

ALTER TABLE "Unidade_Biblioteca" OWNER TO postgres;


CREATE TABLE "Usuario" (
	"Num_cartao" integer NOT NULL,
	"Nome" VARCHAR(45) NOT NULL UNIQUE,
	"Endereco" VARCHAR(100) NOT NULL,
	"Telefone" VARCHAR(12) NOT NULL UNIQUE,
	CONSTRAINT "USUARIO_pk" PRIMARY KEY ("Num_cartao")
) WITH (
  OIDS=FALSE
);

ALTER TABLE "Usuario" OWNER TO postgres;

ALTER TABLE "Usuario" ALTER COLUMN "Num_cartao" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Usuario_Num_Carta_seq2"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


ALTER TABLE "Livro" ADD CONSTRAINT "LIVRO_fk0" FOREIGN KEY ("Nome_editora") REFERENCES "Editora"("Nome") ON DELETE CASCADE;

ALTER TABLE "Livro_autor" ADD CONSTRAINT "LIVRO_AUTOR_fk0" FOREIGN KEY ("Cod_livro_autor") REFERENCES "Livro"("Cod_livro") ON DELETE CASCADE;


ALTER TABLE "Livro_copias" ADD CONSTRAINT "Livro_copias_fk0" FOREIGN KEY ("Cod_livro_copias") REFERENCES "Livro"("Cod_livro") ON DELETE CASCADE;
ALTER TABLE "Livro_copias" ADD CONSTRAINT "Livro_copias_fk1" FOREIGN KEY ("Cod_unidade_copias") REFERENCES "Unidade_Biblioteca"("Cod_unidade") ON DELETE CASCADE;

ALTER TABLE "Livro_emprestimo" ADD CONSTRAINT "Livro_emprestimo_fk0" FOREIGN KEY ("Cod_livro_emprestimo") REFERENCES "Livro"("Cod_livro") ON DELETE CASCADE;
ALTER TABLE "Livro_emprestimo" ADD CONSTRAINT "Livro_emprestimo_fk1" FOREIGN KEY ("Cod_unidade_emprestimo") REFERENCES "Unidade_Biblioteca"("Cod_unidade") ON DELETE CASCADE;
ALTER TABLE "Livro_emprestimo" ADD CONSTRAINT "Livro_emprestimo_fk2" FOREIGN KEY ("Nr_cartao_emprestimo") REFERENCES "Usuario"("Num_cartao") ON DELETE CASCADE;









