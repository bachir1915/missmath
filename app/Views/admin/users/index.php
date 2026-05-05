<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Gestion du Staff<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-transparent py-3 px-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 fw-bold text-white">Gestion des Administrateurs & Staff</h5>
            <p class="mb-0 mt-1" style="color: var(--admin-muted); font-size: 0.8rem;"><?= count($users) ?> utilisateur(s) au total</p>
        </div>
        <a href="/admin/users/new" class="btn btn-primary btn-sm px-3">
            <i class="bi bi-person-plus-fill me-1"></i> Ajouter un membre
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Créé le</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr class="invite-row">
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; color: var(--admin-primary-light);">
                                    <?= strtoupper(substr($user['prenom'], 0, 1)) ?>
                                </div>
                                <div class="fw-semibold text-white"><?= esc($user['prenom'] . ' ' . $user['nom']) ?></div>
                            </div>
                        </td>
                        <td style="color: var(--admin-muted);"><?= esc($user['email']) ?></td>
                        <td>
                            <?php if ($user['role'] == 'admin'): ?>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded-pill" style="font-size: 0.7rem;">
                                    Administrateur
                                </span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 rounded-pill" style="font-size: 0.7rem;">
                                    Staff / Scanner
                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="color: var(--admin-muted); font-size: 0.85rem;"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                        <td class="text-end pe-4">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="/admin/users/<?= $user['id'] ?>/edit" class="btn btn-sm btn-outline-primary" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php if ($user['id'] != session()->get('user_id')): ?>
                                <form action="/admin/users/<?= $user['id'] ?>" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
