<?php
session_start();


if (isset($_SESSION['user_id'])) {
    $user_name = $_SESSION['user_name'];
} else {
    $user_name = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABLEPLAY - Elite Agent Portal</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
    <div class="background-grid"></div>
    <div class="background-glow"></div>
    <div class="floating-particles"></div>
    
    <div class="container">
        
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-brand">
                    <div class="brand-icon">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h2>ABLE<span class="accent">PLAY</span></h2>
                </div>
                
                <div class="nav-actions">
                    <?php if ($user_name): ?>
                        <div class="agent-status">
                            <div class="status-indicator pulsing"></div>
                            <div class="agent-info">
                                <span class="agent-label">AGENT</span>
                                <span class="agent-name"><?php echo strtoupper(htmlspecialchars($user_name)); ?></span>
                            </div>
                        </div>
                        <a href="#" onclick="confirmLogout(event)" class="btn btn-danger">
                            <i class="fas fa-power-off"></i>
                            <span class="btn-text">LOG OUT</span>
                            <div class="btn-glow"></div>
                        </a>
                    <?php else: ?>
                        <a href="pages/login.php" class="btn btn-outline">
                            <i class="fas fa-key"></i>
                            <span class="btn-text">LOGIN</span>
                            <div class="btn-glow"></div>
                        </a>
                        <a href="pages/signup.php" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i>
                            <span class="btn-text">SIGN UP</span>
                            <div class="btn-glow"></div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        
        <main class="main-content">
            <div class="hero-section">
                <div class="hero-bg"></div>
                
                <div class="hero-content">
                    
                    <h1 class="hero-title">
                        <span class="title-line">ABLE</span>
                        <span class="title-line accent glow">PLAY</span>
                        <span class="title-subtitle">YOUR TRUSTED VALORANT SKIN STORE</span>
                    </h1>
                    
                    <?php if ($user_name): ?>
                        
                        <div class="mission-briefing">
                            <div class="briefing-header">
                                <div class="briefing-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <span class="briefing-title">MISSION BRIEFING</span>
                                <div class="briefing-status">
                                    <span class="status-text">ACTIVE</span>
                                </div>
                            </div>
                            <div class="briefing-content">
                                <p class="briefing-text">
                                    Welcome back, <span class="highlight">Agent <?php echo htmlspecialchars($user_name); ?></span>. 
                                    Your tactical interface is primed and ready for deployment. 
                                    All systems operational.
                                </p>
                                <div class="system-status">
                                    <div class="status-item">
                                        <i class="fas fa-wifi"></i>
                                        <span>Network: <span class="status-good">SECURE</span></span>
                                    </div>
                                    <div class="status-item">
                                        <i class="fas fa-database"></i>
                                        <span>Database: <span class="status-good">ONLINE</span></span>
                                    </div>
                                    <div class="status-item">
                                        <i class="fas fa-lock"></i>
                                        <span>Security: <span class="status-good">ENCRYPTED</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-panel">
                            <a href="pages/homepage.php" class="btn btn-deploy primary-action">
                                <div class="btn-icon">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <span class="btn-text">BUY SKINS NOW</span>
                                <div class="btn-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                                <div class="btn-glow"></div>
                            </a>
                        </div>
                    <?php else: ?>
                        
                        <div class="recruitment-brief">
                            <div class="classified-badge">
                                <i class="fas fa-eye-slash"></i>
                                <span>CLASSIFIED ACCESS</span>
                            </div>
                            <p class="brief-text">
                                Join the <span class="highlight">elite able network</span>. 
                                Access restricted protocols and deploy advanced combat strategies. 
                                Your mission awaits, Agent.
                            </p>
                            <div class="features-grid">
                                <div class="feature-item">
                                    <i class="fas fa-crosshairs"></i>
                                    <span>Precision Tactics</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Secure Operations</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-users"></i>
                                    <span>Team Coordination</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-trophy"></i>
                                    <span>Elite Rankings</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-panel">
                            <a href="pages/signup.php" class="btn btn-deploy primary-action">
                                <div class="btn-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <span class="btn-text">INITIATE PROTOCOL</span>
                                <div class="btn-arrow">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                                <div class="btn-glow"></div>
                            </a>
                            <a href="pages/login.php" class="btn btn-secondary">
                                <div class="btn-icon">
                                    <i class="fas fa-fingerprint"></i>
                                </div>
                                <span class="btn-text">AUTHENTICATE</span>
                                <div class="btn-glow"></div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                
                
                <div class="hero-decorations">
                    <div class="tactical-overlay">
                        <div class="scanning-line"></div>
                        <div class="target-reticle top-left"></div>
                        <div class="target-reticle top-right"></div>
                        <div class="target-reticle bottom-left"></div>
                        <div class="target-reticle bottom-right"></div>
                    </div>
                    <div class="geometric-shapes">
                        <div class="shape triangle-1"></div>
                        <div class="shape triangle-2"></div>
                        <div class="shape hexagon-1"></div>
                        <div class="shape line-accent-1"></div>
                        <div class="shape line-accent-2"></div>
                    </div>
                </div>
            </div>
        </main>

        
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-line"></div>
                <div class="footer-text">
                    <span>&copy; 2025 ABLE PLAY</span>
                    <span class="separator">|</span>
                    <span>ALL RIGHTS RESERVED</span>
                    <span class="separator">|</span>
                    <span class="classified">TRUSTED LEVEL 5</span>
                </div>
                <div class="footer-line"></div>
            </div>
        </footer>
    </div>

    <script>
       
        function confirmLogout(event) {
            event.preventDefault();
            
            if (confirm("⚠️ WARNING: Are you sure you want to log out?\n\nThis will terminate your current session and return you to the login screen.")) {
                window.location.href = "handlers/auth.handler.php?action=logout";
            }
        }

        
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
            particle.style.opacity = Math.random() * 0.5 + 0.1;
            document.querySelector('.floating-particles').appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 5000);
        }

        
        setInterval(createParticle, 300);
    </script>
</body>
</html>