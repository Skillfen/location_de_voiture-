CREATE DATABASE NadorCars;
USE NadorCars;

CREATE TABLE Client (
    Cin varchar(10) primary key,
    Nom varchar(60) not null ,
    Prenom varchar(60) not null,
    Nationalite varchar(60) not null,
	Telephone varchar(60) not null, 
    Permis varchar(60) not null,
    Observation text null
);
drop trigger Tr_beforeUpdateClient
delimiter // 
CREATE PROCEDURE SP_AddClient(Cin varchar(10),Nom varchar(60),Prenom varchar(60),
							Nationalite varchar(60),Telephone varchar(60),Permis varchar(60),Observation text)
BEGIN
    INSERT INTO Client VALUES (Cin, Nom, Prenom, Nationalite, telephone,Permis, Observation);
end //
delimiter ;

delimiter // 
CREATE PROCEDURE SP_DeleteClient(c varchar(50))
BEGIN
    delete from Client where Cin = c;
end //
delimiter ;

delimiter // 
CREATE PROCEDURE SP_GetAllClient()
BEGIN
	select * from Client;
end //
delimiter ;

delimiter // 
CREATE PROCEDURE SP_UpdateClient(OldCin varchar(10),NewCin varchar(10),N varchar(60),P varchar(60),
							Natio varchar(60),Tele varchar(60),Per varchar(60),Obser text)
BEGIN
	update Client set Cin = NewCin ,Nom = N,Prenom = P,Nationalite = Natio,Telephone = Tele,Permis = Per,
    Observation = Obser where Cin = OldCin;
end //
delimiter ;

delimiter // 
CREATE PROCEDURE SP_FindClient(info varchar(100))
BEGIN
	SELECT * FROM Client WHERE
				(Cin REGEXP info OR
                Nom REGEXP info OR
                Prenom REGEXP info OR
                Nationalite REGEXP info OR
                Telephone REGEXP info OR
                Permis REGEXP info OR
                Observation REGEXP info);
end //
delimiter ;
CREATE TABLE Cars (
    Matricule varchar(50) primary key,
    Marque varchar(50) not null,
    model varchar(50) not null,
    type varchar(50) not null , 
    Observation text null
);

delimiter // 
CREATE PROCEDURE SP_AddCars(Matricule varchar(50),Marque varchar(50),model varchar(50),
							typ varchar(50),Observation text)
BEGIN
    INSERT INTO Cars VALUES (Matricule, Marque, model, typ ,Observation);
end //
delimiter ;

delimiter // 
CREATE PROCEDURE SP_UpdateCars(OldMtcl varchar(50),NewMtcl varchar(50),Mrq varchar(50),mdl varchar(50),
							typ varchar(50),Obser text)
BEGIN
	update Cars set Matricule = NewMtcl ,Marque = Mrq , model = mdl,Type = typ , Observation = Obser where Matricule = OldMtcl;
end //
delimiter ;
delimiter // 
CREATE PROCEDURE SP_DeleteCars(M varchar(50))
BEGIN
    delete from Cars where Matricule = M;
end //
delimiter ;
delimiter //
CREATE PROCEDURE SP_GetAllCars()
BEGIN
	select * from Cars;
end //
delimiter ;
delimiter // 
CREATE PROCEDURE SP_FindCars(inf varchar(100))
BEGIN
	SELECT * FROM Cars WHERE
				(
                Matricule REGEXP inf OR
                Marque REGEXP inf OR
                model REGEXP inf OR
                Type REGEXP inf OR
                Observation REGEXP inf
                );
end //
delimiter ;
	create TABLE Reservation (
		id int auto_increment primary key ,
		Cin varchar(10) not null,
		Matricule varchar(50) not null, 
		DateDebut date not null,
		DateFin date not null,
        unique(Matricule,DateDebut),
		prix double not null CHECK (prix >= 0),
		FOREIGN KEY (Matricule) REFERENCES Cars(Matricule) on update cascade   ,
		FOREIGN KEY (Cin) REFERENCES Client(Cin) on update cascade   ,
		CHECK (DateDebut < DateFin)
	);

delimiter // 
CREATE PROCEDURE SP_AddReservation(Cin varchar(10),Matricule varchar(60),DateDebut date,
							DateFin date,prix decimal(8,2))
BEGIN
    INSERT INTO Reservation(Cin,Matricule,DateDebut,DateFin,prix) VALUES (Cin, Matricule, DateDebut,DateFin,prix);
end //
delimiter ;
delimiter // 
CREATE PROCEDURE SP_GetReservation()
BEGIN
	select * from Reservation;
end //
delimiter ;

delimiter // 
CREATE PROCEDURE GetLast_5()
BEGIN
	select * from Reservation order by DateDebut desc limit 5;
