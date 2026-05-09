<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Votre Invitation VIP - Miss Maths 2026<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    :root {
        --mm-accent-gold: #D4AF37;
        --mm-accent-soft: rgba(212, 175, 55, 0.2);
        --mm-card-bg: rgba(25, 10, 45, 0.7);
    }

    .ticket-container {
        margin-top: 2rem;
        margin-bottom: 3rem;
    }

    .premium-ticket {
        background: #ffffff;
        border-radius: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        max-width: 550px;
        margin: 0 auto;
        color: #2c3e50;
        border: 1px solid #eee;
    }

    .ticket-header {
        background: #6A0DAD;
        padding: 40px 20px;
        text-align: center;
        border-bottom: 6px solid #D4AF37;
    }

    .event-title-main {
        font-size: 1.8rem;
        color: #D4AF37;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin: 0;
    }

    .vip-badge-wrapper {
        margin: 30px 0 20px;
        text-align: center;
    }

    .vip-badge {
        background: #fdf5e6;
        color: #b8860b;
        padding: 8px 25px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        display: inline-block;
        border: 1px solid #f5deb3;
    }

    .ticket-body {
        padding: 0 40px 40px;
        text-align: center;
    }

    .guest-name-large {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .invitation-text-box {
        color: #7f8c8d;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 30px;
        padding: 0 10px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .info-item {
        background: #f9fbfc;
        padding: 15px;
        border-left: 4px solid #6A0DAD;
        text-align: left;
    }

    .info-label {
        font-size: 0.6rem;
        color: #95a5a6;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 4px;
        display: block;
    }

    .info-label i {
        color: #D4AF37 !important; /* Gold */
        margin-right: 8px;
        font-size: 1.1rem; /* Augmenté de 0.9rem */
        vertical-align: middle;
    }

    .info-value {
        color: #2c3e50;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .info-item.full-width {
        grid-column: span 2;
    }

    .qr-zone {
        background: white;
        padding: 15px;
        border: 1px solid #eeeeee;
        border-radius: 20px;
        display: inline-block;
        margin: 30px 0 10px;
    }
    
    .qr-image {
        width: 200px;
        height: 200px;
        display: block;
    }

    .security-code {
        font-size: 0.65rem;
        color: #bdc3c7;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 40px;
    }

    .ticket-footer {
        background: #fafafa;
        padding: 30px;
        border-top: 1px solid #eeeeee;
        font-size: 0.7rem;
        color: #bdc3c7;
        line-height: 1.6;
    }

    #capture-area {
        padding: 50px 30px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        border-radius: 60px;
        box-shadow: 0 40px 100px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.8);
    }

    .download-actions {
        display: flex;
        justify-content: center;
        margin-top: 40px;
        margin-bottom: 50px;
    }

    .btn-download-premium {
        background: var(--mm-accent-gold);
        color: #000;
        padding: 18px 45px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: none;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 15px 35px rgba(212, 175, 55, 0.3);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-download-premium:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 45px rgba(212, 175, 55, 0.5);
        color: #000;
        background: #e5c04a;
    }

    .btn-download-premium i {
        font-size: 1.4rem;
    }

    @media print {
        @page { size: A4 portrait; margin: 0; }
        html, body { height: 100%; margin: 0 !important; padding: 0 !important; background: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        
        .d-print-none, .alert, #email-status, #redirect-msg, .math-bg, nav, footer { display: none !important; }
        
        .ticket-container { margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; transform: none !important; }
        
        .premium-ticket { 
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            width: 170mm !important;
            height: auto !important;
            background: white !important;
            border: 1px solid #e0e0e0 !important;
            border-radius: 25px !important;
            box-shadow: none !important;
            overflow: hidden !important;
        }

        .ticket-header { 
            background: #6A0DAD !important; 
            padding: 35px 30px !important;
            border-bottom: 6px solid #D4AF37 !important;
            text-align: center !important;
        }

        .vip-badge { 
            background: #fdf5e6 !important; 
            color: #b8860b !important; 
            padding: 8px 20px !important;
            border: 1px solid #f5deb3 !important;
            border-radius: 30px !important;
            font-size: 11px !important;
            font-weight: bold !important;
            margin-bottom: 20px !important;
        }

        .event-title-main { 
            color: #D4AF37 !important; 
            font-size: 28px !important;
            font-weight: bold !important;
            margin: 0 !important;
        }

        .ticket-body { padding: 35px 50px !important; }

        .guest-name-large { 
            color: #1a1a1a !important; 
            font-size: 24px !important;
            font-weight: bold !important;
            background: none !important;
            -webkit-text-fill-color: initial !important;
            margin-bottom: 5px !important;
        }

        .guest-email { color: #7f8c8d !important; font-size: 14px !important; }

        .info-grid { 
            display: table !important; 
            width: 100% !important; 
            border-spacing: 15px 0 !important;
            margin: 30px 0 !important;
        }
        .info-item { 
            display: table-cell !important;
            background: #f9fbfc !important;
            border-left: 5px solid #6A0DAD !important;
            padding: 15px !important;
            border-top: none !important;
            border-right: none !important;
            border-bottom: none !important;
            text-align: left !important;
        }
        .info-label { font-size: 9px !important; color: #95a5a6 !important; }
        .info-value { font-size: 14px !important; color: #2c3e50 !important; }
        .info-item i { display: none !important; }

        .qr-zone { 
            background: white !important;
            padding: 12px !important;
            border: 1px solid #eeeeee !important;
            border-radius: 20px !important;
            margin: 0 auto !important;
            display: inline-block !important;
        }
        .qr-image { width: 180px !important; height: 180px !important; }

        .security-code { background: none !important; border: none !important; color: #bdc3c7 !important; font-size: 9px !important; margin-top: 10px !important; }

        .invitation-text-box {
            background: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 25px 0 !important;
            color: #7f8c8d !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            text-align: center !important;
        }
        .invitation-text-box p { color: #7f8c8d !important; }
        .invitation-text-box strong { color: #6A0DAD !important; }
    }
</style>

<div class="row justify-content-center px-3">
    <div class="col-md-6 col-lg-5 ticket-container">
        
        <!-- Header Success Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 shadow-sm mb-4 text-center" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border-radius: 15px;">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div id="capture-area">
            <div class="premium-ticket">
                <!-- HEADER -->
                <div class="ticket-header">
                    <h1 class="event-title-main">Miss Maths / Miss Sciences</h1>
                    <p style="color: rgba(255,255,255,0.8); font-size: 0.75rem; letter-spacing: 4px; margin-top: 8px;">IA DE DAKAR &bull; 2026</p>
                </div>

                <div class="vip-badge-wrapper">
                    <div class="vip-badge">Invitation Officielle</div>
                </div>

                <!-- BODY -->
                <div class="ticket-body">
                    <h2 class="guest-name-large"><?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?></h2>
                    
                    <div class="invitation-text-box">
                        Nous avons l'honneur de vous inviter à la cérémonie <strong>MISS MATHS & MISS SCIENCES</strong>, qui met à l'honneur l'intelligence, la créativité et l'excellence des jeunes talents féminins dans les domaines des mathématiques et des sciences.
                    </div>

                    <!-- INFO GRID -->
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-telephone-fill me-1"></i> Téléphone de l'invité</span>
                            <div class="info-value"><?= format_phone_number($invite['telephone']) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-calendar-event-fill me-1"></i> Date & Heure</span>
                            <div class="info-value">13 Mai 2026 &bull; 09h00</div>
                        </div>
                        <div class="info-item full-width">
                            <span class="info-label"><i class="bi bi-geo-alt-fill me-1" style="color: #D4AF37;"></i> Lieu de l'événement</span>
                            <div class="info-value">Théâtre National Daniel Sorano</div>
                        </div>

                        <?php if (!empty($invite['establishment'])): ?>
                            <div class="info-item">
                                <span class="info-label"><i class="bi bi-building-fill me-1" style="color: #D4AF37;"></i> <?= ($invite['category_id'] == 3) ? 'Groupe / Entité' : 'Établissement' ?></span>
                                <div class="info-value"><?= esc($invite['establishment']) ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($invite['class'])): ?>
                            <div class="info-item">
                                <span class="info-label"><i class="bi bi-mortarboard-fill me-1" style="color: #D4AF37;"></i> Classe / Niveau</span>
                                <div class="info-value"><?= esc($invite['class']) ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($invite['profession'])): ?>
                            <div class="info-item">
                                <span class="info-label"><i class="bi bi-briefcase-fill me-1"></i> Profession</span>
                                <div class="info-value"><?= esc($invite['profession']) ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($invite['interest'])): ?>
                            <div class="info-item full-width">
                                <span class="info-label"><i class="bi bi-info-circle-fill me-1"></i> Intérêt pour le concours</span>
                                <div class="info-value"><?= esc($invite['interest']) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- QR CODE (Canvas pour une capture PDF garantie) -->
                    <div class="qr-zone" style="background: #fff; padding: 15px; border-radius: 20px;">
                        <?php 
                            $qrData = '';
                            $qPath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'qrcodes' . DIRECTORY_SEPARATOR . $invite['qr_path'];
                            if (file_exists($qPath)) {
                                $qrData = base64_encode(file_get_contents($qPath));
                            }
                        ?>
                        <canvas id="qr-canvas" width="200" height="200" style="width: 160px; height: 160px; display: block; margin: 0 auto;"></canvas>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const canvas = document.getElementById('qr-canvas');
                                if (canvas) {
                                    const ctx = canvas.getContext('2d');
                                    const img = new Image();
                                    img.onload = function() {
                                        ctx.drawImage(img, 0, 0, 200, 200);
                                    };
                                    img.src = "data:image/png;base64,<?= $qrData ?>";
                                }
                            });
                        </script>
                    </div>

                    <div class="security-code">RÉFÉRENCE : <?= strtoupper(substr($invite['code_unique'], 0, 16)) ?></div>

                    <div class="ticket-footer">
                        Cette invitation est strictement personnelle et infalsifiable. <br>
                        Elle devra être présentée sous format numérique ou imprimé au service d'accueil.<br>
                        <strong>Inspection d'Académie de Dakar &copy; 2026</strong>
                    </div>
                </div>
            </div>
            
            <div class="certified-text">
                Document officiel certifié par l'IA de Dakar
            </div>
        </div>

        <!-- DOWNLOAD ACTIONS -->
        <div class="download-actions d-print-none" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <button type="button" id="download-pdf" class="btn-download-premium">
                <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger mon Invitation (PDF)
            </button>
        </div>

        <!-- Notification Status -->
        <div class="text-center mt-5 d-print-none">
            <div id="email-status" class="p-3 px-4 rounded-pill d-inline-flex align-items-center gap-3" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); min-width: 300px; justify-content: center;">
                <div class="bi bi-envelope-check-fill text-success fs-4"></div>
                <span id="status-text" class="text-success" style="font-size: 0.85rem;">Invitation envoyée à <br><strong><?= esc($invite['email']) ?></strong></span>
            </div>

            <div id="redirect-msg" class="mt-4" style="display: none;">
                <a href="<?= base_url('/') ?>" class="btn btn-outline-light btn-sm rounded-pill px-4 py-2" style="border-color: rgba(255,255,255,0.2); font-size: 0.8rem; letter-spacing: 1px;">
                    <i class="bi bi-person-plus me-1"></i> Inscrire une autre personne
                </a>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    // Fonction utilitaire pour s'assurer que les images sont chargées
    function preloadImages(element) {
        const images = element.getElementsByTagName('img');
        const promises = [];
        for (let img of images) {
            if (!img.complete) {
                promises.push(new Promise(resolve => {
                    img.onload = img.onerror = resolve;
                }));
            }
        }
        return Promise.all(promises);
    }

    async function generateCapture(format, btn) {
        const element = document.getElementById('capture-area');
        const originalHtml = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Génération...';

        try {
            // Attendre que toutes les images (dont le QR Code) soient chargées
            await preloadImages(element);
            
            // Sécurité supplémentaire : Attente forcée
            await new Promise(resolve => setTimeout(resolve, 1000));

            window.scrollTo(0, 0);

            const canvas = await html2canvas(element, {
                scale: 3, // Scale 3 est suffisant pour une qualité d'impression excellente
                useCORS: true,
                allowTaint: true,
                backgroundColor: null,
                logging: false,
                onclone: (clonedDoc) => {
                    // Forcer l'affichage du QR Code (Canvas)
                    const qrCanvas = clonedDoc.getElementById('qr-canvas');
                    if (qrCanvas) {
                        qrCanvas.style.display = 'block';
                        qrCanvas.style.visibility = 'visible';
                        qrCanvas.style.opacity = '1';
                    }
                    // S'assurer que le bouton de téléchargement n'est pas dans le clone
                    const btnActions = clonedDoc.querySelector('.download-actions');
                    if (btnActions) btnActions.style.display = 'none';
                }
            });

            const fileName = 'Invitation_MissMath_2026';

            if (format === 'png') {
                const link = document.createElement('a');
                link.download = `${fileName}.png`;
                link.href = canvas.toDataURL('image/png', 1.0);
                link.click();
            } else if (format === 'pdf') {
                const { jsPDF } = window.jspdf;
                const imgData = canvas.toDataURL('image/png', 1.0);
                
                // On utilise le ratio de conversion standard (1px = 0.264583mm)
                // Divisé par 3 car scale: 3 dans html2canvas
                const imgWidthMM = canvas.width * 0.264583 / 3;
                const imgHeightMM = canvas.height * 0.264583 / 3;
                
                const pdf = new jsPDF({
                    orientation: imgWidthMM > imgHeightMM ? 'l' : 'p',
                    unit: 'mm',
                    format: [imgWidthMM, imgHeightMM]
                });

                // 1. On ajoute le ticket complet capturé par html2canvas
                pdf.addImage(imgData, 'PNG', 0, 0, imgWidthMM, imgHeightMM);

                // 2. SOLUTION ULTIME : Injection directe du QR Code par-dessus
                // Si html2canvas a raté le QR, on le force ici manuellement
                try {
                    const qrCanvas = document.getElementById('qr-canvas');
                    if (qrCanvas) {
                        const qrData = qrCanvas.toDataURL('image/png');
                        const qrZone = document.querySelector('.qr-zone');
                        const capArea = document.getElementById('capture-area');
                        
                        // Calcul de la position relative du QR dans la zone de capture
                        const qrRect = qrZone.getBoundingClientRect();
                        const capRect = capArea.getBoundingClientRect();
                        
                        // Ratio de position (0 à 1)
                        // On ajoute un léger ajustement pour le padding interne de qr-zone (15px)
                        const xRatio = (qrRect.left - capRect.left + 15) / capRect.width;
                        const yRatio = (qrRect.top - capRect.top + 15) / capRect.height;
                        const wRatio = (qrRect.width - 30) / capRect.width;
                        const hRatio = (qrRect.height - 30) / capRect.height;
                        
                        // Dessiner le QR par-dessus au millimètre près
                        pdf.addImage(
                            qrData, 
                            'PNG', 
                            xRatio * imgWidthMM, 
                            yRatio * imgHeightMM, 
                            wRatio * imgWidthMM, 
                            hRatio * imgHeightMM
                        );
                    }
                } catch (qrError) {
                    console.error("Erreur injection QR directe:", qrError);
                }

                pdf.save(`${fileName}.pdf`);
            }
        } catch (err) {
            console.error("Capture Error:", err);
            alert("Erreur de génération. Vérifiez votre connexion.");
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const pdfBtn = document.getElementById('download-pdf');
        
        if (pdfBtn) {
            pdfBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                generateCapture('pdf', e.currentTarget);
            });
        }

        const redirectMsg = document.getElementById('redirect-msg');
        if (redirectMsg) redirectMsg.style.display = 'block';
    });
</script>

<?= $this->endSection() ?>
