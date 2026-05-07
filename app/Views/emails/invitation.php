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
                Nous avons l'honneur de vous inviter à la cérémonie <strong>MISS MATHS & MISS SCIENCES</strong>, qui met à l'honneur l'intelligence, la créativité et l'excellence des jeunes talents féminins dans les domaines des mathématiques et des sciences.
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
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 40px;">
                <tr>
                    <td align="center" style="background-color: #ffffff; border: 2px solid #eef2f1; border-radius: 20px; padding: 25px;">
                        <?php if ($cid): ?>
                            <img src='cid:<?= $cid ?>' alt='Pass QR Code' width="180" style='display: block; border: 0;'>
                        <?php else: ?>
                            <p style='color: #6A0DAD; font-weight: bold;'>QR Code joint en annexe</p>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <!-- Download Button -->
            <div style='margin: 40px 0;'>
                <a href="<?= base_url('/invite/ticket/' . $code) ?>" 
                   style='background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%); 
                          color: #ffffff; 
                          padding: 18px 35px; 
                          text-decoration: none; 
                          border-radius: 50px; 
                          font-weight: 800; 
                          text-transform: uppercase; 
                          letter-spacing: 2px; 
                          font-size: 14px; 
                          display: inline-block;
                          box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);'>
                   📥 Télécharger mon Invitation (PDF)
                </a>
            </div>

            <div style='font-size: 15px; color: #636e72; margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 15px; border: 1px solid #eef2f1;'>
                <p style="margin: 0; font-weight: 600; color: #2D3436;">
                    📄 Votre invitation officielle est aussi jointe à cet email.
                </p>
                <p style="margin: 5px 0 0 0; font-size: 14px;">
                    Vous pouvez cliquer sur le bouton ci-dessus ou utiliser le fichier <strong>PDF</strong> joint pour votre accès.
                </p>
            </div>
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
