<?= $this->extend('pages/admin/sidebar')?>
<?= $this->section('css')?>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?=  $this->endSection() ?>
<?= $this->section('content')?>

<div class="main col-12">
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

    <div class="chart">
      <h3>Les conges par mois</h3>
      <div class="chart-wrapper">
        <canvas id="congeMois" data-labels='<?= $chartLabel?>' data-values='<?= $chartData?>'></canvas>
      </div>
    </div>

  </div>
  <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span></div>
</div>
<script src="<?= base_url("assets/js/tableau-bord.js")?>"></script>

<?= $this->endSection() ?>