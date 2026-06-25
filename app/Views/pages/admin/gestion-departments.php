<?= $this->extend('pages/admin/sidebar')?>

<?= $this->section('css')?>
<?=  $this->endSection() ?>
<?php

$errors = session()->getFlashData('errors');
$success = session()->getFlashData('success');

?>
<?= $this->section('content')?>
<div class="main">
  <div class="topbar">
    <div>
      <div class="topbar-title">Gestion des departements</div>
      <div class="topbar-breadcrumb"><a href="page6-dashboard-admin.html">Admin</a> <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Employés</div>
    </div>
    <div class="topbar-actions">
      <a href="#" class="btn-forest" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-person-plus"></i> Ajouter un departement</a>
    </div>
  </div>

  <div class="content">

    <!-- SECTION : FORMULAIRE DE CRÉATION DE L'EMPLOYÉ -->
    <div class="form-section">
      <h3><i class="bi bi-person-plus" style="color:var(--forest);margin-right:6px"></i>Ajouter un employé</h3>
      <?php if(!empty($success)){?>
          <div class="alert alert-success">
            <?= $success ?>
          </div>
        <?php }?>
      <form action="/admin/department/add" method="post">
        <div class="form-grid-2" style="margin-bottom:1rem">
          <div class="f-group">
            <label class="f-label">Nom</label>
            <input type="text" name="nom" class="f-input <?= !empty($error['nom']) ? 'is-invalid' : ''?> " placeholder="Informatique"/>
            <span class="invalid-feedback"><?= $error['nom'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Description</label>
            <textarea name="description" id="description" class="<?= !empty($error['description']) ? 'is-invalid' : ''?>" ></textarea>
            <span class="invalid-feedback"><?= $error['description'] ?? '' ?></span>
          </div>
          
        <div class="flash flash-info" style="margin-bottom:1rem">
          <i class="bi bi-info-circle-fill"></i>
          <span style="font-size:.82rem">Les soldes de congés seront initialisés automatiquement selon les types de congé configurés.</span>
        </div>
        <div class="form-actions">
          <a href="/admin/department/add"><button class="btn-forest"><i class="bi bi-plus"></i>Creer le departement</button></a>
          <button class="btn-secondary" disabled>Réinitialiser</button>
        </div>
       </form>
    </div>

    <!-- SECTION EN COMMENTAIRE : LISTE ET FILTRES (HORS CRÉATION)  -->
    <div class="data-card">
      <div class="data-card-head">
        <h3>Tous les employés</h3>
        <div style="display:flex;gap:6px">
          <input type="text" class="f-input" placeholder="Rechercher..." style="width:200px;padding:6px 10px;font-size:.8rem"/>
          <select class="f-select" style="font-size:.8rem;padding:6px 10px;width:auto">
            <option>Tous les depts</option>
            <option>IT</option>
            <option>Finance</option>
          </select>
        </div>
      </div>
      <table class="tbl">
        <thead>
          
          <tr><th>Numero Departement</th><th>Nom</th><th>Description</th><th>Actions</th></tr>
        </thead>
        <tbody>
          <?php foreach($departments as $dept) {?>
            <tr>
              <td class="td-muted td-mono" style="font-size:.78rem"><?= $dept['id']?></td>
              <td><span class="type-badge" style="background:#f1efe8;color:#444441"><?= $dept['nom'] ?></span></td>
              <td class="td-muted"><?= $dept['description'] ?></td>
              <td>
                <div class="action-btns">
                    <a href="/admin/department/<?= $dept['id'] ?>"><button class="btn-sm btn-edit"><i class="bi bi-pencil"></i> Éditer</button></a>
                    <a href="/admin/department/delete/<?= $dept['id'] ?>"><button class="btn-sm btn-del" ><i class="bi bi-slash-circle"></i></button></a>
                </div>
              </td>
            </tr>
            
          <?php }?>
          <!-- <tr>
            <td>
              <div class="profile-row">
                <div class="avatar av-blue" style="width:32px;height:32px;font-size:.68rem">MR</div>
                <div class="profile-info"><div class="pname">Marie Rabe</div><div class="pdept">rh@techmada.mg</div></div>
              </div>
             </td>
            <td class="td-muted">RH</td>
            <td><span class="type-badge t-maladie">rh</span></td>
            <td class="td-muted td-mono" style="font-size:.78rem">2020-01-15</td>
            <td><span class="statut s-approuvee" style="font-size:.68rem">actif</span></td>
            <td><span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--forest)">25 / 30 j</span></td>
            <td>
              <div class="action-btns">
                <button class="btn-sm btn-edit"><i class="bi bi-pencil"></i> Éditer</button>
                <button class="btn-sm btn-del"><i class="bi bi-slash-circle"></i></button>
              </div>
             </td>
          </tr> -->
          <!-- <tr style="opacity:.5">
            <td>
              <div class="profile-row">
                <div class="avatar av-amber" style="width:32px;height:32px;font-size:.68rem">TF</div>
                <div class="profile-info"><div class="pname">Tsiry Fidy</div><div class="pdept">tsiry@techmada.mg</div></div>
              </div>
             </td>
            <td class="td-muted">Finance</td>
            <td><span class="type-badge" style="background:#f1efe8;color:#444441">employe</span></td>
            <td class="td-muted td-mono" style="font-size:.78rem">2019-07-10</td>
            <td><span class="statut s-annulee" style="font-size:.68rem">inactif</span></td>
            <td><span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--muted)">— / — j</span></td>
            <td>
              <div class="action-btns">
                <button class="btn-sm btn-view"><i class="bi bi-arrow-counterclockwise"></i> Réactiver</button>
              </div>
             </td>
          </tr> -->
        </tbody>
      </table>
    </div>
   
  </div>
  <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span></div>
</div>
<?= $this->endSection() ?>