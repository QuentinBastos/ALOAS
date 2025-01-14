-- //////////////////////////// DROP ////////////////////////////

drop table if exists Admin;
drop table if exists Manches_petanque;
drop table if exists Match_tennis;
drop table if exists Match_foot;
drop table if exists Poules;
drop table if exists Equipes;
drop table if exists Matchs;
drop table if exists Tournois;

-- //////////////////////////// TABLES ////////////////////////////

create table Admin(
ID varchar(255),
MotDePasse varchar(500)
);

create table Tournois(
idTournoi int primary key auto_increment,
nom varchar(255),
lieu varchar(255),
discipline varchar(255),
date date,
tpsMinuteur int default null,
nbEquipesSelec int
);

create table Equipes (
idEquipe int primary key auto_increment,
nom varchar(255),
goalaverage float default 0,
fairplay float default 0,
icones text,
alt text,
idTournoi int,
constraint foreign key (idTournoi) references Tournois(idTournoi)
);

create table Poules(
	idPoule int primary key not null auto_increment,
    idTournoi int,
    idEquipe1 int default null,
    idEquipe2 int default null,
    idEquipe3 int default null,
    idEquipe4 int default null,
    idEquipe5 int default null,
    idEquipe6 int default null,
    constraint foreign key (idTournoi) references Tournois(idTournoi),
    constraint foreign key (idEquipe1) references Equipes(idEquipe),
    constraint foreign key (idEquipe2) references Equipes(idEquipe),
    constraint foreign key (idEquipe3) references Equipes(idEquipe),
    constraint foreign key (idEquipe4) references Equipes(idEquipe),
    constraint foreign key (idEquipe5) references Equipes(idEquipe),
    constraint foreign key (idEquipe6) references Equipes(idEquipe)
);


create table Matchs(
idMatch int auto_increment primary key,
idEquipe1 int,
idEquipe2 int,
idTournoi int,
matchPoule boolean default true,
noteFairplay float,
foreign key (idTournoi) references Tournois(idTournoi)
);

create table Manches_petanque(
idManche int auto_increment primary key,
idMatch int,
num_manche int,
pointsEquipe1 int default null,
pointsEquipe2 int default null,
foreign key (idMatch) references Matchs(idMatch)
);

create table Match_tennis(
setEquipe1 int default null,
setEquipe2 int default null,
idMatch int,
idManche int auto_increment primary key,
foreign key (idMatch) references Matchs(idMatch)
);

create table Match_foot(
butsEquipe1 int default null,
butsEquipe2 int default null,
idMatch int,
idMatch_foot int auto_increment primary key,
foreign key (idMatch) references Matchs(idMatch)

);

-- //////////////////////////// FUNCTIONS ////////////////////////////

drop function if exists getPointsPetanque;
delimiter $
create function getPointsPetanque (varidEquipe int, varidTournoi int) returns int
BEGIN 
DECLARE points int;
SELECT SUM(ifnull((select sum(pointsEquipe1) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe1 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = 1),0)
+
ifnull((select sum(pointsEquipe2) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe2 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = 1),0)) total into points;
return points;
END $
DELIMITER ;

drop function if exists getGagnant;
delimiter $
create function getGagnant (varidEquipe1 int, varidEquipe2 int, varidTournoi int) returns int
BEGIN 
DECLARE points1 int;
DECLARE points2 int;
DECLARE idMatchReq int;

select idMatch from Matchs where ((idEquipe1 = varidEquipe1 and idEquipe2 = varidEquipe2) or (idEquipe1 = varidEquipe1 and idEquipe2 = varidEquipe2)) and idTournoi = 1 and matchPoule = false into idMatchReq;

SELECT SUM(ifnull((select sum(pointsEquipe1) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe1 = varidEquipe1 and idTournoi=varidTournoi and m.matchPoule = 0 and m.idMatch = idMatchReq),0)
+
ifnull((select sum(pointsEquipe2) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe2 = varidEquipe1 and idTournoi=varidTournoi and m.matchPoule = 0 and m.idMatch = idMatchReq),0)) total into points1;

