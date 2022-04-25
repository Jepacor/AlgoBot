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


