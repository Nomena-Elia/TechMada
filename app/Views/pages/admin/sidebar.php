<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
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
  <?= $this->renderSection('css') ?>
</head>
<body>
    
    <div class="app-wrap">
        <aside class="sidebar">
        <div class="sidebar-brand">
          <div class="sidebar-logo-icon" style="background:var(--ink);border:1px solid rgba(255,255,255,.15)"><i class="bi bi-shield-check" style="color:var(--leaf)"></i></div>
          <div class="sidebar-brand-name">TechMada RH
            <span>Administration</span>
          </div>
        </div>
        <div class="sidebar-section">Gestion</div>
        <ul class="sidebar-nav">
          <li><a href="/admin/dashboard" class="active"><i class="bi bi-speedometer2"></i> Vue d'ensemble</a></li>
          <li>
            <a href="/admin/demande">
              <i class="bi bi-inbox"></i> Toutes les demandes
              <span class="nav-badge alert">4</span>
            </a>
          </li>
          <li><a href="/admin/employe"><i class="bi bi-people"></i> Employés</a></li>
          <li><a href="/admin/department"><i class="bi bi-building"></i> Départements</a></li>
          <li><a href="/admin/typeconge"><i class="bi bi-tags"></i> Types de congé</a></li>
          <li><a href="#"><i class="bi bi-sliders"></i> Soldes annuels</a></li>
        </ul>
        <div class="sidebar-user">
          <div class="s-user-row">
            <div class="avatar" style="background:#5a2d82;width:32px;height:32px;font-size:.7rem">AD</div>
            <div><div class="user-name">Administrateur</div><div class="user-role">Admin système</div></div>
            <a href="page1-login.html" style="margin-left:auto;color:rgba(255,255,255,.25);font-size:1.1rem"><i class="bi bi-box-arrow-right"></i></a>
          </div>
        </div>
      </aside>

      <main class="content-area">
          <?= $this->renderSection('content') ?>
      </main>
    
    </div>
  
</body>
</html>
