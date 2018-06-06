-- Creator: Herzig Melvyn.
-- Version: 15.05.2018.
-- Environment: Created for MySQL.
-- Script made to: Insert unreal datas into Trip Planner database.

USE `tripplanne_db`;

-- ---------------------------
-- Inserting datas
-- ---------------------------

-- USER
INSERT INTO `User` (`idUser`, `Nickname`, `Email`, `Password`) VALUES
(1, 'Bob', 'bob@tripplanner.ch', '$2y$10$rsKCRNb4r/Kziur30bTdtO1X./GhqfsuaJtN6XWn.cIVG1sBEE8eG'),
(2, 'Anna', 'anna@tripplanner.ch', '$2y$10$hu7DcPMeaq25v1Z2kkzaVOXvg7zhCec4iQr9cakDnVBCbDXkM/lmu'),
(3, 'Alice', 'alice@tripplanner.ch', '$2y$10$rHCx3xaOOl0H/KUWJY1bweAJdSkDFu3w9gEgtQjwn9rSs2jmDqodW'),
(4, 'John', 'john@tripplanner.ch', '$2y$10$CpNqdkyVvKzouqb1UxphSuZoS4HgiR.Z3/MPnBijR/bopd60aDBD.');

-- TRIP
INSERT INTO `Trip` (`idTrip`, `fkUser_Organizer`, `Title`, `Destination`, `Private`, `Password`, `Image`, `Creation`, `Date_Start`, `Date_End`) VALUES
(1, 1, 'été 2018', 'Sud de la france', 0, '$2y$10$rOlt4iEQLDt7amM2gxe.hubIgJfftOdEztlTuyRbjZZETD2pm7BG2', 1, '2018-05-15', '2018-07-12', '2018-07-26'),
(2, 1, 'Vacances au pays du caribou', 'Canada', 1, NULL, 1, '2018-05-25', '2018-12-05', '2018-12-26'),
(3, 1, 'Week-end en couple', 'Paris', 1, NULL, 1, '2018-05-13', '2018-08-25', '2018-08-26'),
(4, 1, 'Semaine de repos', 'Fiez (CH)', 1, NULL, 0, '2018-05-02', '2019-02-25', '2019-03-03'),
(5, 1, 'Voyage entre amis', 'Barcelone', 1, NULL, 0, '2018-04-11', '2019-03-14', '2019-03-17'),
(6, 1, 'été 2019', 'Honolulu', 0, '$2y$10$kfKkyAAVXGimCyF3yiS98uS5CUfQvZq4eRYE1qgPXxhHQIddaCT6C', 1, '2018-05-14', '2019-07-18', '2019-07-28'),
(7, 3, 'Voyage au maroc', 'Marrakech', 0, '$2y$10$sHpBPMl2TbDpIFINLcbfGurMvhXnaq4AYgcu1ic12znJUg3xcG646', 0, '2018-05-01', '2018-07-19', '2018-07-26'),
(8, 4, 'Automne 2018', 'Allemagne - Berlin', 0, '$2y$10$rqJ1qlefkvNTc4IFGCT/AOlbN5PuwNTJc4gOZhiGD2kGEh0MZdwwi', 1, '2018-04-11', '2018-10-19', '2018-10-23'),
(9, 4, 'Ski 2019', 'Valais-Suisse', 0, '$2y$10$heSyMjqLKwrRzI2IXrx4U.6EoSr86yOjKOhQZDTv9d26W2Ny61v/i', 0, '2018-03-20', '2019-12-13', '2019-12-20'),
(10, 2, 'voyage de noces', 'A Venise en Italie', 0, '$2y$10$XeUJ4kuYsxZ3Fx6v8oVQrePLadBAADyse9ZXe1UCkU5OS8Rlvu/zC', 0, '2018-01-22', '2018-09-11', '2018-09-18');

-- TRANSPORT