end //
delimiter ;
delimiter // 
CREATE PROCEDURE SP_DeleteReservation(id_ int)
BEGIN
    delete from Reservation where id = id_;
end //
delimiter // 
delimiter ;
delimiter $
create procedure SP_GetCin_NomByClient()
begin
	select Cin,concat(nom," ",prenom) from Client;
end$
delimiter ;



delimiter $
create procedure SP_GetVoitureByMarque(mar varchar(50),dtd date,dtf date)
begin
	select * from cars where Matricule not in (select matricule from reservation where 
        (datedebut <= dtd AND datefin >= dtd)
        OR (datedebut <= dtf AND datefin >= dtf)
        OR (datedebut >= dtd AND datefin <= dtf)
    )
	and marque = mar;
end$
delimiter ;





DELIMITER $
create trigger Tr_AfterUpdateClient after Update on Client
for each row
begin
	update reservation set Cin = new.Cin where Cin = Old.Cin;
end$
delimiter ;

DELIMITER $
create trigger Tr_AfterUpdateCar after Update on cars
for each row
begin
	update reservation set Matricule = new.Matricule where Matricule = Old.Matricule;

end$
delimiter ;
delimiter $
create procedure SP_VerifierDateFin(mat varchar(50),dtf date)
begin
select datedebut from reservation where Matricule=mat and DateDebut > dtf order by DateFin asc limit 1 ;
end$
delimiter ;

delimiter $
create procedure SP_GetDateFinById(idreservation int)
begin
select DateFin from reservation where Id = idreservation ;
end$
delimiter ;

delimiter $
create  procedure SP_UpdateReservation(idupdate int,cinn varchar(10) ,dtf date,newprix double)
begin
	update Reservation set DateFin = dtf ,prix = newprix ,Cin=cinn where id = idupdate;
end$
delimiter ;
delimiter //
CREATE  PROCEDURE SP_FindReservation(inf varchar(100))
BEGIN
SELECT DISTINCT r.*
FROM Reservation r
JOIN Client c ON r.Cin = c.Cin
JOIN Cars ca ON r.Matricule = ca.Matricule
WHERE
    (
        r.Id REGEXP inf OR
        r.Cin REGEXP inf OR
        r.Matricule REGEXP inf OR
        r.DateDebut REGEXP inf OR
        r.DateFin REGEXP inf OR
        r.prix REGEXP inf
    );
    END//
DELIMITER ;

delimiter ;


CREATE TABLE Admin (
    Login varchar(60) primary key,
    MotPass varchar(150) not null
);
select * from Admin ;
INSERT INTO Admin (Login, MotPass) VALUES ('user', 'user');
INSERT INTO Admin (Login, MotPass) VALUES ("Admin","Admin");
update Admin set MotPass = "$2y$10$p2FFrvVOL08KJWimksTikeaGs8FWtx3PE2jUA0e4WMNNiy0dDiDBO" where Login = "Admin" ; -- recuperer from C_Login.php : echo password_hash("Votre password",PASSWORD_DEFAULT)

insert into Client VALUES ('AB123456', 'Smith', 'John', 'British', '0612345678', 'B', null),
('CD456789', 'Badi', 'Oussama', 'Marocaine', '0612345679', 'C', 'Regular client'),
('EF789012', 'Bomdien', 'Mohamed', 'Marocaine', '0612345680', 'D', null),
('GH234567', 'Daoudi', 'Bilal', 'Marocaine', '0612345681', 'A', 'Special request'),
('IJ345678', 'Oukkoa', 'Outhman', 'Marocaine', '0612345682', 'B', null),
('KL567890', 'Bentahra', 'Mohamed', 'Marocaine', '0612345683', 'C', null),
('MN678901', 'Ouelhadj', 'Omar', 'Marocaine', '0612345684', 'D', null),
('OP789012', 'Badi', 'Issam', 'Marocaine', '0612345685', 'A', null),
('QR890123', 'Oualli', 'Walid', 'Marocaine', '0612345686', 'B', null),
('ST901234', 'Benzema', 'Karim', 'Marocaine', '0612345687', 'C', null);
INSERT INTO Cars (Matricule, Marque, model, type,  Observation)
		VALUES ('AA-123-BB1', 'Peugeot', '208', 'Compact',  null),
		('BB-456-CC', 'Renault', 'Clio', 'Luxe', 'Low mileage'),
		('CC-789-DD', 'Volkswagen', 'Golf', 'Suv',  null),
		('DD-234-EE', 'Ford', 'Fiesta', 'Automatic', 'Small car'),
		('EE-567-FF', 'Audi', 'A4', 'Sedev',  'Luxury car'),
		('FF-890-GG', 'Toyota', 'Yaris', 'Basique',  null),
		('GG-123-HH', 'BMW', 'Series 3', 'Basique',  null),
		('HH-456-II', 'Opel', 'Corsa', 'Automatic',  'Recent car'),
		('II-789-JJ', 'Mercedes', 'Class A', 'Suv', null),
		('JJ-234-KK', 'Fiat', '500', 'Suv', null);
