<div style='background-color: #f4f7f6; padding: 50px 15px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>
    <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.08); border: 1px solid #eef2f1;'>
        
        <!-- Premium Header -->
        <div style='background: linear-gradient(135deg, #6A0DAD 0%, #4A0896 100%); padding: 45px 30px; text-align: center; border-bottom: 6px solid #D4AF37;'>
            <h1 style='color: #D4AF37; margin: 0; font-size: 26px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900;'>Miss Maths/Miss Sciences</h1>
            <p style='color: #ffffff; margin: 8px 0 0 0; opacity: 0.9; font-size: 15px; letter-spacing: 5px; font-weight: 300;'>IA DE DAKAR &bull; ÉDITION 2026</p>
        </div>

        <!-- Content -->
        <div style='padding: 50px 40px; text-align: center; color: #2d3436;'>
            <div style='margin-bottom: 35px;'>
                <span style='background-color: #fcefdc; color: #d4af37; padding: 6px 15px; border-radius: 50px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;'>Invitation Officielle</span>
            </div>

            <h2 style='color: #2D3436; font-size: 24px; margin-bottom: 15px; font-weight: 700;'>Félicitations <?= esc($name) ?>,</h2>
            <p style='font-size: 17px; line-height: 1.7; color: #636e72; margin-bottom: 40px;'>
                Nous sommes honorés de vous compter parmi nos invités pour la prestigieuse cérémonie de remise des prix <strong>Miss Maths/Miss Sciences 2026</strong>.
            </p>
            
            <!-- Event Box -->
            <div style='background-color: #f8f9fa; border-radius: 20px; padding: 30px; margin-bottom: 40px; border-left: 5px solid #6A0DAD; text-align: left;'>
                <div style='margin-bottom: 20px;'>
                    <p style='margin: 0; font-size: 12px; color: #6A0DAD; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;'>Lieu de l'événement</p>
                    <p style='margin: 5px 0 0 0; font-size: 18px; color: #2d3436; font-weight: 700;'>Théâtre National Daniel Sorano</p>
                </div>
                <div>
                    <p style='margin: 0; font-size: 12px; color: #6A0DAD; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;'>Date & Heure</p>
                    <p style='margin: 5px 0 0 0; font-size: 18px; color: #2d3436; font-weight: 700;'>Mercredi 13 Mai 2026 &bull; 09h00</p>
                </div>
            </div>

            <!-- QR Code Section -->
            <div style='margin: 0 auto 40px; padding: 25px; background-color: #ffffff; border: 2px solid #eef2f1; border-radius: 20px; width: fit-content;'>
                <?php if ($cid): ?>
                    <img src='cid:<?= $cid ?>' alt='Pass QR Code' style='width: 180px; display: block;'>
                <?php else: ?>
                    <p style='color: #6A0DAD; font-weight: bold;'>QR Code joint en annexe</p>
                <?php endif; ?>
                <p style='margin: 15px 0 0 0; font-size: 11px; color: #b2bec3; text-transform: uppercase; letter-spacing: 2px;'>Pass Numérique Sécurisé</p>
            </div>

            <p style='font-size: 15px; color: #636e72; margin-bottom: 35px; background: #fff4e5; padding: 15px; border-radius: 12px; border: 1px dashed #d4af37;'>
                <i style='font-style: normal; font-size: 20px;'>📎</i> <strong>Note Importante :</strong> Votre invitation officielle est jointe à cet email en format <strong>PDF</strong> pour une impression facile.
            </p>

            <!-- Action Button -->
            <a href='<?= esc($link) ?>' style='display: inline-block; background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%); color: #ffffff; padding: 20px 40px; text-decoration: none; border-radius: 16px; font-weight: 700; font-size: 16px; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(184, 134, 11, 0.3);'>
                VOIR MON TICKET EN LIGNE
            </a>
        </div>

        <!-- Premium Footer -->
        <div style='background-color: #2D3436; padding: 35px; text-align: center;'>
            <p style='color: #ffffff; margin: 0; font-size: 13px; opacity: 0.8;'>Veuillez présenter votre QR Code à l'accueil pour validation.</p>
            <p style='color: #D4AF37; margin: 10px 0 0 0; font-size: 11px; font-weight: 600; letter-spacing: 1px;'>&copy; 2026 IA DE DAKAR &bull; MISS MATHS - MISS SCIENCES</p>
        </div>
    </div>
    
    <div style='text-align: center; margin-top: 30px;'>
        <p style='color: #b2bec3; font-size: 11px; letter-spacing: 1px;'>Propulsé par la plateforme d'événements IA de Dakar</p>
    </div>
</div>
