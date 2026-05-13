<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMada RH - <?= $title ?? 'Dashboard' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    
    <!-- Votre fichier CSS principal -->
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <style>
        /* Styles spécifiques à la sidebar si vous ne les avez pas dans style.css */
        :root {
            --sidebar-bg: #1a1d21;
            --forest: #228b22;
            --pastel-violet: #dcd0ff;
        }
        /* ... vos autres styles ... */
    </style>
    
</head>
<!-- app/Views/layouts/sidebar.php -->
<body>
    <div class="app-wrap">
        <aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-logo-icon"><i class="bi bi-briefcase"></i></div>
        <div class="sidebar-brand-name">TechMada RH<span>Espace employé</span></div>
    </div>
    
    <div class="sidebar-section">Menu</div>
    
    <ul class="sidebar-nav">
        <li>
            <a href="/employe/dashboard" class="<?= ($activePage == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2"></i> Tableau de bord
            </a>
        </li>
        <li>
            <a href="/employe/new-demande" class="<?= ($activePage == 'nouvelle-demande') ? 'active' : '' ?>">
                <i class="bi bi-plus-circle"></i> Nouvelle demande
            </a>
        </li>
        <li>
            <a href="<?= base_url('conge/mes-demandes') ?>" class="<?= ($activePage == 'mes-demandes') ? 'active' : '' ?>">
                <i class="bi bi-calendar3"></i> Mes demandes
                <span class="nav-badge alert">2</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('profil') ?>" class="<?= ($activePage == 'profil') ? 'active' : '' ?>">
                <i class="bi bi-person"></i> Mon profil
            </a>
        </li>
    </ul>

    <div class="sidebar-user">
        <div class="s-user-row">
            <!-- On peut dynamiser ces données plus tard avec la session -->
            <div class="avatar av-green">SR</div>
            <div>
                <div class="user-name">Soa Rakoto</div>
                <div class="user-role">Employé · IT</div>
            </div>
            <a href="<?= base_url('logout') ?>" style="margin-left:auto;color:rgba(255,255,255,.25);font-size:1.1rem" title="Déconnexion">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>
</aside>
<div class="main">
    <?= $this->renderSection('content') ?>
</div>
    </div>
</body>
</html>