SELECT SUM(ifnull((select sum(pointsEquipe1) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe1 = varidEquipe2 and idTournoi=varidTournoi and m.matchPoule = 0 and m.idMatch = idMatchReq),0)
+
ifnull((select sum(pointsEquipe2) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe2 = varidEquipe2 and idTournoi=varidTournoi and m.matchPoule = 0 and m.idMatch = idMatchReq),0)) total into points2;

if points1>points2 then
return varidEquipe1;
elseif points2>points1 then
return varidEquipe2;
else
return -1;
end if;
END $
DELIMITER ;

drop function if exists getPointsPetanque;
delimiter $
create function getPointsPetanque (varidEquipe int, varidTournoi int) returns int
BEGIN 
DECLARE points int;
SELECT SUM(ifnull((select sum(pointsEquipe1) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe1 = varidEquipe and idTournoi=varidTournoi),0)
+
ifnull((select sum(pointsEquipe2) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe2 = varidEquipe and idTournoi=varidTournoi),0)) total into points;
return points;
END $
DELIMITER ;


drop function if exists getPointsTennis;
delimiter $
create function getPointsTennis (varidEquipe int, varidTournoi int) returns int
BEGIN 
DECLARE points int;
SELECT SUM(ifnull((select sum(setEquipe1) total from Match_tennis mt join Matchs m on mt.idMatch = m.idMatch where idEquipe1 = varidEquipe and idTournoi=varidTournoi),0)
+
ifnull((select sum(setEquipe2) total from Match_tennis mt join Matchs m on mt.idMatch = m.idMatch where idEquipe2 = varidEquipe and idTournoi=varidTournoi),0)) total into points;
return points;
END $
DELIMITER ;

drop function if exists getPointsFoot;
delimiter $
create function getPointsFoot (varidEquipe int, varidTournoi int) returns int
BEGIN 
DECLARE points int;
SELECT SUM(ifnull((select sum(butsEquipe1) total from Match_foot mf join Matchs m on mf.idMatch = m.idMatch where idEquipe1 = varidEquipe and idTournoi=varidTournoi),0)
+
ifnull((select sum(butsEquipe2) total from Match_foot mf join Matchs m on mf.idMatch = m.idMatch where idEquipe2 = varidEquipe and idTournoi=varidTournoi),0)) total into points;
return points;
END $
DELIMITER ;

DROP FUNCTION IF EXISTS getGagnantPet;
DELIMITER $$
CREATE FUNCTION getGagnantPet (varidEquipe1 INT, varidEquipe2 INT, varidTournoi INT, poule BOOLEAN) RETURNS INT
BEGIN 
DECLARE points1 INT DEFAULT 0;
DECLARE points2 INT DEFAULT 0;
DECLARE idMatchReq INT DEFAULT 0;

SELECT idMatch INTO idMatchReq FROM Matchs WHERE ((idEquipe1 = varidEquipe1 AND idEquipe2 = varidEquipe2) OR (idEquipe1 = varidEquipe2 AND idEquipe2 = varidEquipe1)) AND idTournoi = varidTournoi AND matchPoule = poule LIMIT 1;

