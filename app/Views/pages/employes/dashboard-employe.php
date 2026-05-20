<?= $this->extend('pages/employes/sidebar') ?>

<?= $this->section('content') ?>
    <div class="topbar">
      <div>
        <div class="topbar-title">Tableau de bord</div>
        <div class="topbar-breadcrumb">Accueil</div>
      </div>
      <div class="topbar-actions">
        <a href="page3-form-conge.html" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
          <i class="bi bi-plus-lg"></i> Nouvelle demande
        </a>
      </div>
    </div>

    <div class="content">

      <?php if(session()->get('success')) { ?>
        <div class="flash flash-success">
        <i class="bi bi-check-circle-fill"></i>
        <?= session()->get('success') ?>
      </div>
      <?php } ?>

       <div class="metrics">
      <!--  <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-amber"><i class="bi bi-hourglass-split"></i></div></div>
          <div class="metric-val">2</div>
          <div class="metric-label">En attente</div>
        </div>
        <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-green"><i class="bi bi-check-circle"></i></div></div>
          <div class="metric-val">5</div>
          <div class="metric-label">Approuvées</div>
        </div> -->
        <!-- <div class="metric">
          <div class="metric-top"><div class="metric-icon mi-forest"><i class="bi bi-calendar-check"></i></div></div>
          <div class="metric-val">18</div>
          <div class="metric-label">Jours restants</div>
          <div class="metric-sub">sur 30 cette année</div>
        </div> -->
        <?php foreach($conges as $c): ?>
          <div class="metric">
            <div class="metric-top"><div class="metric-icon mi-green"><i class="bi bi-check-circle"></i></div></div>
            <div class="metric-val"><?= $c['totalCount'] ?></div>
            <div class="metric-label"><?= $c['statut'] ?></div>
          </div> 
          <?php endforeach; ?>
        </div>

      <div class="data-card">
        <div class="data-card-head"><h3>Mes soldes de congés — 2025</h3></div>
        <div style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem">
          <?php foreach($data as $d) { ?>
            <div class="solde-card" style="margin:0">
              <div class="solde-header">
                <span class="solde-type"><?= $d['libelle'] ?></span>
                <span class="solde-nums"><strong><?php echo $d['jours_pris'] ?></strong> / <?= $d['jours_attribues'] ?> j</span>
              </div>
              <div class="solde-bar"><div class="solde-fill" style="width:<?= $d['perc'] ?>%"></div></div>
              <div class="solde-label"><?php echo $d['jours_reste'] ?> jours restants · <?php echo $d['jours_pris'] ?> pris</div>
            </div>
          <?php } ?>
          <!-- <div class="solde-card" style="margin:0">
            <div class="solde-header">
              <span class="solde-type">Congé maladie</span>
              <span class="solde-nums"><strong>8</strong> / 10 j</span>
            </div>
            <div class="solde-bar"><div class="solde-fill" style="width:80%"></div></div>
            <div class="solde-label">8 jours restants · 2 pris</div>
          </div>
          <div class="solde-card" style="margin:0">
            <div class="solde-header">
              <span class="solde-type">Congé spécial</span>
              <span class="solde-nums"><strong>1</strong> / 5 j</span>
            </div>
            <div class="solde-bar"><div class="solde-fill warn" style="width:20%"></div></div>
            <div class="solde-label">1 jour restant · 4 pris</div>
          </div> -->
        </div>
      </div>

      <div class="data-card">
        <div class="data-card-head">
          <h3>Mes dernières demandes</h3>
          <a href="/employe/demandes" style="font-size:.8rem;color:var(--forest);text-decoration:none">Voir tout →</a>
        </div>
        <table class="tbl">
          <thead>
            <tr><th>Type</th><th>Du</th><th>Au</th><th>Durée</th><th>Statut</th><th>Action</th></tr>
          </thead>
          <tbody>
            <!-- <tr>
              <td><span class="type-badge t-annuel">Annuel</span></td>
              <td class="td-muted">16 juin 2025</td>
              <td class="td-muted">20 juin 2025</td>
              <td class="td-mono">5 j</td>
              <td><span class="statut s-attente">en attente</span></td>
              <td><button class="btn-sm btn-cancel"><i class="bi bi-x"></i> Annuler</button></td>
            </tr>
            <tr>
              <td><span class="type-badge t-maladie">Maladie</span></td>
              <td class="td-muted">2 juin 2025</td>
              <td class="td-muted">3 juin 2025</td>
              <td class="td-mono">2 j</td>
              <td><span class="statut s-approuvee">approuvée</span></td>
              <td><span class="td-muted" style="font-size:.75rem">—</span></td>
            </tr> -->
            <?php foreach($last as $l): ?>
              <tr>
                <td><span class="type-badge t-annuel"><?= $l['libelle'] ?></span></td>
                <td class="td-muted"><?= $l['date_debut'] ?></td>
                <td class="td-muted"><?= $l['date_fin'] ?></td>
                <td class="td-mono"><?= $l['nb_jours'] ?></td>
                <td><span class="statut s-approuvee"><?= $l['statut'] ?></span></td>
                <td><span class="td-muted" style="font-size:.75rem">—</span></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
    <div class="footer-app"><i class="bi bi-c-circle"></i> 2026 <span>TechMada RH</span> — Projet CodeIgniter 4</div>
    <script>
    // On attend que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessage = document.querySelector('.flash');

        if (flashMessage) {
            // Option 1 : Disparition automatique après 5 secondes
            setTimeout(() => {
                dismissFlash(flashMessage);
            }, 5000);

            // Option 2 : Disparition au clic
            flashMessage.addEventListener('click', () => {
                dismissFlash(flashMessage);
            });
        }
    });

    function dismissFlash(element) {
        // Ajoute une classe pour l'animation de sortie
        element.style.transition = "opacity 0.6s ease, transform 0.6s ease";
        element.style.opacity = "0";
        element.style.transform = "translateY(-10px)";

        // Supprime l'élément du DOM après l'animation
        setTimeout(() => {
            element.remove();
        }, 6000); 
    }
</script>
<?= $this->endSection() ?>