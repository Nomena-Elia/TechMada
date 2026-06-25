<?= $this->extend('pages/admin/sidebar')?>
<?= $this->section('css')?>
  <script src="/assets/js/chart.umd.js"></script>
<?=  $this->endSection() ?>
<?= $this->section('content')?>
    <div class="chart">
      <h3>Les conges par mois</h3>
      <div class="chart-wrapper mx-auto" style="width:80%;">
        <canvas id="congeMois" data-labels='<?= $chartLabel?>' data-values='<?= $chartData?>'></canvas>
      </div>
    </div>

    <div class="chart">
      <h3>Les conges par Jour de semaine</h3>
      <div class="chart-wrapper mx-auto" style="width:50%;">
        <canvas id="congeJour" data-labels='<?= $chartJourLabel?>' data-values='<?= $chartJourData?>'></canvas>
      </div>
    </div>

  <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span></div>

<script src="<?= base_url("assets/js/tableau-bord.js")?>"></script>

<?= $this->endSection() ?>