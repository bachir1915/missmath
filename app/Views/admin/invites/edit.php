<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Modifier l'Invité<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card p-4 p-md-5">
            <div class="mb-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div style="width: 44px; height: 44px; background: rgba(59, 130, 246, 0.12); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--admin-info); font-size: 1.2rem;">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-white mb-0">Modifier <?= esc($invite['prenom']) ?></h5>
                        <p class="mb-0" style="color: var(--admin-muted); font-size: 0.8rem;">ID: #<?= $invite['id'] ?> &bull; Code: <?= $invite['code_unique'] ?></p>
                    </div>
                </div>
            </div>

            <form action="/admin/invites/<?= $invite['id'] ?>" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <?= csrf_field() ?>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= esc($invite['prenom']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= esc($invite['nom']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($invite['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="<?= esc($invite['telephone']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Réseau Social Rejoint</label>
                    <select name="social_network" class="form-select">
                        <option value="" <?= empty($invite['social_network']) ? 'selected' : '' ?>>Aucun / Non renseigné</option>
                        <option value="WhatsApp" <?= $invite['social_network'] == 'WhatsApp' ? 'selected' : '' ?>>WhatsApp</option>
                        <option value="Telegram" <?= $invite['social_network'] == 'Telegram' ? 'selected' : '' ?>>Telegram</option>
                        <option value="Facebook" <?= $invite['social_network'] == 'Facebook' ? 'selected' : '' ?>>Facebook</option>
                        <option value="Instagram" <?= $invite['social_network'] == 'Instagram' ? 'selected' : '' ?>>Instagram</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="en_attente" <?= $invite['statut'] == 'en_attente' ? 'selected' : '' ?>>En attente</option>
                        <option value="valide" <?= $invite['statut'] == 'valide' ? 'selected' : '' ?>>Utilisé / Validé</option>
                        <option value="annule" <?= $invite['statut'] == 'annule' ? 'selected' : '' ?>>Annulé</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between pt-2" style="border-top: 1px solid var(--admin-border);">
                    <a href="/admin/invites" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
