-- Creator: Herzig Melvyn.
-- Version: 15.05.2018.
-- Environment: Created for MySQL.
-- Script made to: Insert unreal datas into Trip Planner database.

USE `Trip_Planner`;

-- ---------------------------
-- Inserting datas
-- ---------------------------

-- USERS
INSERT INTO User (Nickname, Email, Password)
VALUES("User1","user1@hotmail.fr","$2y$10$lMiV0qYJK22vy0zXdrZmBusxMkQDsFzhLFIAUdOZSGL7Oc1bwK9o."),
("User2","user2@hotmail.fr","$2y$10$sV4ctPGVomLl/PQAtWi0o.MbA2G/qOQiMnDHrfUgBeeDa6EX9bgJC"),
("User3","user3@hotmail.fr","$2y$10$28gZJstogtaxMFdrbrIjrekSnYwcXrwd3zmnYN4hynvqKo.GT8Hc2");

-- TRIPS

insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (1, 'ultrices posuere ', 'Esperantina', false, "$2y$10$UEE5axVx195swniiti84z.BihzLzEUlUUsCcAzaRnqaWY44beWjSW", true);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (2, 'mauris sit amet eros ', 'Tizgane', false, "$2y$10$RXamuH6ZWoFua75O5NZsMuSJO8u8a2dqGFqug9gIft9R01hVDaYJO", false);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (3, 'facilisi cras ', 'Kopidlno', true, null, false);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (1, 'sociis natoque penatibus et', 'Rybatskoye', true, null, true);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (1, 'volutpat eleifend donec ut dolor ', 'Castanheira do Campo', true, null, false);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (1, 'nulla ultrices aliquet maecenas', 'Antagan Segunda', true, null, true);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (1, 'posuere felis sed', 'Danja', true, null, true);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (1, 'pellentesque ultrices', 'Jombang', true, null, false);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (3, 'amet nulla quisque', 'Tonshayevo', true, null, true);
insert into Trip (fkUser_Organizer, Title, Destination, Private, Password, Image) values (3, 'pulvinar loborti', 'Otradnaya', true, null, false);

-- TRANSPORTS

insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (1, 1, 'Sangallaya', 'Ciudad Ojeda', '15:41', '19:45', '09/03/2018', '25/11/2017', 1, 'Cross-group intangible application', '174-333-5583', 'aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula', true);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (2, 2, 'Vårby', 'Raffingora', '0:07', '18:44', '07/06/2017', '19/10/2017', 2, 'Diverse reciprocal superstructure', '964-719-4418', 'in congue etiam justo etiam pretium iaculis justo in hac', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (1, 3, 'Luhe', 'Houping', '0:43', '18:49', '17/03/2018', '14/10/2017', 3, 'Persevering tertiary matrices', '898-154-8227', 'nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla quisque arcu', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (1, 4, 'Palenggihan', 'Ma Đa Gui', '16:09', '3:14', '26/08/2017', '24/11/2017', 4, 'Front-line disintermediate migration', '180-136-3390', 'non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (2, 5, 'Palmeira', 'Leiwang', '6:22', '20:52', '08/11/2017', '21/05/2017', 5, 'Mandatory non-volatile software', '438-508-7453', 'tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (2, 6, 'Huaqiu', 'Oslo', '5:06', '20:04', '19/11/2017', '15/04/2018', 6, 'Pre-emptive responsive success', '277-328-1057', 'ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (2, 7, 'Hokor', 'Clarin', '15:33', '22:28', '26/08/2017', '09/06/2017', 7, 'Optional holistic core', '226-478-5446', 'etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (3, 8, 'Jämsänkoski', 'Barrie', '14:53', '16:50', '15/03/2018', '03/01/2018', 8, 'De-engineered fresh-thinking portal', '102-751-0497', 'auctor sed tristique in tempus sit amet sem fusce consequat', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (3, 9, 'Musina', 'Leyuan', '13:09', '13:07', '05/02/2018', '29/01/2018', 9, 'Quality-focused intangible toolset', '201-998-9848', 'pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (2, 9, 'Caja', 'Ten’gushevo', '4:42', '9:47', '25/09/2017', '05/03/2018', 10, 'Reverse-engineered dynamic encryption', '478-982-0478', 'lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (2, 1, 'Vizal San Pablo', 'Biyang', '11:51', '12:40', '27/06/2017', '09/02/2018', 11, 'Multi-lateral composite secured line', '332-642-6318', 'vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit amet',false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (1, 2, 'Kuala Lumpur', 'Morinville', '2:20', '23:42', '19/02/2018', '29/01/2018', 12, 'Distributed uniform time-frame', '181-819-8857', 'risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (1, 3, 'Tianning', 'Cigadog Hilir', '4:59', '12:17', '27/04/2018', '26/05/2017', 13, 'Expanded explicit secured line', '382-876-3897', 'nibh fusce lacus purus aliquet at feugiat non pretium quis lectus', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (1, 4, 'Luti', 'Rennes', '20:19', '22:03', '22/05/2018', '29/07/2017', 14, 'Networked responsive Graphical User Interface', '639-679-8983', 'quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (4, 5, 'Kvasy', 'Krajan Siki', '18:53', '5:23', '02/05/2018', '29/01/2018', 15, 'Re-contextualized non-volatile architecture', '784-256-8264', 'odio cras mi pede malesuada in imperdiet et commodo vulputate justo', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (5, 6, 'Bauchi', 'Izyum', '6:42', '18:16', '18/05/2017', '17/05/2017', 16, 'Managed systematic pricing structure', '471-760-4596', 'hac habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (3, 7, 'Fengxian', 'Antony', '4:17', '0:04', '01/12/2017', '08/07/2017', 17, 'Multi-lateral transitional circuit', '482-506-3602', 'in consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (3, 8, 'Panbang', 'Preserje pri Radomljah', '13:46', '10:59', '08/04/2018', '15/06/2017', 18, 'Triple-buffered analyzing hierarchy', '385-224-6278', 'integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci',false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (4, 9, 'Svenljunga', 'Lincheng', '8:58', '6:45', '17/10/2017', '09/03/2018', 19, 'Organic bottom-line matrix', '697-472-7561', 'erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus', false);
insert into Transport (fkTrip, fkTransport_Type, Place_Start, Place_End, Time_start, Time_End, Day_Start, Day_End, Price, Link, Code, Note, Image) values (6, 7, 'Gabú', 'Bol’shoye Skuratovo', '10:11', '15:48', '11/12/2017', '27/07/2017', 20, 'Grass-roots bifurcated initiative', '820-532-1173', 'neque duis bibendum morbi non quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh', false);

-- LODGING

insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (1, 1, '13 Artisan Drive', '01/09/2017', '29/09/2017', 575.56, '916-691-5293', 'consequat lectus in est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla', 'imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi', true);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (2, 2, '41557 North Street', '13/03/2018', '13/01/2018', 171.82, '971-377-1930', 'suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit', 'orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (3, 3, '8 Northland Center', '25/01/2018', '24/06/2017', 886.41, '547-484-7845', 'nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci', 'ultrices mattis odio donec vitae nisi nam ultrices libero non mattis', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (4, 1, '24721 Moulton Place', '30/05/2017', '31/07/2017', 999.26, '866-557-6053', 'proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque', 'maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (5, 2, '6 Glacier Hill Park', '26/08/2017', '18/07/2017', 203.17, '732-156-6918', 'vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros', 'integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (1, 3, '1411 Haas Point', '17/06/2017', '16/08/2017', 799.45, '670-166-6059', 'dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent', 'in leo maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (2, 3, '56230 Wayridge Center', '25/12/2017', '06/01/2018', 369.43, '172-765-4331', 'pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut', 'ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (3, 1, '9 Messerschmidt Way', '29/11/2017', '08/03/2018', 96.95, '912-806-1784', 'libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis', 'quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (4, 2, '533 Coleman Road', '15/04/2018', '28/05/2017', 649.95, '284-979-6196', 'ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl', 'justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (5, 3, '538 Gateway Plaza', '07/09/2017', '05/11/2017', 872.02, '709-514-2933', 'etiam justo etiam pretium iaculis justo in hac habitasse platea', 'luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (1, 1, '434 Gulseth Lane', '22/04/2018', '05/05/2018', 408.49, '707-779-6087', 'nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices', 'neque aenean auctor gravida sem praesent id massa id nisl venenatis', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (2, 2, '24 Graedel Pass', '12/08/2017', '23/06/2017', 344.83, '817-388-3150', 'aliquet at feugiat non pretium quis lectus suspendisse potenti in', 'est congue elementum in hac habitasse platea dictumst morbi vestibulum', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (3, 3, '0 Center Lane', '18/08/2017', '28/11/2017', 787.49, '336-563-1650', 'turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel', 'pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (4, 4, '41386 Grayhawk Road', '10/01/2018', '14/08/2017', 506.71, '410-534-2902', 'non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia', 'ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (5, 5, '4717 Garrison Place', '16/11/2017', '17/06/2017', 535.88, '389-699-7712', 'platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem', 'ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (1, 6, '54 Texas Place', '30/04/2018', '20/03/2018', 177.8, '889-921-6578', 'integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor', 'dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis odio', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (2, 7, '93 Delaware Alley', '28/08/2017', '04/06/2017', 526.42, '685-366-4523', 'pede posuere nonummy integer non velit donec diam neque vestibulum eget', 'in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (3, 8, '330 Ridgeview Street', '04/06/2017', '18/07/2017', 945.3, '241-454-9713', 'nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros', 'consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (4, 9, '071 Hollow Ridge Point', '15/05/2017', '17/08/2017', 137.52, '721-881-9730', 'hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum', 'nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi', false);
insert into Lodging (fkLodging_Type, fkTrip, Address, Day_Start, Day_End, Price, Code, Link, Note, Image) values (5, 10, '3451 Anzinger Terrace', '11/10/2017', '22/02/2018', 186.33, '163-301-0179', 'gravida nisi at nibh in hac habitasse platea dictumst aliquam', 'vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris', false);

-- ACTIVITIES

insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (1, 'ut massa volutpat convallis morbi', 471.5, 'in eleifend quam a odio in hac habitasse platea dictumst', 'mauris vulputate elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy', true);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (1, 'etiam faucibus cursus urna ut tellus', 666.67, 'volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in', 'habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (2, 'nibh in lectus pellentesque at nulla', 731.2, 'in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis', 'nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (3, 'eget vulputate ut ultrices vel', 328.7, 'tortor quis turpis sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget massa tempor', 'diam erat fermentum justo nec condimentum neque sapien placerat ante nulla', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (1, 'orci mauris lacinia sapien quis libero', 951.08, 'sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum', 'blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (2, 'non sodales sed tincidunt eu felis', 49.04, 'ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam', 'libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (3, 'integer a nibh in quis justo', 775.65, 'habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum', 'convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (1, 'vulputate justo in blandit ultrices enim', 206.3, 'sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac', 'mauris eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (2, 'tristique in tempus sit amet', 204.0, 'donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia', 'curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (3, 'sit amet lobortis sapien sapien non', 512.05, 'a libero nam dui proin leo odio porttitor id consequat in consequat ut', 'sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor duis mattis', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (1, 'vitae mattis nibh ligula nec', 710.14, 'lorem id ligula suspendisse ornare consequat lectus in est risus auctor', 'in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (2, 'semper porta volutpat quam pede', 487.14, 'at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna', 'sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam nam tristique', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (3, 'ornare consequat lectus in est risus', 981.21, 'mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a', 'odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (4, 'odio in hac habitasse platea dictumst', 687.58, 'nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo', 'sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (5, 'aenean lectus pellentesque eget nunc donec', 451.47, 'nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque', 'orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (6, 'posuere metus vitae ipsum aliquam', 293.99, 'convallis nunc proin at turpis a pede posuere nonummy integer non velit', 'libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (7, 'ut dolor morbi vel lectus', 541.47, 'sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices', 'lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (8, 'sit amet consectetuer adipiscing elit', 99.84, 'ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in', 'eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (9, 'convallis nulla neque libero convallis', 957.9, 'integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien', 'ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin', false);
insert into Activity (fkTrip, Description, Price, Link, Note, Image) values (10, 'dignissim vestibulum vestibulum ante ipsum primis', 694.88, 'mattis egestas metus aenean fermentum donec ut mauris eget massa tempor', 'tempus semper est quam pharetra magna ac consequat metus sapien', false);


-- ITEMS

insert into Item (fkTrip, Name, Quantity, Ready) values (1, 'mi integer', 1, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (2, 'proin at turpis a', 2, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (3, 'rutrum at lorem', 3, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (4, 'posuere cubilia curae', 4, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (5, 'consequat', 5, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (6, 'sollicitudin mi', 6, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (7, 'justo sollicitudin ut', 7, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (8, 'risus praesent', 8, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (9, 'justo', 9, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (10, 'condimentum', 10, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (1, 'duis', 11, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (2, 'faucibus', 12, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (3, 'ante ipsum primis', 13, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (4, 'in', 14, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (5, 'velit', 15, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (6, 'nibh in', 16, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (7, 'duis', 17, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (8, 'risus', 18, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (9, 'luctus', 19, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (10, 'donec quis orci', 20, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (1, 'in tempor turpis', 21, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (2, 'erat', 22, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (3, 'ac', 23, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (4, 'sagittis dui vel nisl duis', 24, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (5, 'sit amet', 25, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (6, 'felis sed interdum venenatis turpis', 26, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (7, 'at', 27, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (8, 'ultrices posuere cubilia', 28, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (9, 'cursus', 29, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (10, 'eget', 30, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (1, 'commodo vulputate justo in', 31, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (2, 'at lorem integer tincidunt ante', 32, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (3, 'et ultrices posuere cubilia', 33, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (4, 'vitae quam suspendisse', 34, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (5, 'blandit', 35, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (6, 'molestie', 36, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (7, 'in tempus sit amet sem', 37, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (8, 'sed justo', 38, true);
insert into Item (fkTrip, Name, Quantity, Ready) values (9, 'dictumst etiam faucibus cursus', 39, false);
insert into Item (fkTrip, Name, Quantity, Ready) values (10, 'augue aliquam erat', 40, true);

-- Participants

insert into Participant(fkTrip,fkUser,Waiting) values (1,2,0);
insert into Participant(fkTrip,fkUser,Waiting) values (1,3,1);
insert into Participant(fkTrip,fkUser,Waiting) values (2,1,0);
insert into Participant(fkTrip,fkUser,Waiting) values (2,3,1);
insert into Participant(fkTrip,fkUser,Waiting) values (3,2,0);
insert into Participant(fkTrip,fkUser,Waiting) values (3,1,1);