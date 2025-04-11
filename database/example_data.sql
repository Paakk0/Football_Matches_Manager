INSERT INTO USERS (Name,Email,Password,Registration_Date,Role) VALUES(
    'Admin', 'email1@example.com', '$2y$10$sf1ZY7HgxRAdxJcpeuSaQuwPtAl5H4roOXnQ2coJVnH1e/3C2V222', '2025-03-8',1
);

INSERT INTO Leagues (Name) VALUES 
('League1'),
('League2'),
('League3'),
('League4'),
('League5');

INSERT INTO Teams (Id_League, Name, Country, Formation, Wins, Losses, Draws) VALUES 
(1, 'Manchester United', 'England', '4-3-3', 20, 5, 3),
(1, 'Liverpool', 'England', '4-3-3', 18, 6, 4),
(1, 'Chelsea', 'England', '3-4-3', 17, 7, 4),
(1, 'Arsenal', 'England', '4-2-3-1', 19, 5, 4),
(2, 'Real Madrid', 'Spain', '4-3-3', 22, 3, 3),
(2, 'Barcelona', 'Spain', '4-3-3', 19, 4, 5),
(2, 'Atletico Madrid', 'Spain', '4-4-2', 18, 6, 4),
(2, 'Sevilla', 'Spain', '4-3-3', 17, 7, 4),
(3, 'Juventus', 'Italy', '3-5-2', 17, 7, 4),
(3, 'Inter Milan', 'Italy', '3-5-2', 18, 6, 4),
(3, 'AC Milan', 'Italy', '4-2-3-1', 19, 5, 4),
(3, 'Napoli', 'Italy', '4-3-3', 20, 4, 4),
(4, 'Bayern Munich', 'Germany', '4-2-3-1', 21, 4, 3),
(4, 'Borussia Dortmund', 'Germany', '4-3-3', 19, 5, 4),
(4, 'RB Leipzig', 'Germany', '3-4-3', 18, 6, 4),
(4, 'Bayer Leverkusen', 'Germany', '4-2-3-1', 17, 7, 4),
(5, 'PSG', 'France', '4-3-3', 23, 2, 3),
(5, 'Lyon', 'France', '4-3-3', 18, 6, 4),
(5, 'Marseille', 'France', '4-2-3-1', 19, 5, 4),
(5, 'Monaco', 'France', '4-4-2', 17, 7, 4);

