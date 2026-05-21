<?php helper('user') ?>

<?= $this->extend('pages/rh/sidebar'); ?>

<?= $this->section('content') ?>

<div class="topbar">
      <div>
        <div class="topbar-title">Demandes à traiter</div>
        <div class="topbar-breadcrumb"><a href="page6-dashboard-admin.html">Accueil</a> <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Demandes</div>
      </div>
      <div class="topbar-actions">
        <span style="font-size:.8rem;color:var(--muted);background:var(--warn-bg);border:1px solid var(--warn-br);border-radius:6px;padding:5px 10px;display:flex;align-items:center;gap:5px;color:var(--warn)">
          <i class="bi bi-hourglass-split"></i> <?= $count[0]['totalCount'] ?? 0 ?> en attente
        </span>
      </div>
    </div>

    <div class="content">

      <?php if(session()->getFlashData('success')): ?>
        <div class="flash flash-success">
            <i class="bi bi-check-circle-fill"></i>
            <?= session()->getFlashData('success') ?>
        </div>
      <?php endif; ?>

      <div style="display:flex;gap:8px;margin-bottom:1.25rem;flex-wrap:wrap">
        <a href="/rh/dashboard" class="text-decoration-none">
          <button style="padding:6px 14px;border-radius:20px;font-size:.8rem;font-weight:500;border:1.5px solid var(--forest);<?= $filter == null ? 'background:var(--forest);color:var(--white);' : '' ?>cursor:pointer">Tous</button>
        </a>
        <?php foreach($count as $c) { ?>
          <a href="/rh/dashboard?statut=<?= $c['statut'] ?>" class="text-decoration-none">
            <button style="padding:6px 14px;border-radius:20px;font-size:.8rem;font-weight:500;border:1.5px solid var(--forest);<?= $filter == $c['statut'] ? 'background:var(--forest);color:var(--white);' : '' ?>cursor:pointer"><?= $c['statut'] ?> (<?= $c['totalCount'] ?>)</button>
          </a>
        <?php } ?>
        <!-- <button style="padding:6px 14px;border-radius:20px;font-size:.8rem;font-weight:500;border:1.5px solid var(--border);background:var(--white);color:var(--muted);cursor:pointer">En attente (4)</button>
        <button style="padding:6px 14px;border-radius:20px;font-size:.8rem;font-weight:500;border:1.5px solid var(--border);background:var(--white);color:var(--muted);cursor:pointer">Approuvées (3)</button>
        <button style="padding:6px 14px;border-radius:20px;font-size:.8rem;font-weight:500;border:1.5px solid var(--border);background:var(--white);color:var(--muted);cursor:pointer">Refusées (1)</button> -->
        <select class="f-select" style="font-size:.8rem;padding:6px 10px;width:auto;margin-left:auto">
          <option>Tous les départements</option>
          <option>IT</option>
          <option>Finance</option>
          <option>Marketing</option>
        </select>
      </div>

      <div class="data-card">
        <div class="data-card-head"><h3>Toutes les demandes</h3></div>
        <table class="tbl">
          <thead>
            <tr><th>Employé</th><th>Type</th><th>Période</th><th>Durée</th><th>Solde dispo</th><th>Statut</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php foreach($all as $d) { ?>
                <tr>
                    <td>
                        <div class="profile-row">
                        <div class="avatar av-green" style="width:32px;height:32px;font-size:.7rem"><?= format_username($d['nom'], $d['prenom']  ) ?></div>
                        <div class="profile-info">
                            <div class="pname"><?= concat_name($d['nom'],$d['prenom']) ?></div>
                        </div>
                        </div>
                    </td>
                    <td><span class="type-badge t-annuel"><?= $d['libelle'] ?></span></td>
                    <td class="td-muted" style="font-size:.8rem"><?= $d['date_debut'] ?> → <?= $d['date_fin'] ?></td>
                    <td class="td-mono"><?= $d['nb_jours'] ?> j</td>
                    <td>
                        <span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--success);font-weight:500"><?= $d['jours_reste'] ?> j</span>
                        <span style="font-size:.72rem;color:var(--muted)"> dispo</span>
                    </td>
                    <td><span class="statut s-attente"><?= $d['statut'] ?></span></td>
                    <td>
                        <?php if($d['statut'] === 'En attente') : ?>
                          <div class="action-btns">
                            <?php if($d['nb_jours'] < $d['jours_reste']): ?>
                              <form action="/rh/demande/accept/<?= $d['id'] ?>" method="post">
                                <button class="btn-sm btn-approve"><i class="bi bi-check-lg"></i> Approuver</button>
                              </form>
                            <?php endif; ?>
                            <form action="/rh/demande/deny/<?= $d['id'] ?>" method="post">
                                <button class="btn-sm btn-refuse"><i class="bi bi-x-lg"></i> Refuser</button>
                            </form>
                          </div>
                        <?php endif; ?>
                    </td>   
                </tr>
            <?php } ?>
            <!-- <tr>
              <td>
                <div class="profile-row">
                  <div class="avatar av-amber" style="width:32px;height:32px;font-size:.7rem">TF</div>
                  <div class="profile-info">
                    <div class="pname">Tsiry Fidy</div>
                    <div class="pdept">Finance</div>
                  </div>
                </div>
               </td>
              <td><span class="type-badge t-maladie">Maladie</span></td>
              <td class="td-muted" style="font-size:.8rem">18/06 – 19/06/2025</td>
              <td class="td-mono">2 j</td>
              <td>
                <span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--warn);font-weight:500">1 j</span>
                <span style="font-size:.72rem;color:var(--danger)"> ⚠ insuffisant</span>
               </td>
              <td><span class="statut s-attente">en attente</span></td>
              <td>
                <div class="action-btns">
                  <button class="btn-sm btn-approve" disabled style="opacity:.4;cursor:not-allowed"><i class="bi bi-check-lg"></i> Approuver</button>
                  <button class="btn-sm btn-refuse"><i class="bi bi-x-lg"></i> Refuser</button>
                </div>
               </td>
            </tr>
            <tr>
              <td>
                <div class="profile-row">
                  <div class="avatar av-blue" style="width:32px;height:32px;font-size:.7rem">HA</div>
                  <div class="profile-info">
                    <div class="pname">Haja Andria</div>
                    <div class="pdept">Marketing</div>
                  </div>
                </div>
               </td>
              <td><span class="type-badge t-annuel">Annuel</span></td>
              <td class="td-muted" style="font-size:.8rem">30/06 – 04/07/2025</td>
              <td class="td-mono">5 j</td>
              <td>
                <span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--success);font-weight:500">22 j</span>
                <span style="font-size:.72rem;color:var(--muted)"> dispo</span>
               </td>
              <td><span class="statut s-attente">en attente</span></td>
              <td>
                <div class="action-btns">
                  <button class="btn-sm btn-approve"><i class="bi bi-check-lg"></i> Approuver</button>
                  <button class="btn-sm btn-refuse"><i class="bi bi-x-lg"></i> Refuser</button>
                </div>
               </td>
            </tr>
            <tr>
              <td>
                <div class="profile-row">
                  <div class="avatar av-green" style="width:32px;height:32px;font-size:.7rem">SR</div>
                  <div class="profile-info"><div class="pname">Soa Rakoto</div><div class="pdept">IT</div></div>
                </div>
               </td>
              <td><span class="type-badge t-maladie">Maladie</span></td>
              <td class="td-muted" style="font-size:.8rem">02/06 – 03/06/2025</td>
              <td class="td-mono">2 j</td>
              <td><span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--muted)">—</span></td>
              <td><span class="statut s-approuvee">approuvée</span></td>
              <td><span class="td-muted" style="font-size:.75rem">Traité par Marie R.</span></td>
            </tr> -->
          </tbody>
        </table>
      </div>


    </div>
    <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span></div>
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