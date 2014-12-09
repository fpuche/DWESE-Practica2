create table casas (
   idcasa int NOT NULL auto_increment,
   localidad varchar(40) NOT NULL,
   precio int NOT NULL,
   superficie int NOT NULL,
   habitaciones int NOT NULL, 
   CONSTRAINT PK_id_casas PRIMARY KEY(idcasa)
)

CREATE TABLE fotos (
idfoto int NOT NULL auto_increment,
idcasa int NOT NULL,    
url varchar(200)NOT NULL,
CONSTRAINT PK_id_fotos PRIMARY KEY(idfoto),
CONSTRAINT FK_id_casa FOREIGN KEY (idcasa) REFERENCES casas(idcasa) ON DELETE CASCADE ON UPDATE CASCADE
)
