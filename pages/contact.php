<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = htmlspecialchars($_POST['firstName'] ?? '');
    $lastName = htmlspecialchars($_POST['lastName'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;
    
    
    if (empty($firstName) || empty($lastName) || empty($email) || empty($subject) || empty($message)) {
        header('Location: contact.php?status=error');
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: contact.php?status=error');
        exit;
    }
    
   
    header('Location: contact.php?status=success');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - </title>
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <i class="fas fa-crosshairs"></i>
                ABLE PLAY
            </div>
            <div class="nav-links">
                <a href="homepage.php" class="nav-link">Home</a>
                <a href="contact.php" class="nav-link active">Contact</a>
            </div>
        </div>
    </nav>
    
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1 class="hero-title">Get in Touch</h1>
            <p class="hero-subtitle">Have questions about our skins or need support? We're here to help!</p>
        </div>
    </section>

   
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                
                <div class="contact-info">
                    <h2 class="section-title">Contact Information</h2>
                    
                    <div class="contact-card">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Address</h3>
                                <p>123 Main Street<br>
                                   Makati City, Brgy San Antonio 1200 Metro Manila<br>
                                   Philippines</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Phone</h3>
                                <p>+63 (02) 8123-4567<br>
                                   +63 917 123 4567</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Email</h3>
                                <p>vannavarez@gmail.com<br>
                                   </p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Business Hours</h3>
                                <p>Mon - Fri: 9:00 AM - 6:00 PM<br>
                                   Sat - Sun: 10:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="social-media">
                        <h3>Follow Us</h3>
                        <div class="social-links">
                            <a href="#" class="social-link">
                                <i class="fab fa-discord"></i>
                                <span>Discord</span>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-instagram"></i>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-twitch"></i>
                                <span>Twitch</span>
                            </a>
                        </div>
                    </div>
                </div>

                
                <div class="contact-form-wrapper">
                    <h2 class="section-title">Send us a Message</h2>
                    
                    <form class="contact-form" action="contact.php" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">
                                    <i class="fas fa-user"></i>
                                    First Name
                                </label>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">
                                    <i class="fas fa-user"></i>
                                    Last Name
                                </label>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">
                                    <i class="fas fa-phone"></i>
                                    Phone Number
                                </label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">
                                <i class="fas fa-tag"></i>
                                Subject
                            </label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="billing">Billing Question</option>
                                <option value="feedback">Feedback</option>
                                <option value="partnership">Partnership</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">
                                <i class="fas fa-comment-alt"></i>
                                Message
                            </label>
                            <textarea id="message" name="message" rows="6" required placeholder="Tell us how we can help you..."></textarea>
                        </div>

                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="newsletter" value="1">
                                <span class="checkmark"></span>
                                Subscribe to our newsletter for the latest skin updates
                            </label>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="faq-section">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-shield-alt"></i>
                            <h3>Is it safe to buy skins here?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, absolutely! We use secure payment methods and all transactions are encrypted. We never store your payment information.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-clock"></i>
                            <h3>How long does delivery take?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Digital items are delivered instantly to your account after purchase confirmation. Physical merchandise takes 5-7 business days.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-undo"></i>
                            <h3>What's your refund policy?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>We offer a 7-day refund policy for unused digital items. Physical merchandise can be returned within 30 days in original condition.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-headset"></i>
                            <h3>How can I get support?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>You can reach us through this contact form, email, phone, or join our Discord server for real-time support from our team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    <?php if (isset($_GET['status'])): ?>
        <div class="toast <?php echo $_GET['status'] === 'success' ? 'success' : 'error'; ?> show" id="toast">
            <i class="fas <?php echo $_GET['status'] === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
            <span><?php echo $_GET['status'] === 'success' ? 'Message sent successfully!' : 'Error sending message. Please try again.'; ?></span>
        </div>
    <?php endif; ?>

    <script>
        
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.parentElement;
                const isActive = faqItem.classList.contains('active');
                
                
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            });
        });

        
        const form = document.querySelector('.contact-form');
        const inputs = form.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.parentElement.classList.remove('focused');
                }
            });

            input.addEventListener('input', () => {
                if (input.value !== '') {
                    input.parentElement.classList.add('filled');
                } else {
                    input.parentElement.classList.remove('filled');
                }
            });
        });

        
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>