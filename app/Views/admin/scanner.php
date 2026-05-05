<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Scanner de Billets<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card p-0 overflow-hidden border-0 bg-transparent">
            <!-- Scanner Viewport -->
            <div class="scanner-wrapper position-relative rounded-4 overflow-hidden shadow-lg mb-4" style="aspect-ratio: 1/1; background: #000;">
                <div id="reader" style="width: 100%; height: 100%;"></div>
                
                <!-- Scanning UI Overlay -->
                <div class="scanner-overlay position-absolute top-0 start-0 w-100 h-100 pointer-events-none d-flex align-items-center justify-content-center" id="scanner-overlay">
                    <div class="scanner-frame">
                        <div class="corner top-left"></div>
                        <div class="corner top-right"></div>
                        <div class="corner bottom-left"></div>
                        <div class="corner bottom-right"></div>
                        <div class="scanner-line"></div>
                    </div>
                </div>

                <!-- Result Overlay (Hidden by default) -->
                <div id="result-overlay" class="position-absolute top-0 start-0 w-100 h-100 d-none flex-column align-items-center justify-content-center text-center p-4" style="backdrop-filter: blur(8px); background: rgba(0,0,0,0.7); z-index: 10;">
                    <div id="result-icon-large" class="mb-3 display-1"></div>
                    <h2 id="result-title-large" class="fw-bold text-white mb-2"></h2>
                    <p id="result-message-large" class="text-white opacity-75 mb-4"></p>
                    <button id="reset-btn" class="btn btn-light rounded-pill px-5 py-2 fw-bold">
                        <i class="bi bi-arrow-repeat me-2"></i>Scanner le suivant
                    </button>
                </div>
            </div>

            <!-- Manual Entry / Info -->
            <div class="card p-4 text-center">
                <div id="status-text" class="text-muted small mb-3">
                    <i class="bi bi-info-circle me-1"></i> Placez le QR code dans le cadre pour scanner
                </div>
                <button id="start-btn" class="btn btn-primary btn-lg w-100 rounded-4 py-3 shadow">
                    <i class="bi bi-camera-fill me-2"></i> Activer la caméra
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .scanner-wrapper {
        border: 2px solid var(--admin-border);
    }
    
    .scanner-frame {
        width: 70%;
        height: 70%;
        border: 2px solid rgba(255, 255, 255, 0.1);
        position: relative;
        box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
    }

    .corner {
        position: absolute;
        width: 30px;
        height: 30px;
        border: 4px solid var(--admin-primary-light);
    }

    .top-left { top: -2px; left: -2px; border-right: 0; border-bottom: 0; }
    .top-right { top: -2px; right: -2px; border-left: 0; border-bottom: 0; }
    .bottom-left { bottom: -2px; left: -2px; border-right: 0; border-top: 0; }
    .bottom-right { bottom: -2px; right: -2px; border-left: 0; border-top: 0; }

    .scanner-line {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--admin-primary-light), transparent);
        box-shadow: 0 0 15px var(--admin-primary-light);
        animation: scanLine 2s infinite ease-in-out;
    }

    @keyframes scanLine {
        0%, 100% { top: 0; }
        50% { top: 100%; }
    }

    .pulse-success { animation: pulseSuccess 0.5s ease-out; }
    .pulse-error { animation: pulseError 0.5s ease-out; }

    @keyframes pulseSuccess {
        0% { background: rgba(16, 185, 129, 0); }
        50% { background: rgba(16, 185, 129, 0.4); }
        100% { background: rgba(16, 185, 129, 0); }
    }

    @keyframes pulseError {
        0% { background: rgba(239, 68, 68, 0); }
        50% { background: rgba(239, 68, 68, 0.4); }
        100% { background: rgba(239, 68, 68, 0); }
    }
    
    #reader__scan_region {
        background: black !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    const html5QrCode = new Html5Qrcode("reader");
    const resultOverlay = document.getElementById('result-overlay');
    const resultIcon = document.getElementById('result-icon-large');
    const resultTitle = document.getElementById('result-title-large');
    const resultMessage = document.getElementById('result-message-large');
    const startBtn = document.getElementById('start-btn');
    const resetBtn = document.getElementById('reset-btn');
    const scannerOverlay = document.getElementById('scanner-overlay');

    let isScanning = false;

    function onScanSuccess(decodedText) {
        // Stopper le scan après une détection
        html5QrCode.stop().then(() => {
            isScanning = false;
            scannerOverlay.classList.add('d-none');
            
            // Envoyer au serveur
            verifyCode(decodedText);
        });
    }

    function verifyCode(text) {
        let code = text;
        try {
            const url = new URL(text);
            code = url.searchParams.get("code") || text;
        } catch (e) {}

        fetch('/admin/verify-scan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'code=' + encodeURIComponent(code)
        })
        .then(response => response.json())
        .then(data => {
            showResult(data);
        })
        .catch(err => {
            showResult({status: 'error', message: 'Erreur de connexion au serveur.'});
        });
    }

    function showResult(data) {
        resultOverlay.classList.remove('d-none');
        resultOverlay.classList.add('d-flex');
        
        if (data.status === 'success') {
            resultIcon.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
            resultTitle.innerText = 'ACCÈS AUTORISÉ';
            resultOverlay.classList.add('pulse-success');
        } else if (data.status === 'fraud') {
            resultIcon.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger"></i>';
            resultTitle.innerText = 'DÉJÀ UTILISÉ';
            resultOverlay.classList.add('pulse-error');
        } else {
            resultIcon.innerHTML = '<i class="bi bi-x-circle-fill text-warning"></i>';
            resultTitle.innerText = 'ERREUR';
        }
        
        resultMessage.innerText = data.message;
    }

    function startScanner() {
        if (!isScanning) {
            resultOverlay.classList.add('d-none');
            resultOverlay.classList.remove('d-flex', 'pulse-success', 'pulse-error');
            scannerOverlay.classList.remove('d-none');
            
            html5QrCode.start(
                { facingMode: "environment" }, 
                { fps: 15, qrbox: { width: 250, height: 250 } },
                onScanSuccess
            ).then(() => {
                isScanning = true;
                startBtn.classList.add('d-none');
            }).catch(err => {
                alert("Impossible d'accéder à la caméra : " + err);
            });
        }
    }

    startBtn.addEventListener('click', startScanner);
    resetBtn.addEventListener('click', startScanner);
</script>
<?= $this->endSection() ?>
