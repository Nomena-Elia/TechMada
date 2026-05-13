<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMada RH — Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="app-wrap">

        <aside class="sidebar">
            <div class="sidebar-brand">
            <div class="sidebar-logo-icon"><i class="bi bi-person-check"></i></div>
            <div class="sidebar-brand-name">TechMada RH<span>Espace responsable</span></div>
        </div>
        <div class="sidebar-section">Menu</div>
        <ul class="sidebar-nav">
            <li><a href="page6-dashboard-admin.html"><i class="bi bi-grid-1x2"></i> Tableau de bord</a></li>
            <li>
                <a href="page5-liste-rh.html" class="active">
                    <i class="bi bi-inbox"></i> Demandes à traiter
                    <span class="nav-badge alert">4</span>
                </a>
            </li>
            <li><a href="#"><i class="bi bi-archive"></i> Historique</a></li>
            <li><a href="#"><i class="bi bi-people"></i> Soldes employés</a></li>
        </ul>
        <div class="sidebar-user">
            <div class="s-user-row">
                <div class="avatar av-blue">MR</div>
                <div><div class="user-name">Marie Rabe</div><div class="user-role">Responsable RH</div></div>
                <a href="page1-login.html" style="margin-left:auto;color:rgba(255,255,255,.25);font-size:1.1rem"><i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </aside>
    <div class="main">
        <?= $this->renderSection('content') ?>
    </div>
</div>
</body>
</html>