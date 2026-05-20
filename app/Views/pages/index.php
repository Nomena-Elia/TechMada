<?php

  $errors = session()->getFlashData('errors') ?? [];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>TechMada RH — Administration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="/assets/css/style.css"/>
</head>
<body>
<div class="auth-page geo-bg">
<div class="auth-split">

  <div class="auth-left">
    <div>
      <p class="auth-left-brand">TechMada RH<span>Gestion des congés</span></p>
      <p class="auth-left-text" style="margin-top:2rem">
        <strong>Bienvenue sur votre espace RH.</strong>
        Gérez vos demandes de congés, consultez votre solde et suivez l'état de vos demandes en temps réel.
      </p>
    </div>
    <div class="auth-roles">
      <div style="font-size:.65rem;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,.25);margin-bottom:4px">Comptes de démonstration</div>
      <div class="role-pill">
        <i class="bi bi-shield-check"></i>
        <div><div class="role-pill-name">Administrateur</div><div class="role-pill-cred">admin@techmada.mg · admin123</div></div>
      </div>
      <div class="role-pill">
        <i class="bi bi-person-check"></i>
        <div><div class="role-pill-name">Responsable RH</div><div class="role-pill-cred">rh@techmada.mg · rh123</div></div>
      </div>
      <div class="role-pill">
        <i class="bi bi-person"></i>
        <div><div class="role-pill-name">Employé</div><div class="role-pill-cred">employe@techmada.mg · emp123</div></div>
      </div>
    </div>
  </div>

  <div class="auth-right">
    <p class="auth-title">Connexion</p>
    <p class="auth-sub">Entrez vos identifiants pour accéder à votre espace.</p>

    <?php if(!empty($errors)): ?>
      <div class="flash flash-error">
        <i class="bi bi-exclamation-circle-fill"></i>
        Identifiants incorrects. Veuillez réessayer.
      </div>
    <?php endif; ?>

    <form action="/login" method="POST">
      <div class="f-group">
        <label class="f-label">Adresse email</label>
        <input type="email" name="email" class="f-input <?= !empty($errors['email']) ? 'is-invalid' : '' ?> form-control" placeholder="vous@techmada.mg" value="<?= old('email') ?? 'employe@techmada.mg' ?>"/>
        <span class="invalid-feedback"><?= $errors['email'] ?? ''; ?></span>
      </div>
      <div class="f-group">
        <label class="f-label">Mot de passe</label>
        <div style="position: relative;">
          <input 
            type="password" 
            id="password-input"
            name="passwd" 
            class="f-input <?= !empty($errors['passwd']) ? 'is-invalid' : '' ?> form-control" 
            placeholder="••••••••" 
            value="<?= old('passwd') ?? 'emp123' ?>"
          />
          <button 
            type="button" 
            id="toggle-password" 
            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #666;"
          >
            <i class="bi bi-eye" id="eye-icon"></i>
          </button>
        </div>
        <span class="invalid-feedback"><?= $errors['passwd'] ?? ''; ?></span>
      </div>
      <button type="submit" class="btn-primary" style="margin-top:.5rem">
        Se connecter <i class="bi bi-arrow-right-short"></i>
      </button>
    </form>
  </div>

</div>
</div>
<script>
  const togglePassword = document.querySelector('#toggle-password');
  const passwordInput = document.querySelector('#password-input');
  const eyeIcon = document.querySelector('#eye-icon');

  togglePassword.addEventListener('click', function () {
    // Basculer le type d'input
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    // Basculer l'icône (Bootstrap Icons)
    this.querySelector('i').classList.toggle('bi-eye');
    this.querySelector('i').classList.toggle('bi-eye-slash');
  });
</script>
</body>
</html>

