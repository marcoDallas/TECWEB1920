SET FOREIGN_KEY_CHECKS=0;

-- elimina le tabelle se gia' pesenti
DROP TABLE IF EXISTS Utente;
DROP TABLE IF EXISTS Prodotto;
DROP TABLE IF EXISTS Recensione;

CREATE TABLE Utente (
	Email VARCHAR(50) PRIMARY KEY,
	Pwd VARCHAR(10) NOT NULL,
	Nome VARCHAR(50) NOT NULL,
	Cognome VARCHAR(50) NOT NULL,
	DataNascita DATE NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Prodotto (
	Codice CHAR(10) PRIMARY KEY,
	Nome VARCHAR(50) NOT NULL,
	TipoProdotto ENUM('Torta','Pasta') NOT NULL,
	Immagine VARCHAR(100),
	Descrizione VARCHAR(500),
	Ingredienti VARCHAR(500)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Recensione (
	EmailUtente CHAR(50),
	CodiceProdotto CHAR(10),
	Testo VARCHAR(500),
	Valutazione TINYINT,
	PRIMARY KEY (CodiceProdotto, EmailUtente),
	FOREIGN KEY (CodiceProdotto) REFERENCES Prodotto(Codice) ON DELETE CASCADE,
	FOREIGN KEY (EmailUtente) REFERENCES Utente(Email) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Popola le tabelle 

LOAD DATA LOCAL INFILE 'Utente.txt' INTO TABLE Utente;
LOAD DATA LOCAL INFILE 'Prodotto.txt' INTO TABLE Prodotto;
LOAD DATA LOCAL INFILE 'Recensione.txt' INTO TABLE Recensione;

SET FOREIGN_KEY_CHECKS=1;
