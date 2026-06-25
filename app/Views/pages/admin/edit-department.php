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
      <div class="topbar-title">Update du department</div>
      <div class="topbar-breadcrumb"><a href="page6-dashboard-admin.html">Admin</a> <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Department</div>
    </div>
  </div>

  <div class="content">
    <!-- SECTION : FORMULAIRE DE Update Du departement -->
    <div class="form-section">
      <h3><i class="bi bi-person-plus" style="color:var(--forest);margin-right:6px"></i>    Update un department</h3>
      <?php if(!empty($success)){?>
          <div class="alert alert-success">
            <?= $success ?>
          </div>
        <?php }?>
      <form action="/admin/department/update/<?= $dept['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $dept['id'] ?>">
        <div class="form-grid-2" style="margin-bottom:1rem">
          <div class="f-group">
            <label class="f-label">Nom</label>
            <input type="text" name="nom" class="f-input <?= !empty($error['nom']) ? 'is-invalid' : ''?> " value='<?= $dept['nom']?>'/>
            <span class="invalid-feedback"><?= $error['nom'] ?? '' ?></span>
          </div>
          <div class="f-group">
            <label class="f-label">Description</label>
            <textarea name="description" id="description" class="<?= !empty($error['description']) ? 'is-invalid' : ''?>" value= '<?= $dept['description'] ?>'  ></textarea>
            <span class="invalid-feedback"><?= $error['description'] ?? '' ?></span>
          </div>
          
        <!-- <div class="flash flash-info" style="margin-bottom:1rem">
          <i class="bi bi-info-circle-fill"></i>
          <span style="font-size:.82rem">Les soldes de congés seront initialisés automatiquement selon les types de congé configurés.</span>
        </div> -->
        <div class="form-actions">
          <a href="/admin/department/update/<?= $dept['id'] ?>"><button class="btn-forest"><i class="bi bi-plus"></i>Mise a jour du departement</button></a>
        </div>
       </form>
    </div>
    <div class="form-actions">
         <a href="<?= base_url('/admin/department')?>"><button class="btn-secondary" >Retour</button></a>
     </div>
  </div>
</div>
    
<?= $this->endSection() ?>