-- Insertion des départements
INSERT INTO departments (nom, description) VALUES 
('Direction', 'Direction générale de l''entreprise'),
('Informatique', 'Développement et maintenance infrastructure');

-- Insertion des employés (Admin et Employés)
-- Note : Les mots de passe sont stockés en clair ici à titre d'exemple, 
-- mais devraient être hachés en production.
INSERT INTO employes (nom, prenom, email, passwd, role, department_id, date_embauche, actif) VALUES 
('Boucher', 'Jean', 'admin@entreprise.com', 'admin123', 'ADMIN', 1, '2024-01-01', 1),
('Durand', 'Marie', 'm.durand@entreprise.com', 'user123', 'EMPLOYE', 2, '2024-02-15', 1),
('Martin', 'Lucas', 'l.martin@entreprise.com', 'user456', 'EMPLOYE', 2, '2024-03-01', 1);

INSERT INTO types_conge (libelle, jours_annuels, deductible) VALUES 
('Congés Payés', 25, 1),
('RTT', 10, 1),
('Maladie', 0, 0); -- Pas de limite annuelle fixe généralement

-- Initialisation pour Marie Durand (ID 2)
INSERT INTO soldes (employe_id, types_conge_id, annee, jours_attribues, jours_pris) VALUES 
(2, 1, 2024, 25, 0), -- Congés Payés
(2, 2, 2024, 10, 0); -- RTT

-- Initialisation pour Lucas Martin (ID 3)
INSERT INTO soldes (employe_id, types_conge_id, annee, jours_attribues, jours_pris) VALUES 
(3, 1, 2024, 25, 0),
(3, 2, 2024, 10, 0);

-- Note: L'admin (ID 1) peut aussi avoir des soldes si nécessaire
INSERT INTO soldes (employe_id, types_conge_id, annee, jours_attribues, jours_pris) VALUES 
(1, 1, 2024, 25, 0),
(1, 2, 2024, 10, 0);

-- Insertion de données de test étalées sur différents mois
INSERT INTO conges (employe_id, types_conge_id, date_debut, date_fin, nb_jours, motif, statut, created_at) 
VALUES 
-- Janvier 2026 (2 demandes)
(1, 1, '2026-01-05 08:00:00', '2026-01-10 18:00:00', 5, 'Vacances hiver', 'Approuve', '2026-01-02 09:15:00'),
(2, 3, '2026-01-15 08:00:00', '2026-01-17 18:00:00', 2, 'Grippe saisonnière', 'Approuve', '2026-01-15 08:30:00'),

-- Février 2026 (1 demande)
(3, 2, '2026-02-20 08:00:00', '2026-02-21 18:00:00', 1, 'Repos', 'Approuve', '2026-02-18 14:00:00'),

-- Mars 2026 (3 demandes - Pic d'activité)
(1, 1, '2026-03-02 08:00:00', '2026-03-06 18:00:00', 5, 'Déménagement', 'Approuve', '2026-03-01 10:00:00'),
(4, 2, '2026-03-12 08:00:00', '2026-03-13 18:00:00', 1, 'Rendez-vous médical', 'Approuve', '2026-03-10 11:30:00'),
(2, 1, '2026-03-23 08:00:00', '2026-03-27 18:00:00', 5, 'Voyage familial', 'En attente', '2026-03-15 16:45:00'),

-- Avril 2026 (2 demandes)
(3, 1, '2026-04-13 08:00:00', '2026-04-17 18:00:00', 4, 'Semaine de Pâques', 'Approuve', '2026-04-05 09:00:00'),
(5, 3, '2026-04-22 08:00:00', '2026-04-24 18:00:00', 2, 'Consultation', 'Refuse', '2026-04-21 11:00:00'),

-- Mai 2026 (4 demandes - Mois en cours sur votre écran)
(1, 2, '2026-05-04 08:00:00', '2026-05-05 18:00:00', 1, 'Pont de mai', 'Approuve', '2026-05-01 08:00:00'),
(4, 1, '2026-05-11 08:00:00', '2026-05-15 18:00:00', 5, 'Repos requis', 'Approuve', '2026-05-07 14:20:00'),
(2, 2, '2026-05-18 08:00:00', '2026-05-19 18:00:00', 1, 'Obligation personnelle', 'En attente', '2026-05-14 10:15:00'),
(3, 1, '2026-05-25 08:00:00', '2026-05-29 18:00:00', 5, 'Vacances', 'En attente', '2026-05-20 16:00:00');
