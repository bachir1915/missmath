<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Miss Maths/Miss Sciences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #0B0B14;
            --admin-surface: #12121F;
            --admin-sidebar: #0F0F1E;
            --admin-border: rgba(255, 255, 255, 0.06);
            --admin-primary: #6A0DAD;
            --admin-primary-light: #8B3FCF;
            --admin-accent: #D4AF37;
            --admin-text: #E8E4F0;
            --admin-muted: #6B6580;
            --admin-success: #10B981;
            --admin-danger: #EF4444;
            --admin-warning: #F59E0B;
            --admin-info: #3B82F6;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--admin-sidebar);
            border-right: 1px solid var(--admin-border);
            position: fixed;
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid var(--admin-border);
        }
        .sidebar-logo {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-accent) 100%);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.1rem;
            color: white;
            box-shadow: 0 4px 15px rgba(106, 13, 173, 0.3);
        }
        .sidebar-title {
            font-weight: 700;
            font-size: 1rem;
            color: white;
            letter-spacing: 0.5px;
        }
        .sidebar-badge {
            font-size: 0.65rem;
            background: rgba(106, 13, 173, 0.2);
            color: var(--admin-primary-light);
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* ── Nav Links ── */
        .sidebar-nav {
            padding: 1rem 0.75rem;
            flex: 1;
        }
        .sidebar-nav .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--admin-muted);
            padding: 0.5rem 1rem;
            margin-top: 0.5rem;
            font-weight: 600;
        }
        .sidebar-nav .nav-link {
            color: var(--admin-muted);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin: 2px 0;
            font-size: 0.88rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.25s ease;
            position: relative;
        }
        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            margin-right: 12px;
            transition: color 0.25s ease;
        }
        .sidebar-nav .nav-link:hover {
            color: white;
            background: rgba(106, 13, 173, 0.12);
        }
        .sidebar-nav .nav-link:hover i {
            color: var(--admin-primary-light);
        }
        .sidebar-nav .nav-link.active {
            color: white;
            background: linear-gradient(135deg, rgba(106, 13, 173, 0.25), rgba(106, 13, 173, 0.1));
            box-shadow: 0 0 20px rgba(106, 13, 173, 0.1);
        }
        .sidebar-nav .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 15%; bottom: 15%;
            width: 3px;
            background: var(--admin-primary-light);
            border-radius: 2px;
        }
        .sidebar-nav .nav-link.active i {
            color: var(--admin-accent);
        }

        /* ── Sidebar Footer ── */
        .sidebar-footer {
            padding: 1rem 0.75rem;
            border-top: 1px solid var(--admin-border);
        }
        .sidebar-footer .nav-link {
            color: var(--admin-danger) !important;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.25s ease;
        }
        .sidebar-footer .nav-link:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* ── Main Content ── */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* ── Top Header ── */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--admin-border);
        }
        .page-title {
            font-weight: 700;
            font-size: 1.6rem;
            color: white;
        }
        .user-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            padding: 8px 16px;
            border-radius: 12px;
        }
        .user-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-accent));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.8rem; color: white;
        }

        /* ── Cards ── */
        .card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            border-bottom: 1px solid var(--admin-border);
        }

        /* ── Alerts ── */
        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.25);
            color: var(--admin-success);
            border-radius: 12px;
        }
        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: var(--admin-danger);
            border-radius: 12px;
        }
        .btn-close {
            filter: invert(1);
        }

        /* ── Tables ── */
        .table { color: var(--admin-text); }
        .table thead th {
            background: rgba(255, 255, 255, 0.03);
            color: var(--admin-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            border-bottom: 1px solid var(--admin-border);
            padding: 14px 16px;
        }
        .table tbody td {
            border-bottom: 1px solid var(--admin-border);
            padding: 14px 16px;
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background: rgba(106, 13, 173, 0.05);
        }
        .table-light { background: transparent !important; }

        /* ── Badges ── */
        .badge-status {
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .badge-pending {
            background: rgba(245, 158, 11, 0.15);
            color: var(--admin-warning);
        }
        .badge-validated {
            background: rgba(16, 185, 129, 0.15);
            color: var(--admin-success);
        }
        .badge-cancelled {
            background: rgba(239, 68, 68, 0.15);
            color: var(--admin-danger);
        }

        /* ── Form Controls (admin) ── */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--admin-border);
            color: var(--admin-text);
            border-radius: 10px;
            padding: 10px 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--admin-primary-light);
            box-shadow: 0 0 0 3px rgba(106, 13, 173, 0.15);
            color: white;
        }
        .form-control::placeholder { color: var(--admin-muted); }
        .form-label {
            color: var(--admin-muted);
            font-weight: 500;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── Buttons ── */
        .btn-primary {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-light));
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(106, 13, 173, 0.3);
            background: linear-gradient(135deg, var(--admin-primary-light), var(--admin-primary));
        }
        .btn-outline-primary {
            border-color: var(--admin-primary-light);
            color: var(--admin-primary-light);
        }
        .btn-outline-primary:hover {
            background: var(--admin-primary);
            border-color: var(--admin-primary);
        }
        .btn-outline-secondary {
            border-color: var(--admin-border);
            color: var(--admin-muted);
        }
        .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--admin-muted);
            color: white;
        }
        .btn-outline-danger {
            border-color: rgba(239, 68, 68, 0.3);
            color: var(--admin-danger);
        }
        .btn-outline-danger:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: var(--admin-danger);
            color: var(--admin-danger);
        }

        /* ── Fade In ── */
        .fade-in { animation: fadeIn 0.6s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--admin-bg); }
        ::-webkit-scrollbar-thumb { background: var(--admin-primary); border-radius: 3px; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="d-flex align-items-center gap-3">
                <div class="sidebar-logo" style="font-size: 0.9rem;">MMS</div>
                <div>
                    <div class="sidebar-title" style="font-size: 0.9rem;">Miss Maths/Miss Sciences</div>
                    <span class="sidebar-badge" style="margin-top: 2px; display: inline-block;">ADMIN 2026</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Navigation</div>
            <a href="/admin/dashboard" class="nav-link <?= url_is('admin/dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="/admin/invites" class="nav-link <?= url_is('admin/invites*') ? 'active' : '' ?> d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people"></i> Invités</span>
                <?php 
                    $userModel = new \App\Models\UserModel();
                    $countInvites = $userModel->where('role', 'invite')->countAllResults();
                ?>
                <span class="badge rounded-pill bg-white bg-opacity-10 text-white fw-normal" style="font-size: 0.65rem;"><?= $countInvites ?></span>
            </a>
            <a href="/admin/scanner" class="nav-link <?= url_is('admin/scanner') ? 'active' : '' ?>">
                <i class="bi bi-qr-code-scan"></i> Scanner QR
            </a>
            <a href="/admin/users" class="nav-link <?= url_is('admin/users*') ? 'active' : '' ?> d-flex justify-content-between align-items-center">
                <span><i class="bi bi-person-gear"></i> Staff / Admins</span>
                <?php 
                    $userModel = new \App\Models\UserModel();
                    $countStaff = $userModel->where('role', 'admin')->countAllResults();
                ?>
                <span class="badge rounded-pill bg-white bg-opacity-10 text-white fw-normal" style="font-size: 0.65rem;"><?= $countStaff ?></span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="/logout" class="nav-link">
                <i class="bi bi-box-arrow-left me-2"></i> Déconnexion
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-header fade-in">
            <h1 class="page-title"><?= $this->renderSection('title') ?></h1>
            <div class="user-badge">
                <div class="user-avatar">
                    <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?>
                </div>
                <div>
                    <div class="d-none d-sm-block">
                        <div class="fw-bold text-white small"><?= session()->get('username') ?></div>
                        <div style="color: var(--admin-muted); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">
                            Administrateur
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="fade-in">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
