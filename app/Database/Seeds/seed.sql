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