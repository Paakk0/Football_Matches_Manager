CREATE DATABASE IF NOT EXISTS FMA;
USE FMA;

CREATE TABLE Leagues (
    Id   INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(100),
    PRIMARY KEY (Id)
);

CREATE TABLE Teams (
    Id                   INT NOT NULL AUTO_INCREMENT,
    Id_League            INT NOT NULL,
    Name                 VARCHAR(100),
    Country              VARCHAR(100),
    Formation            VARCHAR(10),
    Wins                 INT,
    Losses               INT,
    Draws                INT,
    PRIMARY KEY (Id),
    FOREIGN KEY (Id_League) REFERENCES Leagues(Id)
);

CREATE TABLE Users (
    Id                  INT NOT NULL AUTO_INCREMENT,
    Name                VARCHAR(100),
    Email               VARCHAR(100),
    Password            VARCHAR(100),
    Registration_Date   DATETIME,
    Role                BOOLEAN,
    PRIMARY KEY (Id)
);

CREATE TABLE Player (
    Id       INT NOT NULL AUTO_INCREMENT,
    Id_Team  INT NOT NULL,
    Name     VARCHAR(100),
    Position VARCHAR(100),
    PRIMARY KEY (Id),
    FOREIGN KEY (Id_Team) REFERENCES Teams(Id)
);

CREATE TABLE Matches (
    Id       INT NOT NULL AUTO_INCREMENT,
    Id_Team1 INT NOT NULL,
    Id_Team2 INT NOT NULL,
    Date     DATETIME,
    PRIMARY KEY (Id),
    FOREIGN KEY (Id_Team1) REFERENCES Teams(Id) ON DELETE CASCADE,
    FOREIGN KEY (Id_Team2) REFERENCES Teams(Id) ON DELETE CASCADE
);

CREATE TABLE Stats (
    Id                 INT NOT NULL AUTO_INCREMENT,
    Id_Match           INT NOT NULL,
    Id_PlayerMVP       INT NOT NULL,
    Ball_Control_Team1 INT,
    PRIMARY KEY (Id),
    FOREIGN KEY (Id_PlayerMVP) REFERENCES Player(Id) ON DELETE CASCADE,
    FOREIGN KEY (Id_Match) REFERENCES Matches(Id) ON DELETE CASCADE
);

CREATE TABLE Cartons (
    Id        INT NOT NULL AUTO_INCREMENT,
    Id_Player INT NOT NULL,
    Id_Stat   INT,
    Carton    INT,
    Minute      INT,
    PRIMARY KEY (Id),
    FOREIGN KEY (Id_Player) REFERENCES Player(Id) ON DELETE CASCADE
);

CREATE TABLE Goals (
    Id        INT NOT NULL AUTO_INCREMENT,
    Id_Stat   INT NOT NULL,
    Id_Player INT NOT NULL,
    Minute      INT,
    PRIMARY KEY (Id),
    FOREIGN KEY (Id_Stat) REFERENCES Stats(Id) ON DELETE CASCADE,
    FOREIGN KEY (Id_Player) REFERENCES Player(Id) ON DELETE CASCADE
);

CREATE TABLE Following_Teams (
    Id_User INT NOT NULL,
    Id_Team INT NOT NULL,
    FOREIGN KEY (Id_User) REFERENCES Users(Id) ON DELETE CASCADE,
    FOREIGN KEY (Id_Team) REFERENCES Teams(Id) ON DELETE CASCADE
);