SET points1 = (SELECT SUM(IFNULL((SELECT SUM(pointsEquipe1) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe1 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)
+
IFNULL((SELECT SUM(pointsEquipe2) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe1 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)) total);

SET points2 = (SELECT SUM(IFNULL((SELECT SUM(pointsEquipe1) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe2 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)
+
IFNULL((SELECT SUM(pointsEquipe2) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe2 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)) total);

IF points1 > points2 THEN
RETURN varidEquipe1;
ELSEIF points1 < points2 THEN
RETURN varidEquipe2;
ELSE
RETURN -1;
END IF;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS getGagnantTen;
DELIMITER $
CREATE FUNCTION getGagnantTen (varidEquipe1 INT, varidEquipe2 INT, varidTournoi INT, poule BOOLEAN) RETURNS INT
BEGIN 
DECLARE points1 INT;
DECLARE points2 INT;
DECLARE idMatchReq INT;

SELECT idMatch FROM Matchs WHERE ((idEquipe1 = varidEquipe1 AND idEquipe2 = varidEquipe2) OR (idEquipe1 = varidEquipe2 AND idEquipe2 = varidEquipe1)) AND idTournoi = varidTournoi AND matchPoule = poule LIMIT 1 INTO idMatchReq;

SELECT SUM(IFNULL((SELECT SUM(setEquipe1) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe1 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0) + IFNULL((SELECT SUM(setEquipe2) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe1 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)) total INTO points1;

SELECT SUM(IFNULL((SELECT SUM(setEquipe1) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe2 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0) + IFNULL((SELECT SUM(setEquipe2) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe2 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)) total INTO points2;

IF points1>points2 THEN
RETURN varidEquipe1;
ELSEIF points1<points2 THEN
RETURN varidEquipe2;
ELSE 
RETURN -1;
END IF;
END $
DELIMITER ;


DROP FUNCTION IF EXISTS getGagnantFoot;
DELIMITER $
CREATE FUNCTION getGagnantFoot (varidEquipe1 INT, varidEquipe2 INT, varidTournoi INT, poule BOOLEAN) RETURNS INT
BEGIN 
DECLARE points1 INT;
DECLARE points2 INT;
DECLARE idMatchReq INT;

SELECT idMatch FROM Matchs WHERE ((idEquipe1 = varidEquipe1 AND idEquipe2 = varidEquipe2) OR (idEquipe1 = varidEquipe2 AND idEquipe2 = varidEquipe1)) AND idTournoi = varidTournoi AND matchPoule = poule LIMIT 1 INTO idMatchReq;

SELECT SUM(IFNULL((SELECT SUM(butsEquipe1) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe1 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0) + IFNULL((SELECT SUM(butsEquipe2) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe1 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)) total INTO points1;

SELECT SUM(IFNULL((SELECT SUM(butsEquipe1) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe2 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0) + IFNULL((SELECT SUM(butsEquipe2) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe2 AND idTournoi=varidTournoi AND m.matchPoule = poule AND m.idMatch = idMatchReq),0)) total INTO points2;

IF points1>points2 THEN
RETURN varidEquipe1;
ELSEIF points1<points2 THEN
RETURN varidEquipe2;
ELSE 
RETURN -1;
END IF;
END $
DELIMITER ;


drop function if exists getPointsPetanqueHorsPoule;
delimiter $
create function getPointsPetanqueHorsPoule (varidEquipe int, varidTournoi int) returns int
BEGIN 
DECLARE points int;
SELECT SUM(ifnull((select sum(pointsEquipe1) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe1 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = false),0)
+
ifnull((select sum(pointsEquipe2) total from Manches_petanque mp join Matchs m on mp.idMatch = m.idMatch where idEquipe2 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = false),0)) total into points;
return points;
END $
DELIMITER ;

drop function if exists getPointsTennisHorsPoule;
delimiter $
create function getPointsTennisHorsPoule (varidEquipe int, varidTournoi int) returns int
BEGIN 
DECLARE points int;
SELECT SUM(ifnull((select sum(setEquipe1) total from Match_tennis mt join Matchs m on mt.idMatch = m.idMatch where idEquipe1 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = false),0)
+
ifnull((select sum(setEquipe2) total from Match_tennis mt join Matchs m on mt.idMatch = m.idMatch where idEquipe2 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = false),0)) total into points;
return points;
END $
DELIMITER ;

drop function if exists getPointsFootHorsPoule;
delimiter $
create function getPointsFootHorsPoule (varidEquipe int, varidTournoi int) returns int
BEGIN 
DECLARE points int;
SELECT SUM(ifnull((select sum(butsEquipe1) total from Match_foot mf join Matchs m on mf.idMatch = m.idMatch where idEquipe1 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = false),0)
+
ifnull((select sum(butsEquipe2) total from Match_foot mf join Matchs m on mf.idMatch = m.idMatch where idEquipe2 = varidEquipe and idTournoi=varidTournoi and m.matchPoule = false),0)) total into points;
return points;
END $
DELIMITER ;

drop function if exists SupprimerTournoi;
delimiter $
create function SupprimerTournoi(idT int) returns int
BEGIN


DELETE FROM Poules WHERE idTournoi = idT;

DELETE FROM Equipes WHERE idTournoi = idT;




DELETE FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idTournoi = idT); 

DELETE FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idTournoi = idT); 

DELETE FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idTournoi = idT); 


DELETE FROM Matchs WHERE idTournoi = idT;

DELETE FROM Tournois WHERE idTournoi = idT;


return 1;
END$
DELIMITER ;


-- //////////////////////////// INSERTIONS ////////////////////////////

insert into Admin (ID,MotDePasse) values ("f.valette","Aloas.Valette@");


DROP FUNCTION IF EXISTS updateGoalaverageFoot;
DELIMITER $$
CREATE FUNCTION updateGoalaverageFoot(varIdMatch INT) RETURNS INT
BEGIN
    DECLARE varIdEquipe1 INT;
    DECLARE varIdEquipe2 INT;
 
    DECLARE butsPEquipe1 FLOAT DEFAULT 0.0;
    DECLARE butsMEquipe1 FLOAT DEFAULT 0.0;
    
    DECLARE butsPEquipe2 FLOAT DEFAULT 0.0;
    DECLARE butsMEquipe2 FLOAT DEFAULT 0.0;
    
    DECLARE totalMatchEquipe1 INT;
    DECLARE totalMatchEquipe2 INT;

    SELECT idEquipe1 INTO varIdEquipe1 FROM Matchs WHERE idMatch = varIdMatch;
    SELECT idEquipe2 INTO varIdEquipe2 FROM Matchs WHERE idMatch = varIdMatch;
   
    SELECT COUNT(*) INTO totalMatchEquipe1 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1 OR idEquipe2= varIdEquipe1);
    SELECT COUNT(*) INTO totalMatchEquipe2 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2 OR idEquipe2= varIdEquipe2);
    
    SELECT IFNULL(SUM(butsEquipe1),0)+butsMEquipe1 INTO butsMEquipe1 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1);
    SELECT IFNULL(SUM(butsEquipe2),0)+butsMEquipe1 INTO butsMEquipe1 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe1);
    
    SELECT IFNULL(SUM(butsEquipe1),0)+butsMEquipe2 INTO butsMEquipe2 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2);
    SELECT IFNULL(SUM(butsEquipe2),0)+butsMEquipe2 INTO butsMEquipe2 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe2);
    
    SELECT IFNULL(SUM(butsEquipe2),0)+butsPEquipe1 INTO butsPEquipe1 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1);
    SELECT IFNULL(SUM(butsEquipe1),0)+butsPEquipe1 INTO butsPEquipe1 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe1);
    
    SELECT IFNULL(SUM(butsEquipe2),0)+butsPEquipe2 INTO butsPEquipe2 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2);
    SELECT IFNULL(SUM(butsEquipe1),0)+butsPEquipe2 INTO butsPEquipe2 FROM Match_foot WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe2); 
    
    UPDATE Equipes SET goalaverage=butsMEquipe1-butsPEquipe1 WHERE idEquipe=varIdEquipe1;
    UPDATE Equipes SET goalaverage=butsMEquipe2-butsPEquipe2 WHERE idEquipe=varIdEquipe2;
    
    RETURN 1;
