CREATE TABLE departments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(255),
    description TEXT
);

CREATE TABLE employes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255),
    passwd VARCHAR(255),
    role VARCHAR(255),
    department_id INTEGER,
    date_embauche DATETIME,
    actif INTEGER,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

CREATE UNIQUE INDEX IF NOT EXISTS user_email_index ON employes (email);

CREATE TABLE types_conge (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle VARCHAR(255),
    jours_annuels INTEGER,
    deductible INTEGER
);

CREATE TABLE soldes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id INTEGER,
    types_conge_id INTEGER,
    annee INTEGER,
    jours_attribues INTEGER,
    jours_pris INTEGER,
    FOREIGN KEY (employe_id) REFERENCES employes(id),
    FOREIGN KEY (types_conge_id) REFERENCES types_conge(id)
);

CREATE TABLE conges (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id INTEGER,
    types_conge_id INTEGER,
    date_debut DATETIME,
    date_fin DATETIME,
    nb_jours INTEGER,
    motif TEXT,
    statut VARCHAR(255),
    commentaire_rh TEXT,
    created_at DATETIME,
    traite_par INTEGER,
    FOREIGN KEY (employe_id) REFERENCES employes(id),
    FOREIGN KEY (types_conge_id) REFERENCES types_conge(id),
    FOREIGN KEY (traite_par) REFERENCES employes(id)
);