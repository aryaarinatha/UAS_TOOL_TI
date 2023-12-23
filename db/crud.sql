CREATE DATABASE crud;
USE crud;

CREATE TABLE peserta (
  id_peserta INT(11) NOT NULL AUTO_INCREMENT,
  nim CHAR(10) NOT NULL,
  nama VARCHAR(50) NOT NULL,
  fakultas VARCHAR(50) NOT NULL,
  no_hp CHAR(13) NOT NULL,
  alamat VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_peserta)
);