update Admin set MotPass = "$2y$10$p2FFrvVOL08KJWimksTikeaGs8FWtx3PE2jUA0e4WMNNiy0dDiDBO"; -- recuperer from C_Login.php : echo password_hash("Votre password",PASSWORD_DEFAULT)



delimiter $
create procedure SP_GetType(dtd date,dtf date)
begin
	select distinct Type from cars where Matricule not in (select matricule from reservation 
    where  (datedebut <= dtd AND datefin >= dtd)
        OR (datedebut <= dtf AND datefin >= dtf)
        OR (datedebut >= dtd AND datefin <= dtf));

end$
delimiter ;


delimiter $
create procedure SP_GetMarqueByType(tp varchar(50),dtd date,dtf date)
begin
	select distinct Marque from cars where Matricule not in (select matricule from reservation where 
        (datedebut <= dtd AND datefin >= dtd)
        OR (datedebut <= dtf AND datefin >= dtf)
        OR (datedebut >= dtd AND datefin <= dtf)
    )
	and Type = tp;
end$
delimiter ;

insert into Client VALUES ('VIDE', 'VIDE', 'VIDE', 'VIDE', 'VIDE', 'VIDE', null);



delimiter $
Create procedure SP_GetInformationPDFbyReservation(IdReservation int)
begin
    select c.*,ca.*,r.* from 
    client c inner join Reservation r using(cin)
    inner join cars ca using(matricule)
    where r.id = IdReservation;
end$
delimiter ;
    INSERT INTO Client (Cin, Nom, Prenom, Nationalite, Telephone, Permis)
VALUES ('AB1234567', 'Badi', 'Oussama', 'Maroccain', '555-1234', '654321'),
       ('CD9876541', 'Boumbien', 'Mohamed', 'Maroccain', '555-5678', '654321'),
       ('CD9876542', 'daoudi', 'bilal', 'Maroccain', '555-5678', '654321'),
       ('CD9876543', 'oukkea', 'Outhman', 'Maroccain', '555-5678', '654321'),
       ('CD9876544', 'Bentahra', 'Mohamed', 'Maroccain', '555-5678', '654321'),
       ('CD9876545', 'Ouelhadj', 'Omar', 'Maroccain', '555-5678', '654321'),
       ('CD9876546', 'Elbakal', 'amin', 'Maroccain', '555-5678', '654321'),
       ('CD9876547', 'Elfarfachi', 'Mohamed', 'Maroccain', '555-5678', '654321'),
       ('CD9876548', 'jentafi', 'Jane', 'Maroccain', '555-5678', '654321'),
       ('EF2345678', 'Kim', 'Sun', 'Maroccain', '555-9012', '654321');
INSERT INTO Cars (Matricule, Marque, model, type)
VALUES ('ABC123', 'Toyota', 'Corolla', 'Sedan'),
       ('DEF456', 'Honda', 'Civic', 'Hatchback'),
       ('GHI789', 'Ford', 'Mustang', 'Coupe'),
       ('JKL012', 'BMW', 'X5', 'SUV'),
       ('MNO345', 'Mercedes-Benz', 'C-Class', 'Sedan'),
       ('PQR678', 'Audi', 'A3', 'Hatchback'),
       ('STU901', 'Tesla', 'Model S', 'Sedan');
       INSERT INTO Reservation (Cin, Matricule, DateDebut, DateFin, prix)
VALUES ('AB1234567', 'ABC123', '2023-04-01', '2023-04-05', 100.0),
       ('CD9876543', 'DEF456', '2023-04-05', '2023-04-10', 80.0),
       ('EF2345678', 'GHI789', '2023-04-10', '2023-04-15', 120.0),
       ('AB1234567', 'JKL012', '2023-04-15', '2023-04-20', 150.0),
       ('CD9876543', 'MNO345', '2023-04-20', '2023-04-25', 90.0),
       ('EF2345678', 'PQR678', '2023-04-25', '2023-04-30', 110.0),
       ('AB1234567', 'STU901', '2023-04-30', '2023-05-05', 200.0);
       INSERT INTO Reservation (Cin, Matricule, DateDebut, DateFin, prix)
VALUES ('AB1234567', 'ABC123', '2023-02-01', '2023-03-05', 100.0);
-- delete from Reservation where 1 =1 ;
-- delete from Client where 1 =1 ;
-- delete from Cars where 1 =1 ;
-- call SP_GetInformationPDFbyReservation(1);