-- Manchester United (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(1, 'Goal_Keeper1', 'Goalkeeper'),
(1, 'Defender1', 'Defender'),
(1, 'Defender2', 'Defender'),
(1, 'Defender3', 'Defender'),
(1, 'Defender4', 'Defender'),
(1, 'Midfielder1', 'Midfielder'),
(1, 'Midfielder2', 'Midfielder'),
(1, 'Midfielder3', 'Midfielder'),
(1, 'Forward1', 'Forward'),
(1, 'Forward2', 'Forward'),
(1, 'Forward3', 'Forward');

-- Liverpool (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(2, 'Goal_Keeper1', 'Goalkeeper'),
(2, 'Defender1', 'Defender'),
(2, 'Defender2', 'Defender'),
(2, 'Defender3', 'Defender'),
(2, 'Defender4', 'Defender'),
(2, 'Midfielder1', 'Midfielder'),
(2, 'Midfielder2', 'Midfielder'),
(2, 'Midfielder3', 'Midfielder'),
(2, 'Forward1', 'Forward'),
(2, 'Forward2', 'Forward'),
(2, 'Forward3', 'Forward');

-- Chelsea (3-4-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(3, 'Goal_Keeper1', 'Goalkeeper'),
(3, 'Defender1', 'Defender'),
(3, 'Defender2', 'Defender'),
(3, 'Defender3', 'Defender'),
(3, 'Midfielder1', 'Midfielder'),
(3, 'Midfielder2', 'Midfielder'),
(3, 'Midfielder3', 'Midfielder'),
(3, 'Midfielder4', 'Midfielder'),
(3, 'Forward1', 'Forward'),
(3, 'Forward2', 'Forward'),
(3, 'Forward3', 'Forward');

-- Arsenal (4-2-3-1 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(4, 'Goal_Keeper1', 'Goalkeeper'),
(4, 'Defender1', 'Defender'),
(4, 'Defender2', 'Defender'),
(4, 'Defender3', 'Defender'),
(4, 'Defender4', 'Defender'),
(4, 'Midfielder1', 'Midfielder'),
(4, 'Midfielder2', 'Midfielder'),
(4, 'Midfielder3', 'Midfielder'),
(4, 'Midfielder4', 'Midfielder'),
(4, 'Midfielder5', 'Midfielder'),
(4, 'Forward1', 'Forward');

-- Real Madrid (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(5, 'Goal_Keeper1', 'Goalkeeper'),
(5, 'Defender1', 'Defender'),
(5, 'Defender2', 'Defender'),
(5, 'Defender3', 'Defender'),
(5, 'Defender4', 'Defender'),
(5, 'Midfielder1', 'Midfielder'),
(5, 'Midfielder2', 'Midfielder'),
(5, 'Midfielder3', 'Midfielder'),
(5, 'Forward1', 'Forward'),
(5, 'Forward2', 'Forward'),
(5, 'Forward3', 'Forward');

-- Barcelona (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(6, 'Goal_Keeper1', 'Goalkeeper'),
(6, 'Defender1', 'Defender'),
(6, 'Defender2', 'Defender'),
(6, 'Defender3', 'Defender'),
(6, 'Defender4', 'Defender'),
(6, 'Midfielder1', 'Midfielder'),
(6, 'Midfielder2', 'Midfielder'),
(6, 'Midfielder3', 'Midfielder'),
(6, 'Forward1', 'Forward'),
(6, 'Forward2', 'Forward'),
(6, 'Forward3', 'Forward');

-- Atletico Madrid (4-4-2 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(7, 'Goal_Keeper1', 'Goalkeeper'),
(7, 'Defender1', 'Defender'),
(7, 'Defender2', 'Defender'),
(7, 'Defender3', 'Defender'),
(7, 'Defender4', 'Defender'),
(7, 'Midfielder1', 'Midfielder'),
(7, 'Midfielder2', 'Midfielder'),
(7, 'Midfielder3', 'Midfielder'),
(7, 'Midfielder4', 'Midfielder'),
(7, 'Forward1', 'Forward'),
(7, 'Forward2', 'Forward');

-- Sevilla (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(8, 'Goal_Keeper1', 'Goalkeeper'),
(8, 'Defender1', 'Defender'),
(8, 'Defender2', 'Defender'),
(8, 'Defender3', 'Defender'),
(8, 'Defender4', 'Defender'),
(8, 'Midfielder1', 'Midfielder'),
(8, 'Midfielder2', 'Midfielder'),
(8, 'Midfielder3', 'Midfielder'),
(8, 'Forward1', 'Forward'),
(8, 'Forward2', 'Forward'),
(8, 'Forward3', 'Forward');

-- Juventus (3-5-2 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(9, 'Goal_Keeper1', 'Goalkeeper'),
(9, 'Defender1', 'Defender'),
(9, 'Defender2', 'Defender'),
(9, 'Defender3', 'Defender'),
(9, 'Midfielder1', 'Midfielder'),
(9, 'Midfielder2', 'Midfielder'),
(9, 'Midfielder3', 'Midfielder'),
(9, 'Midfielder4', 'Midfielder'),
(9, 'Midfielder5', 'Midfielder'),
(9, 'Forward1', 'Forward'),
(9, 'Forward2', 'Forward');

-- Inter Milan (3-5-2 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(10, 'Goal_Keeper1', 'Goalkeeper'),
(10, 'Defender1', 'Defender'),
(10, 'Defender2', 'Defender'),
(10, 'Defender3', 'Defender'),
(10, 'Midfielder1', 'Midfielder'),
(10, 'Midfielder2', 'Midfielder'),
(10, 'Midfielder3', 'Midfielder'),
(10, 'Midfielder4', 'Midfielder'),
(10, 'Midfielder5', 'Midfielder'),
(10, 'Forward1', 'Forward'),
(10, 'Forward2', 'Forward');

-- AC Milan (4-2-3-1 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(11, 'Goal_Keeper1', 'Goalkeeper'),
(11, 'Defender1', 'Defender'),
(11, 'Defender2', 'Defender'),
(11, 'Defender3', 'Defender'),
(11, 'Defender4', 'Defender'),
(11, 'Midfielder1', 'Midfielder'),
(11, 'Midfielder2', 'Midfielder'),
(11, 'Midfielder3', 'Midfielder'),
(11, 'Midfielder4', 'Midfielder'),
(11, 'Midfielder5', 'Midfielder'),
(11, 'Forward1', 'Forward');

-- Napoli (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(12, 'Goal_Keeper1', 'Goalkeeper'),
(12, 'Defender1', 'Defender'),
(12, 'Defender2', 'Defender'),
(12, 'Defender3', 'Defender'),
(12, 'Defender4', 'Defender'),
(12, 'Midfielder1', 'Midfielder'),
(12, 'Midfielder2', 'Midfielder'),
(12, 'Midfielder3', 'Midfielder'),
(12, 'Forward1', 'Forward'),
(12, 'Forward2', 'Forward'),
(12, 'Forward3', 'Forward');

-- Bayern Munich (4-2-3-1 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(13, 'Goal_Keeper1', 'Goalkeeper'),
(13, 'Defender1', 'Defender'),
(13, 'Defender2', 'Defender'),
(13, 'Defender3', 'Defender'),
(13, 'Defender4', 'Defender'),
(13, 'Midfielder1', 'Midfielder'),
(13, 'Midfielder2', 'Midfielder'),
(13, 'Midfielder3', 'Midfielder'),
(13, 'Midfielder4', 'Midfielder'),
(13, 'Midfielder5', 'Midfielder'),
(13, 'Forward1', 'Forward');

-- Borussia Dortmund (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(14, 'Goal_Keeper1', 'Goalkeeper'),
(14, 'Defender1', 'Defender'),
(14, 'Defender2', 'Defender'),
(14, 'Defender3', 'Defender'),
(14, 'Defender4', 'Defender'),
(14, 'Midfielder1', 'Midfielder'),
(14, 'Midfielder2', 'Midfielder'),
(14, 'Midfielder3', 'Midfielder'),
(14, 'Forward1', 'Forward'),
(14, 'Forward2', 'Forward'),
(14, 'Forward3', 'Forward');

-- Bayer Leverkusen (4-2-3-1 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(15, 'Goal_Keeper1', 'Goalkeeper'),
(15, 'Defender1', 'Defender'),
(15, 'Defender2', 'Defender'),
(15, 'Defender3', 'Defender'),
(15, 'Defender4', 'Defender'),
(15, 'Midfielder1', 'Midfielder'),
(15, 'Midfielder2', 'Midfielder'),
(15, 'Midfielder3', 'Midfielder'),
(15, 'Midfielder4', 'Midfielder'),
(15, 'Midfielder5', 'Midfielder'),
(15, 'Forward1', 'Forward');

-- Lyon (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(16, 'Goal_Keeper1', 'Goalkeeper'),
(16, 'Defender1', 'Defender'),
(16, 'Defender2', 'Defender'),
(16, 'Defender3', 'Defender'),
(16, 'Defender4', 'Defender'),
(16, 'Midfielder1', 'Midfielder'),
(16, 'Midfielder2', 'Midfielder'),
(16, 'Midfielder3', 'Midfielder'),
(16, 'Forward1', 'Forward'),
(16, 'Forward2', 'Forward'),
(16, 'Forward3', 'Forward');

-- AS Roma (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(17, 'Goal_Keeper1', 'Goalkeeper'),
(17, 'Defender1', 'Defender'),
(17, 'Defender2', 'Defender'),
(17, 'Defender3', 'Defender'),
(17, 'Defender4', 'Defender'),
(17, 'Midfielder1', 'Midfielder'),
(17, 'Midfielder2', 'Midfielder'),
(17, 'Midfielder3', 'Midfielder'),
(17, 'Forward1', 'Forward'),
(17, 'Forward2', 'Forward'),
(17, 'Forward3', 'Forward');

-- Roma (4-4-2 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(18, 'Goal_Keeper1', 'Goalkeeper'),
(18, 'Defender1', 'Defender'),
(18, 'Defender2', 'Defender'),
(18, 'Defender3', 'Defender'),
(18, 'Defender4', 'Defender'),
(18, 'Midfielder1', 'Midfielder'),
(18, 'Midfielder2', 'Midfielder'),
(18, 'Midfielder3', 'Midfielder'),
(18, 'Midfielder4', 'Midfielder'),
(18, 'Forward1', 'Forward'),
(18, 'Forward2', 'Forward');

-- Valencia (4-4-2 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(19, 'Goal_Keeper1', 'Goalkeeper'),
(19, 'Defender1', 'Defender'),
(19, 'Defender2', 'Defender'),
(19, 'Defender3', 'Defender'),
(19, 'Defender4', 'Defender'),
(19, 'Midfielder1', 'Midfielder'),
(19, 'Midfielder2', 'Midfielder'),
(19, 'Midfielder3', 'Midfielder'),
(19, 'Midfielder4', 'Midfielder'),
(19, 'Forward1', 'Forward'),
(19, 'Forward2', 'Forward');

-- PSV Eindhoven (4-3-3 Formation)
INSERT INTO Player (Id_Team, Name, Position) VALUES 
(20, 'Goal_Keeper1', 'Goalkeeper'),
(20, 'Defender1', 'Defender'),
(20, 'Defender2', 'Defender'),
(20, 'Defender3', 'Defender'),
(20, 'Defender4', 'Defender'),
(20, 'Midfielder1', 'Midfielder'),
(20, 'Midfielder2', 'Midfielder'),
(20, 'Midfielder3', 'Midfielder'),
(20, 'Forward1', 'Forward'),
(20, 'Forward2', 'Forward'),
(20, 'Forward3', 'Forward');


INSERT INTO Matches (Id_Team1, Id_Team2, Date) VALUES 
(1, 2, '2025-03-10'), (3, 4, '2025-03-11'), (5, 6, '2025-03-12'), (7, 1, '2025-03-13'),
(2, 3, '2025-03-14'), (4, 5, '2025-03-15'), (6, 7, '2025-03-16'), (1, 3, '2025-03-17'), (2, 5, '2025-03-18'),
(4, 6, '2025-03-19'), (7, 2, '2025-03-20'), (3, 5, '2025-03-21'), (1, 6, '2025-03-22'), (2, 4, '2025-03-23'),
(5, 7, '2025-03-24'), (1, 4, '2025-03-25'), (2, 6, '2025-03-26'), (3, 7, '2025-03-27'), (1, 5, '2025-03-28'),
(2, 7, '2025-03-29'), (3, 6, '2025-03-30'), (4, 7, '2025-03-31'), (1, 7, '2025-04-01'), (2, 1, '2025-04-02');

INSERT INTO Stats (Id_Match, Id_PlayerMVP, Ball_Control_Team1) VALUES 
(1, 1, 55), (2, 3, 60), (3, 5, 50), (4, 7, 48), (5, 9, 62), (6, 11, 58), (7, 13, 51), (8, 2, 57), (9, 4, 59), (10, 6, 53), 
(11, 8, 61), (12, 10, 54), (13, 12, 56), (14, 14, 60), (15, 16, 55), (16, 18, 60), (17, 20, 50), (18, 22, 48), (19, 24, 62), 
(20, 26, 58), (21, 28, 51), (22, 30, 57), (23, 32, 59), (24, 34, 53);

INSERT INTO Goals (Id_Stat, Id_Player, Minute) VALUES 
(1, 2, 30), (2, 4, 15), (3, 6, 45), (4, 8, 60), (5, 10, 20), (6, 12, 10), (7, 14, 5), (8, 16, 25), (9, 18, 35), (10, 20, 50), 
(11, 22, 40), (12, 24, 55), (13, 26, 65), (14, 28, 70), (15, 30, 75), (16, 32, 80), (17, 34, 85), (18, 36, 90), (19, 38, 95), 
(20, 40, 100), (21, 42, 105), (22, 44, 110), (23, 46, 115), (24, 48, 120);

INSERT INTO Cartons (Id_Player, Id_Stat, Carton, Minute) VALUES 
(2, 1, 1, 45), (4, 2, 2, 30), (6, 3, 1, 20), (8, 4, 1, 50), (10, 5, 2, 35), (12, 6, 1, 15), (14, 7, 2, 10), (16, 8, 1, 25), 
(18, 9, 2, 40), (20, 10, 1, 55), (22, 11, 2, 60), (24, 12, 1, 65), (26, 13, 2, 70), (28, 14, 1, 75), (30, 15, 2, 80), 
(32, 16, 1, 85), (34, 17, 2, 90), (36, 18, 1, 95), (38, 19, 2, 100), (40, 20, 1, 105), (42, 21, 2, 110), (44, 22, 1, 115), 
(46, 23, 2, 120), (48, 24, 1, 125);