END$$
DELIMITER ;


DROP FUNCTION IF EXISTS updateGoalaverageTennis;
DELIMITER $$
CREATE FUNCTION updateGoalaverageTennis(varIdMatch INT) RETURNS INT
BEGIN
    DECLARE varIdEquipe1 INT;
    DECLARE varIdEquipe2 INT;
 
    DECLARE setPEquipe1 FLOAT DEFAULT 0.0;
    DECLARE setMEquipe1 FLOAT DEFAULT 0.0;
    
    DECLARE setPEquipe2 FLOAT DEFAULT 0.0;
    DECLARE setMEquipe2 FLOAT DEFAULT 0.0;
    
    DECLARE totalMatchEquipe1 INT;
    DECLARE totalMatchEquipe2 INT;

    SELECT idEquipe1 INTO varIdEquipe1 FROM Matchs WHERE idMatch = varIdMatch;
    SELECT idEquipe2 INTO varIdEquipe2 FROM Matchs WHERE idMatch = varIdMatch;
   
    SELECT COUNT(*) INTO totalMatchEquipe1 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1 OR idEquipe2= varIdEquipe1);
    SELECT COUNT(*) INTO totalMatchEquipe2 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2 OR idEquipe2= varIdEquipe2);
    
    SELECT IFNULL(SUM(setEquipe1),0)+setMEquipe1 INTO setMEquipe1 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1);
    SELECT IFNULL(SUM(setEquipe2),0)+setMEquipe1 INTO setMEquipe1 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe1);
    
    SELECT IFNULL(SUM(setEquipe1),0)+setMEquipe2 INTO setMEquipe2 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2);
    SELECT IFNULL(SUM(setEquipe2),0)+setMEquipe2 INTO setMEquipe2 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe2);
    
    SELECT IFNULL(SUM(setEquipe2),0)+setPEquipe1 INTO setPEquipe1 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1);
    SELECT IFNULL(SUM(setEquipe1),0)+setPEquipe1 INTO setPEquipe1 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe1);
    
    SELECT IFNULL(SUM(setEquipe2),0)+setPEquipe2 INTO setPEquipe2 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2);
    SELECT IFNULL(SUM(setEquipe1),0)+setPEquipe2 INTO setPEquipe2 FROM Match_tennis WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe2); 
    
    UPDATE Equipes SET goalaverage=setMEquipe1-setPEquipe1 WHERE idEquipe=varIdEquipe1;
    UPDATE Equipes SET goalaverage=setMEquipe2-setPEquipe2 WHERE idEquipe=varIdEquipe2;
    
    RETURN 1;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS updateGoalaveragePetanque;
