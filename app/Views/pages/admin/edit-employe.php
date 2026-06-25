<?= $this->extend('pages/admin/sidebar') ?>


<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?php

$errors = session()->getFlashData('errors');
$success = session()->getFlashData('success');

?>
<?= $this->section('content') ?>
<div class="main">
  <div class="topbar">
    <div>
      <div class="topbar-title">Update des employés</div>
      <div class="topbar-breadcrumb"><a href="page6-dashboard-admin.html">Admin</a> <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Employés</div>
    </div>
  </div>

  <div class="content">

    <!-- SECTION : FORMULAIRE DE MISE A JOUR DE L'EMPLOYÉ -->
    <div class="form-section">
      <h3><i class="bi bi-person-plus" style="color:var(--forest);margin-right:6px"></i>Update un employé</h3>
      <form action="/admin/employe/updated/<?= $employe['id'] ?>" method="post">
          <?php if(!empty($success)){?>
          <div class="alert alert-success">
              <?= $success ?>
            </div>
            <?php }?>
            <div class="form-grid-2" style="margin-bottom:1rem">
            <input type="hidden" name="id" value=<?= $employe['id']  ?>>
          <div class="f-group">
            <label class="f-label">Prénom</label>
            <input type="text" name="prenom" class="f-input <?= !empty($error['prenom']) ? 'is-invalid' : ''?> " value="<?= $employe['prenom'] ?>" />
            <span class="invalid-feedback"><?= $error['prenom'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Nom</label>
            <input type="text" name="nom" class="f-input <?= !empty($error['nom']) ? 'is-invalid' : ''?>" value='<?= $employe['nom'] ?>' />
            <span class="invalid-feedback"><?= $error['nom'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Email</label>
            <input type="email" name="email" class="f-input <?= !empty($error['email']) ? 'is-invalid' : ''?>" value="<?= $employe['email'] ?>"/>
            <span class="invalid-feedback"><?= $error['email'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Département</label>
            <select name="department_id" class="f-select is-invalid">

              <?php foreach($departments as $dept) {
                $isSelected = ($employe['department_id'] == $dept['id']) ? 'selected' : ''?>
                <option value="<?= $dept['id'] ?>" <?= $isSelected ?>><?= $dept['nom'] ?></option>
              <?php }?>

            </select>
            <span class="invalid-feedback"><?= $error['department_id'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Rôle</label>
            <select name = "role" class="f-select">

                <?php foreach($roles as $role) {
                    $isSelected = ($employe['role'] == $role) ? 'selected' : '' ?>
                    <option value="<?= $role ?>" <?= $isSelected ?>><?= $role ?></option>
              <?php }?>

            </select>
          </div>
          <div class="f-group">
            <label class="f-label">Compte Actif</label><input type="checkbox" name="actif" id="actif" value='<?= $employe['actif'] ?>' class="f-input  <?= !empty($error['acif']) ? 'is-invalid' : ''?>" <?= ($employe['actif'] == 1) ? 'checked' : '' ?>/>
            <span class="invalid-feedback"><?= $error['actif'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Date d'embauche</label>
            <input type="date" name="date_embauche" class="f-input  <?= !empty($error['date_embauche']) ? 'is-invalid' : ''?>" value="<?= $employe['date_embauche']?>" />
            <span class="invalid-feedback"><?= $error['date_embauche'] ?? '' ?></span>
          </div>
        </div>
        <div class="flash flash-info" style="margin-bottom:1rem">
          <i class="bi bi-info-circle-fill"></i>
          <span style="font-size:.82rem">Les soldes de congés seront initialisés automatiquement selon les types de congé configurés.</span>
        </div>
        <div class="form-actions">
            <a href="/admin/employe/updated/<?= $employe['id'] ?>"><button class="btn-forest"><i class="bi bi-plus"></i>Mise a jour de l'employe</button></a>
        </div>
        </form>
        <div class="form-actions">
            <a href="/admin/employe"><button class="btn-secondary" >Retour</button></a>
        </div>
    </div>
  </div>
</div>
    
<?= $this->endSection() ?>