INSERT INTO `Transport` (`idTransport`, `fkTrip`, `fkTransport_Type`, `Place_Start`, `Place_End`, `Day_Start`, `Day_End`, `Time_Start`, `Time_End`, `Price`, `Link`, `Code`, `Note`, `Image`) VALUES
(1, 2, 1, 'Genève', 'Montréal', '2018-12-04', '2018-12-05', '08:00:00', '02:00:00', 1500.00, 'https://www.google.ch/', 'fly45ge-mont', 'Nous avons les bagages en soute', 1),
(2, 2, 3, 'Montréal, aéroport', 'Montréal, hôtel', '2018-12-05', '2018-12-05', '02:30:00', '03:00:00', 20.00, '', '', '', 0),
(3, 2, 8, 'Montréal', 'Calagary', '2018-12-13', '2018-12-13', '16:00:00', '22:00:00', 0.00, '', '', 'Jimmy passe nous chercher', 1),
(4, 2, 6, 'Calagary', 'Montreal', '2018-12-25', '2018-12-25', '00:00:00', '00:00:00', 80.00, '', '', '', 0),
(5, 2, 1, 'Montréal', 'Genève', '2018-12-25', '2018-12-26', '00:00:00', '00:00:00', 2000.00, '', 'fly58mont-ge', 'Un peu plus coûteux que l\'aller car c\'est de la première classe', 1),
(7, 1, 8, 'Fiez', 'Montepelier', '2018-07-11', '2018-07-11', '10:00:00', '00:00:00', 0.00, '', '', '', 0),
(8, 1, 3, 'Montpelier', 'Uzes', '2018-07-16', '2018-07-16', '14:30:00', '15:30:00', 20.00, '', '', 'Trajet pour aller au musée du bonbon', 1),
(9, 1, 10, 'Uzes', 'Montpelier', '2018-07-16', '2018-07-16', '18:30:00', '19:30:00', 20.00, 'http://www.google.ch', 'Fk2DFN', '', 1),
(10, 1, 8, 'Montpelier', 'Fiez', '2018-07-26', '2018-07-26', '00:00:00', '00:00:00', 0.00, '', '', '', 0);


-- LODGING

INSERT INTO `Lodging` (`idLodging`, `fkLodging_Type`, `fkTrip`, `Address`, `Day_Start`, `Day_End`, `Price`, `Code`, `Link`, `Note`, `Image`) VALUES
(1, 4, 2, 'Watson Street 15, Montréal', '2018-12-06', '2018-12-13', 400.00, '48wbcde44c', 'https://www.google.ch/', 'Très bon hôtel recommandé par un ami', 0),
(2, 1, 2, 'Edward av. Calagary', '2018-12-13', '2018-12-24', 0.00, '', '', 'Cet appartement appartient à mon pote Jimmy. Un grand merci à lui', 1),
(3, 4, 1, 'Place des fêtes 14', '2018-07-12', '2018-07-12', 500.00, 'wa14wzt56v', 'http://www.google.ch', '', 1),
(4, 5, 1, 'Rue du parc 08', '2018-07-18', '2018-07-18', 1000.00, 'qz74trs51BBq', '', 'Grand domaine luxueux avec piscine', 1);


-- ACTIVITY

INSERT INTO `Activity` (`idActivity`, `fkTrip`, `Description`, `Price`, `Date`, `Link`, `Note`, `Image`) VALUES
(1, 2, 'Visite d\'un musée d\'art', 50.00, '2018-12-15', 'http://www.google.ch', '', 1),
(2, 2, 'Shopping à Calagary', 0.00, '2018-12-23', '', 'Attention à ne pas trop dépenser tout de même', 0),
(3, 2, 'Soirée bowling', 60.00, '2018-12-09', '', '', 1),
(4, 2, 'Balade dans un parc', 0.00, '2018-12-18', 'http://www.google.ch', '', 0),
(5, 1, 'Visite du musée Haribo', 30.00, '2018-07-16', 'http://www.museeharibo.fr/fr/', '', 1),
(6, 1, 'Bain de soleil à la plage', 0.00, '2018-07-18', '', 'Attention il est facile de prendre des coups de soleil', 0),
(7, 1, 'Shopping', 200.00, '2018-07-25', '', 'Pas le droit de dépasser les 200 frs de budget', 0);




-- PREREQUISITE
INSERT INTO `Prerequisite` (`idPrerequisite`, `Name`, `Quantity`, `fkTrip`, `Ready`) VALUES
(1, 'Vérifier la validité des passports', 0, 2, 1),
(2, 'Vérifier la météo', 0, 2, 0),
(3, 'Prendre une grosse veste', 1, 2, 1),
(4, 'Dire au voisin de nourrir le chat', 0, 2, 1),
(5, 'Vérifier la pression des pneus', 0, 1, 1),
(6, 'Refaire le carte d\'identité', 0, 1, 0),
(7, 'Acheter crème solaire', 1, 1, 0),
(8, 'Acheter lunettes de soleil', 2, 1, 1);


-- PARTICIPANT
INSERT INTO `Participant` (`fkTrip`, `fkUser`, `Waiting`) VALUES
(1, 2, 1),
(1, 3, 0),
(1, 4, 0),
(2, 3, 0),
(6, 2, 1),
(6, 3, 1),
(6, 4, 1);

