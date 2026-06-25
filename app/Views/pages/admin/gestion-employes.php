
<?= $this->extend('pages/admin/sidebar')?>

<?= $this->section('css')?>
<?=  $this->endSection() ?>

<?= $this->section('content')?>
<?php

$error = session()->getFlashData('errors');
// var_dump($error);
$success = session()->getFlashData('success');

?>
<div class="main">
  <div class="topbar">
    <div>
      <div class="topbar-title">Gestion des employés</div>
      <div class="topbar-breadcrumb"><a href="page6-dashboard-admin.html">Admin</a> <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Employés</div>
    </div>
    <div class="topbar-actions">
      <a href="#" class="btn-forest" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-person-plus"></i> Ajouter</a>
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
      <form action="/admin/employe/add" method="post">
        <div class="form-grid-2" style="margin-bottom:1rem">
          <div class="f-group">
            <label class="f-label">Prénom</label>
            <input type="text" name="prenom" class="f-input <?= !empty($error['prenom']) ? 'is-invalid' : ''?> " placeholder="Jean"/>
            <span class="invalid-feedback"><?= $error['prenom'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Nom</label>
            <input type="text" name="nom" class="f-input <?= !empty($error['nom']) ? 'is-invalid' : ''?>" placeholder="Rakoto"/>
            <span class="invalid-feedback"><?= $error['nom'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Email</label>
            <input type="email" name="email" class="f-input <?= !empty($error['email']) ? 'is-invalid' : ''?>" placeholder="jean.rakoto@techmada.mg"/>
            <span class="invalid-feedback"><?= $error['email'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Mot de passe initial</label>
            <input type="password" name="passwd" class="f-input <?= !empty($error['passwd']) ? 'is-invalid' : ''?>" placeholder="À communiquer à l'employé"/>
            <span class="invalid-feedback"><?= $error['passwd'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Département</label>
            <select name="department_id" class="f-select is-invalid">
              <?php foreach($departments as $dept) {?>
                <option value="<?= $dept['id'] ?>"><?= $dept['nom'] ?></option>
              <?php }?>
              
            </select>
            <span class="invalid-feedback"><?= $error['department_id'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Rôle</label>
            <select name = "role" class="f-select">
              <?php foreach($roles as $role) {?>
                <option value="<?= $role ?>"><?= $role ?></option>
              <?php }?>
            </select>
          </div>
          <input type="hidden" name="actif" value="1">
          <div class="f-group">
            <label class="f-label">Date d'embauche</label>
            <input type="date" name="date_embauche" class="f-input  <?= !empty($error['date_embauche']) ? 'is-invalid' : ''?>" value="2025-06-13"/>
            <span class="invalid-feedback"><?= $error['date_embauche'] ?? '' ?></span>
          </div>
        </div>
        <div class="flash flash-info" style="margin-bottom:1rem">
          <i class="bi bi-info-circle-fill"></i>
          <span style="font-size:.82rem">Les soldes de congés seront initialisés automatiquement selon les types de congé configurés.</span>
        </div>
        <div class="form-actions">
          <a href="/admin/employe/add"><button class="btn-forest"><i class="bi bi-plus"></i>Creer l'employe</button></a>
          <button class="btn-secondary" disabled>Réinitialiser</button>
        </div>
      </div>
      </form>

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
          
          <tr><th>Employé</th><th>Département</th><th>Rôle</th><th>Embauche</th><th>Statut</th><!-- <th>Solde annuel</th> --><th>Actions</th></tr>
        </thead>
        <tbody>
          <?php $deptList = array_column($departments, 'nom', 'id');
          foreach($employes as $employe){
            $EmpActif = ($employe['actif'] == 1) ? 'actif' : 'inactif';
            $EmpDept = $deptList[$employe['department_id']] ?? 'Aucune Departement';
            
            ?>
            <tr>
              <td>
                <div class="profile-row">
                  <div class="avatar av-green" style="width:32px;height:32px;font-size:.68rem">SR</div>
                  <div class="profile-info"><div class="pname"><?= $employe['prenom'] ?> <?= $employe['nom'] ?></div><div class="pdept"><?= $employe['email'] ?></div></div>
                </div>
              </td>
              <td class="td-muted"><?= $EmpDept ?></td>
              <td><span class="type-badge" style="background:#f1efe8;color:#444441"><?= $employe['role'] ?></span></td>
              <td class="td-muted td-mono" style="font-size:.78rem"><?= $employe['date_embauche']?></td>
              <td><span class="statut s-approuvee" style="font-size:.68rem"><?= $EmpActif ?></span></td>
              <!-- <td><span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--forest)">18 / 30 j</span></td> -->
              <td>
                <div class="action-btns">
                <?php if($employe['actif'] == 1){?>
                    <a href="/admin/employe/update/<?= $employe['id'] ?>"><button class="btn-sm btn-edit"><i class="bi bi-pencil"></i> Éditer</button></a>
                    <a href="/admin/employe/delete/<?= $employe['id'] ?>"><button class="btn-sm btn-del" ><i class="bi bi-slash-circle"></i></button></a>
                  <?php } else{?>
                    <a href="/admin/employe/reactivate/<?= $employe['id']?>"><button class="btn-sm btn-view"><i class="bi bi-arrow-counterclockwise"></i> Réactiver</button></a>
                  <?php }?>
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
<?=  $this->endSection() ?>
