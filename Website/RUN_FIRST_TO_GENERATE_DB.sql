 
DROP DATABASE assignment;
CREATE DATABASE assignment;

USE assignment;

DROP TABLE IF EXISTS Reservations;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Books;
DROP TABLE IF EXISTS Users;

/*
	CREATION PHASE
*/

CREATE TABLE Users(

	Username 		VARCHAR(32) NOT NULL PRIMARY KEY,
	Pword 		VARCHAR(32) NOT NULL,
	FirstName		VARCHAR(32) NOT NULL,
	Surname 		VARCHAR(32) NOT NULL,
	AddressLine1 	VARCHAR(32) NOT NULL,
	AddressLine2 	VARCHAR(32) NOT NULL,
	City 			VARCHAR(32) NOT NULL,
	Telephone 		VARCHAR(32) NOT NULL,
	Mobile 			VARCHAR(32) NOT NULL
	
);

CREATE TABLE Categories(

	CategoryID 		INT(3) PRIMARY KEY,
	CategoryDescription 	VARCHAR(32)
	
);

CREATE TABLE Books(

	ISBN 			VARCHAR(32) NOT NULL PRIMARY KEY,
	BookTitle 		VARCHAR(32) NOT NULL,
	Author 			VARCHAR(32) NOT NULL,
	Edition 		INT(1) UNSIGNED NOT NULL,
	YearPublished 	INT(4) NOT NULL,
	CategoryID 	INT(3) NOT NULL,
	Reserved VARCHAR(1) NOT NULL,
	
	FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)

);

CREATE TABLE Reservations(

	ISBN 			VARCHAR(32) NOT NULL,
	Username 		VARCHAR(32) NOT NULL,
	reservedDate 	DATE NOT NULL,
	
	PRIMARY KEY (ISBN),
	FOREIGN KEY (ISBN) REFERENCES Books(ISBN),
	FOREIGN KEY (Username) REFERENCES Users(Username)
);

/*
	INSERTION PHASE
*/

-- Users table insertions
INSERT INTO Users(Username, Pword, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
VALUES('alanjmckenna', 't1234s', 'Alan', 'McKenna', '38 Cranley Road', 'Fairview', 'Dublin', '9998377', '856625567');

INSERT INTO Users(Username, Pword, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
VALUES('joecrotty', 'kj7899', 'Joeseph', 'Crotty', 'Apt 5 Clyde Road', 'Donnybrook', 'Dublin', '8887889', '876654456');

INSERT INTO Users(Username, Pword, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
VALUES('tommy100', '123456', 'tom', 'behan', '14 hyde road', 'dalkey', 'dublin', '9983747', '876738782');

-- Categories table insertions
INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(001, 'Health');

INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(002, 'Business');

INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(003, 'Biography');

INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(004, 'Technology');

INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(005, 'Travel');

INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(006, 'Self-Help');

INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(007, 'Cookery');

INSERT INTO Categories(CategoryID, CategoryDescription)
VALUES(008, 'Fiction');

-- Books table insertions
INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('093-403992', 'Computers in Business', 'Alicia Oneill', 3, 1997, 003, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('23472-8729', 'Exploring Peru', 'Stephanie Birch', 4, 2005, 005, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('237-34823', 'Business Strategy', 'Joe Peppard', 2, 2002, 002, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('23u8-923849', 'A guide to nutrition', 'John Thorpe', 2, 1997, 001, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID,Reserved)
VALUES('2983-3494', 'Cooking for children', 'Anabelle Sharpe', 1, 2003, 007, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('82n8-308', 'computers for idiots', 'Susan ONeill', 5, 1998, 004, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('9823-23984', 'My life in picture', 'Kevin Graham', 8, 2004, 001, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('9823-2403-0', 'DaVinci Code', 'Dan Brown', 1, 2003, 008, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('98234-029384', 'My ranch in Texas', 'George Bush', 1, 2005, 001, 'Y');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('9823-98345', 'How to cook Italian food', 'Jamie Oliver', 2, 2005, 007, 'Y');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('9823-98487', 'Optimising your business', 'Cleo Blair', 1, 2001, 002, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('988745-234', 'Tara Road', 'Maeve Binchy', 4, 2002, 008, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('993-004-00', 'My life in bits', 'John Smith', 1, 2001, 001, 'N');

INSERT INTO Books(ISBN, BookTitle, Author, Edition, YearPublished, CategoryID, Reserved)
VALUES('9987-0039882', 'Shooting History', 'Jon Snow', 1, 2003, 001, 'N');

-- Reservations table insertions
INSERT INTO Reservations(ISBN, Username, reservedDate)
VALUES('98234-029384', 'joecrotty', '2008/10/11');

INSERT INTO Reservations(ISBN, Username, reservedDate)
VALUES('9823-98345', 'tommy100', '2008/10/11');