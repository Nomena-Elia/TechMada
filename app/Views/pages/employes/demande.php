<?= $this->extend('pages/employes/sidebar') ?>

<?php

    $errors = session()->get('errors') ?? [];

?>

<?= $this->section('content') ?>

<div class="topbar">
      <div>
        <div class="topbar-title">Nouvelle demande de congé</div>
        <div class="topbar-breadcrumb">
          <a href="page2-dashboard-employe.html">Accueil</a>
          <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Nouvelle demande
        </div>
      </div>
    </div>

    <div class="content">

      <div class="form-layout">

        <div>
          <form action="/employe/new-demande" method="POST" class="form-section">
            <h3>Détails de la demande</h3>

            <div class="f-group" style="margin-bottom:1rem">
              <label class="f-label">Type de congé <span style="color:var(--danger)">*</span></label>
              <select class="f-select is-inval" name="types_conge_id">
                <option value="">-- Choisir un type --</option>
                <!-- <option value="1" selected>Congé annuel (18 j restants)</option>
                <option value="2">Congé maladie (8 j restants)</option>
                <option value="3">Congé spécial (1 j restant)</option>
                <option value="4">Sans solde</option> -->
                <?php foreach($data as $d) { ?>
                    <option value="<?= $d['types_conge_id'] ?>" <?php echo old('types_conge_id') != null && $d['types_conge_id'] == old('types_conge_id') ? 'selected' : '' ?>><?= $d['libelle'] . ' (reste: ' . $d['jours_reste'] . " j)" ?></option>
                <?php } ?>
              </select>
              <?php if(isset($errors['types_conge_id'])): ?>
                <div class="f-error"><i class="bi bi-exclamation-circle"></i> <?php echo $errors['types_conge_id'] ?></div>
              <?php endif; ?>
            </div>

            <div class="form-grid-2" style="margin-bottom:1rem">
              <div class="f-group">
                <label class="f-label">Date de début <span style="color:var(--danger)">*</span></label>
                <input type="date" id="date1" name="date_debut" class="f-input is-invalid" value="<?php echo old('date_debut') ?? '2025-06-23' ?>"/>
                <span class="invalid-feedback"><?= $errors['date_debut'] ?? '' ?></span>
              </div>
              <div class="f-group">
                <label class="f-label">Date de fin <span style="color:var(--danger)">*</span></label>
                <input type="date" id="date2" name="date_fin" class="f-input is-invalid" value="<?php echo old('date_fin') ?? '2025-06-27' ?>"/>
                <span class="invalid-feedback"><?= $errors['date_fin'] ?? '' ?></span>
              </div>
            </div>

            <div class="f-computed">
              <div class="f-computed-num">5</div>
              <div class="f-computed-label">jours calendaires calculés<br></div>
            </div>

            <div class="f-group" style="margin-bottom:1rem">
              <label class="f-label">Motif (optionnel)</label>
              <textarea name="motif" class="f-textarea" placeholder="Précisez le motif de votre demande si nécessaire..."></textarea>
              <div class="f-hint">Le motif est visible par le responsable RH.</div>
            </div>

            <div class="form-actions">
              <button class="btn-forest" type="submit"><i class="bi bi-send"></i> Soumettre la demande</button>
              <a href="page2-dashboard-employe.html" class="btn-secondary"><i class="bi bi-x"></i> Annuler</a>
            </div>
          </div>
</form>

        <div style="display:flex;flex-direction:column;gap:1rem">
          <div class="data-card" style="margin:0">
            <div class="data-card-head"><h3><i class="bi bi-piggy-bank" style="color:var(--forest);margin-right:5px"></i>Vos soldes actuels</h3></div>
            <div style="padding:.75rem 1.1rem;display:flex;flex-direction:column;gap:.75rem">
              <!-- <div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px">
                  <span style="font-size:.8rem;color:var(--ink)">Congé annuel</span>
                  <span style="font-family:'DM Mono',monospace;font-size:.8rem;color:var(--forest);font-weight:500">18 j</span>
                </div>
                <div class="solde-bar"><div class="solde-fill" style="width:60%"></div></div>
              </div>
              <div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px">
                  <span style="font-size:.8rem;color:var(--ink)">Maladie</span>
                  <span style="font-family:'DM Mono',monospace;font-size:.8rem;color:var(--forest);font-weight:500">8 j</span>
                </div>
                <div class="solde-bar"><div class="solde-fill" style="width:80%"></div></div>
              </div>
              <div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px">
                  <span style="font-size:.8rem;color:var(--ink)">Spécial</span>
                  <span style="font-family:'DM Mono',monospace;font-size:.8rem;color:var(--warn);font-weight:500">1 j</span>
                </div>
                <div class="solde-bar"><div class="solde-fill warn" style="width:20%"></div></div>
              </div> -->
            <?php foreach($data as $d): ?>
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px">
                    <span style="font-size:.8rem;color:var(--ink)"><?= $d['libelle'] ?></span>
                    <span style="font-family:'DM Mono',monospace;font-size:.8rem;color:var(--forest);font-weight:500"><?php echo $d['jours_attribues'] ?> j</span>
                    </div>
                    <div class="solde-bar"><div class="solde-fill" style="width:<?php echo $d['perc'] ?>%"></div></div>
                </div>
            <?php endforeach; ?>
            </div>
          </div>
          <div class="flash flash-info" style="margin:0">
            <i class="bi bi-info-circle-fill"></i>
            <span style="font-size:.8rem">Le solde est déduit uniquement à l'approbation de votre responsable.</span>
          </div>
          <div style="background:var(--cream);border:1px solid var(--border);border-radius:8px;padding:.85rem 1rem">
            <div style="font-size:.78rem;font-weight:500;color:var(--ink);margin-bottom:.5rem"><i class="bi bi-clipboard-check" style="color:var(--forest);margin-right:5px"></i>Rappel des règles</div>
            <ul style="margin:0;padding-left:1rem;font-size:.75rem;color:var(--muted);line-height:1.7">
              <li>Préavis minimum : 48h avant la date de début</li>
              <li>Pas de chevauchement avec une demande en cours</li>
              <li>Solde insuffisant = demande refusée automatiquement</li>
            </ul>
          </div>
        </div>

      </div>
    </div>
    <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span></div>

    <script>
      const input1 = document.getElementById('date1');
      const input2 = document.getElementById('date2');
      updateDiff();
      input1.addEventListener('input', function() {
        updateDiff();
      });
      input2.addEventListener('input', function() {
        updateDiff();
      });
      function updateDiff() {
        const date1 = new Date(input1.value);
        const date2 = new Date(input2.value);

        const diff = Math.abs(date1 - date2);

        const days  = Math.ceil(diff / (1000 * 60 * 60 * 24));

        document.querySelector(".f-computed-num").innerText = days;
      }
    </script>

<?= $this->endSection() ?>