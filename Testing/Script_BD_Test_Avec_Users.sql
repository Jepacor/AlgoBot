CREATE TABLE Resultats(
   Id_Resultats INT AUTO_INCREMENT,
   Niveau INT,
   PRIMARY KEY(Id_Resultats)
);

CREATE TABLE Entrees(
   Id_Entrees INT AUTO_INCREMENT,
   Entree VARCHAR(50) ,
   Id_Resultats INT NOT NULL,
   PRIMARY KEY(Id_Entrees),
   FOREIGN KEY(Id_Resultats) REFERENCES Resultats(Id_Resultats)
);

CREATE TABLE Sorties(
   Id_Sorties INT AUTO_INCREMENT,
   Sortie VARCHAR(50) ,
   Id_Resultats INT NOT NULL,
   PRIMARY KEY(Id_Sorties),
   FOREIGN KEY(Id_Resultats) REFERENCES Resultats(Id_Resultats)
);

CREATE TABLE Utilisateurs(
   Id_Utilisateurs INT AUTO_INCREMENT,
   Username VARCHAR(100) ,
   Password VARCHAR(100) ,
   PRIMARY KEY(Id_Utilisateurs)
);

CREATE TABLE Code(
   Id_Code INT AUTO_INCREMENT,
   Code TEXT,
   Id_Utilisateurs INT NOT NULL,
   Id_Resultats INT NOT NULL,
   PRIMARY KEY(Id_Code),
   FOREIGN KEY(Id_Utilisateurs) REFERENCES Utilisateurs(Id_Utilisateurs),
   FOREIGN KEY(Id_Resultats) REFERENCES Resultats(Id_Resultats)
);