DELIMITER $$
CREATE FUNCTION updateGoalaveragePetanque(varIdMatch INT) RETURNS INT
BEGIN
    DECLARE varIdEquipe1 INT;
    DECLARE varIdEquipe2 INT;
 
    DECLARE pointsPEquipe1 FLOAT DEFAULT 0.0;
    DECLARE pointsMEquipe1 FLOAT DEFAULT 0.0;
    
    DECLARE pointsPEquipe2 FLOAT DEFAULT 0.0;
    DECLARE pointsMEquipe2 FLOAT DEFAULT 0.0;
    
    DECLARE totalMatchEquipe1 INT;
    DECLARE totalMatchEquipe2 INT;

    SELECT idEquipe1 INTO varIdEquipe1 FROM Matchs WHERE idMatch = varIdMatch;
    SELECT idEquipe2 INTO varIdEquipe2 FROM Matchs WHERE idMatch = varIdMatch;
   
    SELECT COUNT(*) INTO totalMatchEquipe1 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1 OR idEquipe2= varIdEquipe1);
    SELECT COUNT(*) INTO totalMatchEquipe2 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2 OR idEquipe2= varIdEquipe2);
    
    SELECT IFNULL(SUM(pointsEquipe1),0)+pointsMEquipe1 INTO pointsMEquipe1 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1);
    SELECT IFNULL(SUM(pointsEquipe2),0)+pointsMEquipe1 INTO pointsMEquipe1 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe1);
    
    SELECT IFNULL(SUM(pointsEquipe1),0)+pointsMEquipe2 INTO pointsMEquipe2 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2);
    SELECT IFNULL(SUM(pointsEquipe2),0)+pointsMEquipe2 INTO pointsMEquipe2 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe2);
    
    SELECT IFNULL(SUM(pointsEquipe2),0)+pointsPEquipe1 INTO pointsPEquipe1 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe1);
    SELECT IFNULL(SUM(pointsEquipe1),0)+pointsPEquipe1 INTO pointsPEquipe1 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe1);
    
    SELECT IFNULL(SUM(pointsEquipe2),0)+pointsPEquipe2 INTO pointsPEquipe2 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe1= varIdEquipe2);
    SELECT IFNULL(SUM(pointsEquipe1),0)+pointsPEquipe2 INTO pointsPEquipe2 FROM Manches_petanque WHERE idMatch IN (SELECT idMatch FROM Matchs WHERE idEquipe2= varIdEquipe2); 
    
    UPDATE Equipes SET goalaverage=pointsMEquipe1-pointsPEquipe1 WHERE idEquipe=varIdEquipe1;
    UPDATE Equipes SET goalaverage=pointsMEquipe2-pointsPEquipe2 WHERE idEquipe=varIdEquipe2;
    
    RETURN 1;
