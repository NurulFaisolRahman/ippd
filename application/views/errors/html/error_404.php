<?php
$CI =& get_instance();
?>

<?php $CI->load->view('Kementerian/header'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

.error-section {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(180deg, #f8fafc 0%, #ecfdf5 100%);
    padding: 60px 20px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    position: relative;
    overflow: hidden;
}

/* Background Pattern - Garuda Inspired */
.error-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(5, 150, 105, 0.08) 0%, transparent 50%);
    pointer-events: none;
}

.error-wrapper {
    max-width: 900px;
    width: 100%;
    text-align: center;
    position: relative;
    z-index: 1;
}

/* Top Badge */
.error-badge {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 40px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #059669;
}

.error-badge::before,
.error-badge::after {
    content: '';
    width: 30px;
    height: 1px;
    background: #059669;
}

/* Main 404 Display */
.error-code {
    font-size: clamp(120px, 20vw, 220px);
    font-weight: 900;
    line-height: 1;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    letter-spacing: -10px;
}

.error-digit {
    color: #064e3b;
    text-shadow: 
        4px 4px 0px rgba(16, 185, 129, 0.1),
        8px 8px 0px rgba(16, 185, 129, 0.05);
    position: relative;
    display: inline-block;
}

.error-digit:nth-child(2) {
    color: #059669;
    transform: translateY(-10px);
}

/* Garuda Symbol in Zero */
.error-zero {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.garuda-icon {
    position: absolute;
    width: 60%;
    height: 60%;
    opacity: 0.15;
    filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
}

/* Decorative Line */
.error-divider {
    width: 120px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #10b981, transparent);
    margin: 40px auto;
    position: relative;
}

.error-divider::before {
    content: '§';
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background: #f8fafc;
    padding: 0 15px;
    color: #059669;
    font-size: 20px;
    font-weight: 300;
}

/* Message */
.error-message {
    margin-bottom: 50px;
}

.error-message h2 {
    font-size: 24px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 16px;
    letter-spacing: 0.5px;
}

.error-message p {
    font-size: 16px;
    color: #6b7280;
    line-height: 1.7;
    max-width: 500px;
    margin: 0 auto;
    font-weight: 400;
}

/* Action Buttons */
.error-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    background: #059669;
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-radius: 4px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.2), 0 2px 4px -1px rgba(5, 150, 105, 0.1);
    border: 2px solid #059669;
}

.btn-primary:hover {
    background: #047857;
    border-color: #047857;
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.3);
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    background: transparent;
    color: #6b7280;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-radius: 4px;
    transition: all 0.3s ease;
    border: 2px solid #e5e7eb;
}

.btn-secondary:hover {
    border-color: #059669;
    color: #059669;
    background: rgba(5, 150, 105, 0.05);
}

/* Government Seal/Logo Placeholder */
.govt-seal {
    width: 80px;
    height: 80px;
    margin: 0 auto 30px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    border: 3px solid #10b981;
    position: relative;
}

.govt-seal::before {
    content: '🇮🇩';
    font-size: 40px;
}

.govt-seal::after {
    content: '';
    position: absolute;
    inset: -5px;
    border: 1px solid #10b981;
    border-radius: 50%;
    opacity: 0.3;
}

/* Footer Info */
.error-footer {
    margin-top: 60px;
    padding-top: 30px;
    border-top: 1px solid #e5e7eb;
    font-size: 13px;
    color: #9ca3af;
    letter-spacing: 0.5px;
}

.error-footer strong {
    color: #059669;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .error-code {
        letter-spacing: -5px;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-primary,
    .btn-secondary {
        justify-content: center;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.error-wrapper > * {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}

.error-wrapper > *:nth-child(1) { animation-delay: 0.1s; }
.error-wrapper > *:nth-child(2) { animation-delay: 0.2s; }
.error-wrapper > *:nth-child(3) { animation-delay: 0.3s; }
.error-wrapper > *:nth-child(4) { animation-delay: 0.4s; }
.error-wrapper > *:nth-child(5) { animation-delay: 0.5s; }
</style>

<section class="error-section">
    <div class="error-wrapper">
        
       
        
        <!-- Badge -->
        <div class="error-badge">
            Oops! &nbsp;•&nbsp; Page Not Found
        </div>
        
        <!-- 404 Code -->
        <h1 class="error-code">
            <span class="error-digit">4</span>
            <span class="error-digit error-zero">
                0
                
            </span>
            <span class="error-digit">4</span>
        </h1>
        
        <!-- Divider -->
        <div class="error-divider"></div>
        
        <!-- Message -->
        <div class="error-message">
            <h2>Maaf, Halaman Tidak Ditemukan</h2>
            
        </div>
        
        <!-- Actions -->
        <div class="error-actions">
            <a href="<?= base_url() ?>" class="btn-primary">
                <span>Kembali ke Beranda</span>
                <i class="fas fa-arrow-right"></i>
            </a>
            <button onclick="window.history.back()" class="btn-secondary">
                <span>Halaman Sebelumnya</span>
            </button>
        </div>
        
        <!-- Footer -->
        <div class="error-footer">
            <p>
                <strong>IPPD</strong> &copy; <?= date('Y') ?> 
                | Sistem Indeks Perencanaan Pembangunan Daerah
            </p>
        </div>
        
    </div>
</section>

<!-- Load Font Awesome if not already loaded in header -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">