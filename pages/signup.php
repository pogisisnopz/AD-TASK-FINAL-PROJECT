<?php
session_start();


if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}


$error_message = '';
$success_message = '';

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Registration - ABLE PLAY</title>
    <link rel="stylesheet" href="../assets/css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
    <div class="signup-background">
        <div class="animated-bg"></div>
        <div class="grid-overlay"></div>
        <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <div class="signup-container">
        <div class="signup-box" id="signupBox">
            <div class="signup-header">
                <div class="logo">
                    <i class="fas fa-crosshairs"></i>
                    <span>ABLE PLAY</span>
                </div>
                <h2>Agent Registration</h2>
                <p>Join the Protocol and become an agent</p>
            </div>

            <?php if ($error_message): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?php echo htmlspecialchars($error_message); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo htmlspecialchars($success_message); ?></span>
                </div>
            <?php endif; ?>

            <form action="../handlers/auth.handler.php" method="POST" class="signup-form">
                <input type="hidden" name="action" value="signup">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">
                            <i class="fas fa-user"></i>
                            First Name
                        </label>
                        <div class="input-wrapper">
                            <input type="text" id="first_name" name="first_name" required 
                                   placeholder="Agent's first name"
                                   value="<?php echo isset($_SESSION['form_data']['first_name']) ? htmlspecialchars($_SESSION['form_data']['first_name']) : ''; ?>">
                            <div class="input-line"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name">
                            <i class="fas fa-user"></i>
                            Last Name
                        </label>
                        <div class="input-wrapper">
                            <input type="text" id="last_name" name="last_name" required 
                                   placeholder="Agent's last name"
                                   value="<?php echo isset($_SESSION['form_data']['last_name']) ? htmlspecialchars($_SESSION['form_data']['last_name']) : ''; ?>">
                            <div class="input-line"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" required 
                               placeholder="agent@protocol.val"
                               value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
                        <div class="input-line"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-shield-alt"></i>
                        Security Code
                    </label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required 
                               placeholder="Enter your security code">
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <div class="input-line"></div>
                    </div>
                    <small class="password-hint">
                        <i class="fas fa-info-circle"></i>
                        Security code must be at least 8 characters long
                    </small>
                </div>

                <div class="form-group">
                    <label for="confirm_password">
                        <i class="fas fa-shield-alt"></i>
                        Confirm Security Code
                    </label>
                    <div class="input-wrapper">
                        <input type="password" id="confirm_password" name="confirm_password" required 
                               placeholder="Confirm your security code">
                        <button type="button" class="toggle-password" onclick="togglePassword('confirm_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <div class="input-line"></div>
                    </div>
                </div>

                <div class="form-group checkbox-group">
                    <label class="checkbox-container">
                        <input type="checkbox" name="terms" required>
                        <span class="checkmark">
                            <i class="fas fa-check"></i>
                        </span>
                        I agree to the <a href="#" target="_blank">Protocol Terms</a> and <a href="#" target="_blank">Agent Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn-signup" id="signupBtn">
                    <span>SIGN UP</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="signup-footer">
                <div class="divider">
                    <span>Existing Agent</span>
                </div>
                <p>Already registered? <a href="login.php">Access your account</a></p>
                <a href="../index.php" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Return to main
                </a>
            </div>
        </div>
    </div>

    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            const signupBox = document.getElementById('signupBox');
            signupBox.classList.add('loaded');
            
            
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentNode.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentNode.classList.remove('focused');
                });
            });
        });

        
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

       
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.setCustomValidity('Security codes do not match');
                this.classList.add('invalid');
            } else {
                this.setCustomValidity('');
                this.classList.remove('invalid');
            }
        });

        
        document.querySelector('.signup-form').addEventListener('submit', function() {
            const button = document.getElementById('signupBtn');
            button.classList.add('loading');
            button.querySelector('span').textContent = 'Initializing...';
        });
    </script>

    <?php 
    
    if (isset($_SESSION['form_data'])) {
        unset($_SESSION['form_data']);
    }
    ?>
</body>
</html>