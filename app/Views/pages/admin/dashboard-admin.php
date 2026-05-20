<?= $this->extend('pages/admin/sidebar')?>

<?= $this->section('css')?>
<?=  $this->endSection() ?>

<?= $this->section('content')?>

  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">Vue d'ensemble</div>
        <div class="topbar-breadcrumb">Administration</div>
      </div>
      <div class="topbar-actions">
        <a href="<?= site_url('admin/employe') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-person-plus"></i> Gestion des employés</a>
      </div>
    </div>

    <div class="content">

      <!-- Section Statistiques Métriques -->
      <div class="metrics">
        <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-forest"><i class="bi bi-people"></i></div></div>
          <div class="metric-val"><?= $total_actifs ?></div>
          <div class="metric-label">Employés actifs</div>
          <div class="metric-sub up"><i class="bi bi-arrow-up-short"></i> +<?= $nouveaux_ce_mois ?> ce mois</div>
        </div>
        <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-amber"><i class="bi bi-hourglass-split"></i></div></div>
          <div class="metric-val"><?= $en_attente ?></div>
          <div class="metric-label">Demandes en attente</div>
        </div>
        <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-green"><i class="bi bi-calendar-check"></i></div></div>
          <div class="metric-val"><?= $approuvees_ce_mois ?></div>
          <div class="metric-label">Approuvées ce mois</div>
          <div class="metric-sub up"><i class="bi bi-arrow-up-short"></i> +6 vs mois dernier</div>
        </div>
        <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-blue"><i class="bi bi-building"></i></div></div>
          <div class="metric-val"><?= $total_departments ?></div>
          <div class="metric-label">Départements</div>
        </div>
        <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-red"><i class="bi bi-person-slash"></i></div></div>
          <div class="metric-val"><?= $total_absents ?></div>
          <div class="metric-label">Absents aujourd'hui</div>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

        <!-- Tableau des Demandes Récentes -->
        <div class="data-card" style="margin:0">
          <div class="data-card-head">
            <h3>Demandes récentes</h3>
            <a href="<?= site_url('admin/typeconge') ?>" style="font-size:.8rem;color:var(--forest);text-decoration:none">Tout voir →</a>
          </div>
          <table class="tbl">
            <thead>
              <tr><th>Employé</th><th>Type</th><th>Durée</th><th>Statut</th></tr>
            </thead>
            <tbody>
              <?php if(!empty($demandes_recentes)): ?>
                <?php foreach($demandes_recentes as $demande): ?>
                  <tr>
                    <td>
                      <div style="display:flex;align-items:center;gap:7px">
                        <div class="avatar av-blue" style="width:28px;height:28px;font-size:.62rem">
                          <?= strtoupper(substr($demande['prenom'], 0, 1) . substr($demande['nom'], 0, 1)) ?>
                        </div>
                        <span class="td-name" style="font-size:.84rem"><?= esc($demande['prenom'] . ' ' . $demande['nom']) ?></span>
                      </div>
                    </td>
                    <td><span class="type-badge t-annuel"><?= esc($demande['libelle']) ?></span></td>
                    <td class="td-mono"><?= esc($demande['nb_jours']) ?> j</td>
                    <td>
                      <span class="statut <?= $demande['statut'] === 'en attente' ? 's-attente' : 's-approuvee' ?>">
                        <?= esc($demande['statut']) ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="4" style="text-align:center">Aucune demande récente</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Liste des Absents du Jour et Alertes -->
        <div style="display:flex;flex-direction:column;gap:1rem">
          <div class="data-card" style="margin:0">
            <div class="data-card-head"><h3><i class="bi bi-person-slash" style="color:var(--muted);margin-right:5px"></i>Absents aujourd'hui</h3></div>
            <div style="padding:.75rem 1.1rem;display:flex;flex-direction:column;gap:.6rem">
              <?php if(!empty($absents_aujourdhui)): ?>
                <?php foreach($absents_aujourdhui as $absent): ?>
                  <div style="display:flex;align-items:center;gap:8px">
                    <div class="avatar av-green" style="width:30px;height:30px;font-size:.65rem">
                      <?= strtoupper(substr($absent['prenom'], 0, 1) . substr($absent['nom'], 0, 1)) ?>
                    </div>
                    <div>
                      <div style="font-size:.83rem;font-weight:500;color:var(--ink)"><?= esc($absent['prenom'] . ' ' . $absent['nom']) ?></div>
                      <div style="font-size:.72rem;color:var(--muted)"><?= esc($absent['libelle']) ?> · retour <?= date('d/m', strtotime($absent['date_fin'])) ?></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div style="font-size:.8rem;color:var(--muted);text-align:center;padding:10px 0">Aucun absent aujourd'hui</div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Alerte Solde Critique -->
          <?php if($soldes_critiques > 0): ?>
            <div class="flash flash-warn" style="margin:0">
              <i class="bi bi-exclamation-triangle-fill"></i>
              <span style="font-size:.8rem"><?= $soldes_critiques ?> employés ont un solde critique (≤ 2 jours). <a href="#" style="color:var(--warn);font-weight:500">Voir les soldes →</a></span>
            </div>
          <?php endif; ?>
        </div>

      </div>

    </div>
    <div class="footer-app"><i class="bi bi-c-circle"></i> <?= date('Y') ?> <span>TechMada RH</span></div>
  </div>

<?=  $this->endSection() ?>