END$$
DELIMITER ;

DROP FUNCTION IF EXISTS getPointsPouleFoot;
DELIMITER $
CREATE FUNCTION getPointsPouleFoot(varidEquipe INT, varidTournoi INT) RETURNS INT
BEGIN 
    DECLARE pointsM INT;
    DECLARE pointsP INT;
    SELECT SUM(IFNULL((SELECT SUM(butsEquipe1) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)
    +
    IFNULL((SELECT SUM(butsEquipe2) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe AND idTournoi=varidTournoi  AND m.matchPoule=1),0)) total INTO pointsM;

    SELECT SUM(IFNULL((SELECT SUM(butsEquipe2) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)
    +
    IFNULL((SELECT SUM(butsEquipe1) total FROM Match_foot mf JOIN Matchs m ON mf.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe AND idTournoi=varidTournoi  AND m.matchPoule=1),0)) total INTO pointsP;
    RETURN pointsM-pointsP;
END $
DELIMITER ;

DROP FUNCTION IF EXISTS getPointsPoulePetanque;
DELIMITER $
CREATE FUNCTION getPointsPoulePetanque(varidEquipe INT, varidTournoi INT) RETURNS INT
BEGIN 
    DECLARE pointsP INT;
    DECLARE pointsM INT;
    SELECT SUM(IFNULL((SELECT SUM(pointsEquipe1) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)
    +
    IFNULL((SELECT SUM(pointsEquipe2) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)) total INTO pointsM;

    SELECT SUM(IFNULL((SELECT SUM(pointsEquipe2) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)
    +
    IFNULL((SELECT SUM(pointsEquipe1) total FROM Manches_petanque mp JOIN Matchs m ON mp.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)) total INTO pointsP;

    RETURN pointsM-pointsP;
END $
DELIMITER ;

DROP FUNCTION IF EXISTS getPointsPouleTennis;
DELIMITER $
CREATE FUNCTION getPointsPouleTennis(varidEquipe INT, varidTournoi INT) RETURNS INT
BEGIN 
    DECLARE pointsM INT;
    DECLARE pointsP INT;
    SELECT SUM(IFNULL((SELECT SUM(setEquipe1) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)
    +
    IFNULL((SELECT SUM(setEquipe2) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)) total INTO pointsM;

    SELECT SUM(IFNULL((SELECT SUM(setEquipe2) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe1 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)
    +
    IFNULL((SELECT SUM(setEquipe1) total FROM Match_tennis mt JOIN Matchs m ON mt.idMatch = m.idMatch WHERE idEquipe2 = varidEquipe AND idTournoi=varidTournoi AND m.matchPoule=1),0)) total INTO pointsP;

    RETURN pointsM-pointsP;
END $
DELIMITER ;
