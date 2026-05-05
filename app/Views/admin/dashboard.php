<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Tableau de Bord<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row g-4 mb-5">
    <!-- Card Total Inscrits -->
    <div class="col-md-4">
        <div class="card p-4 stats-card-custom">
            <div class="d-flex align-items-center">
                <div class="stats-icon" style="background: rgba(59, 130, 246, 0.12); color: var(--admin-info);">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="ms-3 flex-grow-1">
                    <p class="stats-label">Total Inscrits</p>
                    <h2 class="stats-value" data-count="<?= $total_inscrits ?>"><?= $total_inscrits ?></h2>
                </div>
            </div>
            <div class="progress mt-3" style="height: 4px; background: rgba(255,255,255,0.05); border-radius: 2px;">
                <div class="progress-bar" style="width: 100%; background: var(--admin-info); border-radius: 2px;"></div>
            </div>
        </div>
    </div>

    <!-- Card Validés -->
    <div class="col-md-4">
        <div class="card p-4 stats-card-custom">
            <div class="d-flex align-items-center">
                <div class="stats-icon" style="background: rgba(16, 185, 129, 0.12); color: var(--admin-success);">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="ms-3 flex-grow-1">
                    <p class="stats-label">Cartes Validees</p>
                    <h2 class="stats-value" data-count="<?= $total_utilisees ?>"><?= $total_utilisees ?></h2>
                </div>
            </div>
            <?php $pct = $total_inscrits > 0 ? round(($total_utilisees / $total_inscrits) * 100) : 0; ?>
            <div class="progress mt-3" style="height: 4px; background: rgba(255,255,255,0.05); border-radius: 2px;">
                <div class="progress-bar progress-animated" style="width: <?= $pct ?>%; background: var(--admin-success); border-radius: 2px;"></div>
            </div>
            <p class="text-end mt-1 mb-0" style="font-size: 0.7rem; color: var(--admin-muted);"><?= $pct ?>% validees</p>
        </div>
    </div>

    <!-- Card En Attente -->
    <div class="col-md-4">
        <div class="card p-4 stats-card-custom">
            <div class="d-flex align-items-center">
                <div class="stats-icon" style="background: rgba(245, 158, 11, 0.12); color: var(--admin-warning);">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div class="ms-3 flex-grow-1">
                    <p class="stats-label">En attente</p>
                    <h2 class="stats-value" data-count="<?= $total_en_attente ?>"><?= $total_en_attente ?></h2>
                </div>
            </div>
            <?php $pctWait = $total_inscrits > 0 ? round(($total_en_attente / $total_inscrits) * 100) : 0; ?>
            <div class="progress mt-3" style="height: 4px; background: rgba(255,255,255,0.05); border-radius: 2px;">
                <div class="progress-bar progress-animated" style="width: <?= $pctWait ?>%; background: var(--admin-warning); border-radius: 2px;"></div>
            </div>
            <p class="text-end mt-1 mb-0" style="font-size: 0.7rem; color: var(--admin-muted);"><?= $pctWait ?>% restants</p>
        </div>
    </div>
</div>

<!-- Analytics and Quick Actions -->
<div class="row g-4">
    <!-- Chart Analytics -->
    <div class="col-md-5">
        <div class="card p-4 h-100 shadow-sm" style="background: rgba(18,18,18,0.6); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px;">
            <h5 class="fw-bold text-white mb-4"><i class="bi bi-pie-chart-fill me-2 text-primary"></i> Répartition par Profil</h5>
            <div style="height: 250px; display: flex; justify-content: center; align-items: center;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-md-7">
        <div class="row g-4">
    <div class="col-md-6">
        <a href="/admin/scanner" class="text-decoration-none">
            <div class="card p-4 quick-action-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon" style="background: linear-gradient(135deg, var(--admin-primary), var(--admin-accent)); color: white;">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold mb-0 text-white">Scanner un QR Code</h5>
                        <p class="mb-0" style="color: var(--admin-muted); font-size: 0.85rem;">Valider un billet a l entree</p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto" style="color: var(--admin-muted); font-size: 1.2rem;"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/admin/invites/new" class="text-decoration-none">
            <div class="card p-4 quick-action-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon" style="background: rgba(16, 185, 129, 0.15); color: var(--admin-success);">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="fw-bold mb-0 text-white">Ajouter un invite</h5>
                        <p class="mb-0" style="color: var(--admin-muted); font-size: 0.85rem;">Creer une invitation manuellement</p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto" style="color: var(--admin-muted); font-size: 1.2rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .stats-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .stats-label {
        color: var(--admin-muted);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .stats-value {
        font-weight: 800;
        font-size: 2rem;
        color: white;
        margin-bottom: 0;
        line-height: 1;
    }
    .quick-action-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .quick-action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(106, 13, 173, 0.15);
        border-color: rgba(106, 13, 173, 0.3);
    }
    .progress-animated {
        animation: progressGrow 1.5s ease-out;
    }
    @keyframes progressGrow {
        from { width: 0; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Count-up animation for stats
    document.querySelectorAll('.stats-value').forEach(el => {
        const target = parseInt(el.dataset.count);
        let current = 0;
        const duration = 1200;
        const step = Math.max(1, Math.ceil(target / (duration / 16)));
        
        function animate() {
            current += step;
            if (current >= target) {
                el.textContent = target;
                return;
            }
            el.textContent = current;
            requestAnimationFrame(animate);
        }
        if (target > 0) {
            el.textContent = '0';
            setTimeout(animate, 300);
        }
    });

    // Chart.js Configuration
    const chartDataObj = <?= isset($chartData) ? $chartData : '{}' ?>;
    if (chartDataObj && chartDataObj.labels && chartDataObj.labels.length > 0) {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartDataObj.labels,
                datasets: [{
                    data: chartDataObj.data,
                    backgroundColor: [
                        'rgba(106, 13, 173, 0.8)', // Primary
                        'rgba(59, 130, 246, 0.8)', // Info
                        'rgba(16, 185, 129, 0.8)', // Success
                        'rgba(245, 158, 11, 0.8)'  // Warning
                    ],
                    borderColor: 'rgba(18,18,18,1)',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: 'rgba(255,255,255,0.7)',
                            font: { size: 11, family: "'Inter', sans-serif" },
                            padding: 15
                        }
                    }
                },
                cutout: '65%'
            }
        });
    }
</script>
<?= $this->endSection() ?>
