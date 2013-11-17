DROP DATABASE IF EXISTS dbDanWu;
CREATE DATABASE IF NOT EXISTS dbDanWu;

USE dbDanWu;
DROP TABLE IF EXISTS tblUser;
CREATE TABLE IF NOT EXISTS tblUser (
	intUserID int(32) NOT NULL AUTO_INCREMENT, 
	strUsername varchar(32) NOT NULL,
	strPassword varchar(32) NOT NULL, 
	strFirstName varchar(32) NOT NULL, 
	strLastName varchar(32) NOT NULL,  
	strEmail varchar(32) NOT NULL, 
	blnAdmin tinyint(6) NOT NULL,
	PRIMARY KEY (intUserID))
	ENGINE=InnoDB
	AUTO_INCREMENT=2
	DEFAULT CHARSET=latin1;
 
 DROP TABLE IF EXISTS tblEntry;
 CREATE TABLE IF NOT EXISTS tblEntry (
 intEntryID int(32) NOT NULL AUTO_INCREMENT,
 intUserID int(32) NOT NULL,  intBookID int(32) NOT NULL,
 strBookName varchar(32) NOT NULL,
 strAuthor varchar(32) NOT NULL,
 strPublisher varchar(32) NOT NULL,
 dtmDate date NOT NULL,
 dblPrice double NOT NULL,
 PRIMARY KEY (intEntryID), 
 KEY intUserID (intUserID),  
 CONSTRAINT tblentry_ibfk_1
 FOREIGN KEY (intUserID) REFERENCES tbluser (intUserID) ON DELETE NO ACTION ON UPDATE CASCADE)
 ENGINE=InnoDB
 AUTO_INCREMENT=8
 DEFAULT CHARSET=latin1;