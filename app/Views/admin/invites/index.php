<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Liste des Invites<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-transparent py-3 px-4 d-flex justify-content-between align-items-center border-0">
        <div>
            <h5 class="mb-0 fw-bold text-white">Gestion des Invitations</h5>
            <p class="mb-0 mt-1" style="color: var(--admin-muted); font-size: 0.8rem;">
                <?= $count_all ?> invitation(s) au total
            </p>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <div class="position-relative d-none d-md-block">
                <i class="bi bi-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: var(--admin-muted); font-size: 0.85rem;"></i>
                <input type="text" id="searchInput" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Rechercher..." style="padding-left: 34px; width: 180px; font-size: 0.85rem;">
            </div>
            <select id="categoryFilter" class="form-select form-select-sm bg-dark text-white border-secondary" style="width: auto;">
                <option value="">Toutes les catégories</option>
                <option value="1" <?= (isset($current_category) && $current_category == 1) ? 'selected' : '' ?>>CEM</option>
                <option value="2" <?= (isset($current_category) && $current_category == 2) ? 'selected' : '' ?>>Lycées</option>
                <option value="3" <?= (isset($current_category) && $current_category == 3) ? 'selected' : '' ?>>Privé/Autre</option>
                <option value="4" <?= (isset($current_category) && $current_category == 4) ? 'selected' : '' ?>>Communauté</option>
            </select>
            <a href="/admin/invites/exportCSV?status=<?= $current_status ?>" id="exportBtn" class="btn btn-outline-info btn-sm px-3">
                <i class="bi bi-file-earmark-excel me-1"></i> Exporter CSV
            </a>
            <a href="/admin/invites/validate-all" class="btn btn-outline-success btn-sm px-3">
                <i class="bi bi-check-all me-1"></i> Tout valider
            </a>
            <a href="/admin/invites/new" class="btn btn-primary btn-sm px-3">
                <i class="bi bi-person-plus-fill me-1"></i> Ajouter
            </a>
        </div>
    </div>

    <!-- Onglets de filtrage UX -->
    <div class="px-4 pb-0 border-bottom border-white border-opacity-10">
        <div class="d-flex gap-4">
            <a href="#" data-status="en_attente" class="tab-link <?= $current_status == 'en_attente' ? 'active' : '' ?>">
                A valider <span class="badge ms-1" id="badge-pending"><?= $count_pending ?></span>
            </a>
            <a href="#" data-status="valide" class="tab-link <?= $current_status == 'valide' ? 'active' : '' ?>">
                Déjà validés <span class="badge ms-1" id="badge-validated"><?= $count_validated ?></span>
            </a>
            <a href="#" data-status="tous" class="tab-link <?= $current_status == 'tous' ? 'active' : '' ?>">
                Tous <span class="badge ms-1" id="badge-all"><?= $count_all ?></span>
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="invitesTable">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Profil & Identité</th>
                        <th>Contact & Détails</th>
                        <th>Statut</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?= view('admin/invites/partials/table_body', ['invites' => $invites]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .tab-link {
        color: var(--admin-muted);
        text-decoration: none;
        padding: 0.75rem 0.25rem;
        font-weight: 600;
        font-size: 0.88rem;
        border-bottom: 2px solid transparent;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
    }
    .tab-link:hover {
        color: white;
    }
    .tab-link.active {
        color: var(--admin-primary-light);
        border-bottom-color: var(--admin-primary-light);
    }
    .tab-link .badge {
        background: rgba(255,255,255,0.06);
        color: var(--admin-muted);
        font-size: 0.7rem;
        font-weight: 500;
        padding: 2px 6px;
    }
    .tab-link.active .badge {
        background: rgba(106, 13, 173, 0.2);
        color: var(--admin-primary-light);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Real-time smarter search filter
    document.getElementById('searchInput').addEventListener('input', function() {
        const terms = this.value.toLowerCase().split(' ').filter(t => t.trim() !== '');
        document.querySelectorAll('.invite-row').forEach(row => {
            const text = row.textContent.toLowerCase();
            const matches = terms.every(term => text.includes(term));
            row.style.display = (terms.length === 0 || matches) ? '' : 'none';
        });
    });

    // AJAX Validation
    function validateInvite(id, btn) {
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em;"></span>';
        btn.style.pointerEvents = 'none';

        fetch(`/admin/invites/${id}/validate`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                const row = btn.closest('tr');
                
                // Update Statut (Column 4)
                const statusTd = row.querySelector('td:nth-child(4)');
                statusTd.innerHTML = `
                    <span class="badge-status badge-validated pulse-success">
                        <i class="bi bi-check-circle-fill me-1"></i>Validé le ${data.date}
                    </span>
                `;
                
                // Remove Validate and Cancel buttons from Actions (Column 5)
                const actionTd = row.querySelector('td:nth-child(5)');
                const validateBtn = actionTd.querySelector('.validate');
                const cancelBtn = actionTd.querySelector('.cancel');
                if (validateBtn) validateBtn.remove();
                if (cancelBtn) cancelBtn.remove();
            } else {
                btn.innerHTML = originalHtml;
                btn.style.pointerEvents = 'auto';
                alert('Erreur lors de la validation.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            btn.innerHTML = originalHtml;
            btn.style.pointerEvents = 'auto';
            alert('Erreur réseau.');
        });
    }

    // AJAX Tab and Filter navigation
    let currentStatus = '<?= $current_status ?>';
    let currentCategory = '<?= $current_category ?>';

    function fetchInvites() {
        const tbody = document.querySelector('#invitesTable tbody');
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><div class="mt-2 text-muted">Chargement...</div></td></tr>';

        let url = `/admin/invites?status=${currentStatus}`;
        if (currentCategory) url += `&category=${currentCategory}`;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            tbody.innerHTML = data.html;
            
            // Update badges
            document.getElementById('badge-all').innerText = data.counts.all;
            document.getElementById('badge-pending').innerText = data.counts.pending;
            document.getElementById('badge-validated').innerText = data.counts.validated;

            // Update URL without reloading
            window.history.pushState({}, '', url);

            // Update Export Button URL
            let exportUrl = `/admin/invites/exportCSV?status=${currentStatus}`;
            if (currentCategory) exportUrl += `&category=${currentCategory}`;
            document.getElementById('exportBtn').href = exportUrl;

            // Trigger search filter re-evaluation if search input isn't empty
            const searchInput = document.getElementById('searchInput');
            if(searchInput.value.trim() !== '') {
                searchInput.dispatchEvent(new Event('input'));
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-danger">Erreur lors du chargement des données.</td></tr>';
        });
    }

    // Tab clicks
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            currentStatus = this.dataset.status;
            fetchInvites();
        });
    });

    // Category filter change
    document.getElementById('categoryFilter').addEventListener('change', function() {
        currentCategory = this.value;
        fetchInvites();
    });
</script>
<?= $this->endSection() ?>
