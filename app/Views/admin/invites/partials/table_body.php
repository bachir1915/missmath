<?php if (empty($invites)): ?>
<tr>
    <td colspan="5" class="text-center py-4 text-muted">
        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
        Aucun invité trouvé pour ces critères.
    </td>
</tr>
<?php endif; ?>

<?php foreach ($invites as $invite): ?>
<tr class="invite-row">
    <td class="ps-4">
        <span style="color: var(--admin-muted); font-size: 0.8rem;"><?= $invite['id'] ?></span>
    </td>
    <td>
        <div class="d-flex align-items-center gap-3">
            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, var(--admin-primary), var(--admin-accent)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; color: white; flex-shrink: 0;">
                <?= strtoupper(substr($invite['prenom'], 0, 1) . substr($invite['nom'], 0, 1)) ?>
            </div>
            <div>
                <div class="fw-semibold text-dark d-flex align-items-center gap-2">
                    <?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?>
                    <?php if(isset($invite['category_name'])): ?>
                        <span class="badge bg-secondary bg-opacity-25 text-warning border border-warning border-opacity-25" style="font-size: 0.65rem; padding: 2px 6px;"><?= esc($invite['category_name']) ?></span>
                    <?php endif; ?>
                </div>
                <div style="color: var(--admin-muted); font-size: 0.75rem; margin-top: 2px;">
                    <?php if($invite['category_id'] == 4): ?>
                        <i class="bi bi-person-badge me-1"></i><?= esc($invite['profession'] ?: 'Non renseigné') ?>
                    <?php else: ?>
                        <i class="bi bi-building me-1"></i><?= esc($invite['establishment'] ?: 'Non renseigné') ?> <?= esc($invite['class'] ? ' - '.$invite['class'] : '') ?>
                    <?php endif; ?>
                </div>
                <span style="color: var(--admin-muted); font-size: 0.7rem; font-family: monospace;"><i class="bi bi-upc-scan me-1"></i><?= $invite['code_unique'] ?></span>
            </div>
        </div>
    </td>
    <td>
        <div style="color: var(--admin-muted); font-size: 0.85rem;"><i class="bi bi-envelope me-2"></i><?= esc($invite['email']) ?></div>
        <div style="color: var(--admin-muted); font-size: 0.85rem; margin-top: 2px;"><i class="bi bi-telephone me-2"></i><?= format_phone_number($invite['telephone']) ?></div>
        <?php if($invite['social_network'] || $invite['interest']): ?>
            <div style="color: var(--admin-muted); font-size: 0.75rem; margin-top: 4px;" class="fst-italic">
                <?= $invite['social_network'] ? '<i class="bi bi-chat-dots me-1"></i>'.esc($invite['social_network']).' &nbsp;' : '' ?>
                <?= $invite['interest'] ? '<i class="bi bi-heart me-1"></i>'.esc($invite['interest']) : '' ?>
            </div>
        <?php endif; ?>
    </td>
    <td>
        <?php if ($invite['statut'] == 'en_attente'): ?>
            <span class="badge-status badge-pending">
                <i class="bi bi-clock me-1"></i>En attente
            </span>
        <?php elseif ($invite['statut'] == 'valide' || $invite['statut'] == 'scanne'): ?>
            <span class="badge-status badge-validated">
                <i class="bi bi-check-circle-fill me-1"></i>Validé le <?= date('d/m H:i', strtotime($invite['updated_at'])) ?>
            </span>
        <?php elseif ($invite['statut'] == 'annule'): ?>
            <span class="badge-status badge-cancelled">
                <i class="bi bi-x-circle me-1"></i>Annule
            </span>
        <?php endif; ?>
    </td>
    <td class="text-end pe-4">
        <div class="d-flex gap-1 justify-content-end">
            <?php if ($invite['statut'] == 'en_attente'): ?>
            <a href="#" onclick="validateInvite(<?= $invite['id'] ?>, this); return false;" class="btn btn-sm btn-outline-success validate" title="Valider l entree">
                <i class="bi bi-check-lg"></i>
            </a>
            <a href="/admin/invites/<?= $invite['id'] ?>/cancel" class="btn btn-sm btn-outline-warning cancel" title="Annuler le ticket">
                <i class="bi bi-slash-circle"></i>
            </a>
            <?php endif; ?>
            <form action="/admin/invites/<?= $invite['id'] ?>" method="POST" onsubmit="return confirm('Supprimer definitivement cet invite ?')">
                <input type="hidden" name="_method" value="DELETE">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
<?php endforeach; ?>
