<?php
/**
 * Contact Page
 */

require_once __DIR__ . '/../includes/init.php';

$pageTitle = 'Contact Us - IMAGINITIATE Social Casino';
include __DIR__ . '/../includes/header.php';

$submitted = false;
$error = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message = sanitize($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'Please fill in all fields';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } else {
        // In a real application, you would send an email here
        // For now, we'll just log it
        $logMessage = "[" . date('Y-m-d H:i:s') . "] Contact Form Submission\n";
        $logMessage .= "Name: $name\n";
        $logMessage .= "Email: $email\n";
        $logMessage .= "Subject: $subject\n";
        $logMessage .= "Message: $message\n";
        $logMessage .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown') . "\n";
        $logMessage .= "---\n";

        error_log($logMessage, 3, __DIR__ . '/../logs/contact_form.log');
        $submitted = true;
    }
}
?>

<div class="container">
    <!-- Page Header -->
    <section class="hero" style="margin-bottom: 2rem;">
        <h1>📞 Contact Us</h1>
        <p>Have questions or feedback? We'd love to hear from you!</p>
    </section>

    <!-- Contact Information -->
    <section class="section">
        <h2>Get in Touch</h2>
        <div class="grid grid-3">
            <div class="card" style="text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">📧</div>
                <div class="card-title">Email</div>
                <p class="card-text">contact@imaginitiate.com</p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">📍</div>
                <div class="card-title">Address</div>
                <p class="card-text">
                    A-96 GROUND FLOOR<br>
                    SHANKAR GARDEN VIKASPURI<br>
                    NEW DELHI, Delhi 110018
                </p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🌐</div>
                <div class="card-title">Website</div>
                <p class="card-text">imaginitiate.com</p>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="section">
        <h2>Send us a Message</h2>
        
        <?php if ($submitted): ?>
            <div class="alert alert-success" style="margin-bottom: 2rem;">
                <strong>✓ Thank you for your message!</strong> We've received your inquiry and will get back to you as soon as possible.
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger" style="margin-bottom: 2rem;">
                <strong>✕ Error:</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-2">
            <!-- Contact Form -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;">Contact Form</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Your Name *</label>
                        <input type="text" id="name" name="name" required placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required placeholder="Enter your email">
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="bug">Report a Bug</option>
                            <option value="feedback">Feedback</option>
                            <option value="support">Technical Support</option>
                            <option value="partnership">Partnership</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" required placeholder="Enter your message..." rows="6"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                </form>
            </div>

            <!-- Information -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;">ℹ️ Information</h3>
                
                <div style="margin-bottom: 1.5rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">Response Time</h4>
                    <p style="color: var(--text-muted); margin: 0;">
                        We typically respond to inquiries within 24-48 hours during business days.
                    </p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">What We Can Help With</h4>
                    <ul style="color: var(--text-muted); margin-left: 1rem;">
                        <li>General questions about IMAGINITIATE</li>
                        <li>Technical issues or bugs</li>
                        <li>Feedback and suggestions</li>
                        <li>Account or session issues</li>
                        <li>Partnership inquiries</li>
                    </ul>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">Company Details</h4>
                    <p style="color: var(--text-muted); margin: 0;">
                        <strong>Company:</strong> IMAGINITIATE VENTURES PRIVATE LIMITED<br>
                        <strong>Brand:</strong> IMAGINITIATE<br>
                        <strong>Domain:</strong> imaginitiate.com
                    </p>
                </div>

                <div style="background: rgba(155, 89, 182, 0.2); padding: 1rem; border-radius: var(--border-radius); border-left: 5px solid var(--primary-gold);">
                    <p style="margin: 0; color: var(--text-muted);">
                        <strong>💡 Tip:</strong> For faster response, please include as much detail as possible about your inquiry.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section">
        <h2>❓ Frequently Asked Questions</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How long does it take to get a response?</strong>
            </div>
            <div class="accordion-content">
                <p>We aim to respond to all inquiries within 24-48 hours during business days. 
                For urgent matters, please mark your message as urgent.</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What information should I include in my message?</strong>
            </div>
            <div class="accordion-content">
                <p>Please include as much relevant information as possible, such as:</p>
                <ul style="color: var(--text-muted); margin-left: 1rem;">
                    <li>What you're contacting us about</li>
                    <li>When the issue occurred (if applicable)</li>
                    <li>Your browser and device type</li>
                    <li>Steps you've already taken</li>
                </ul>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Can I call you instead of emailing?</strong>
            </div>
            <div class="accordion-content">
                <p>Currently, we handle inquiries through our contact form and email. 
                Please use the contact form above or email us at contact@imaginitiate.com</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>I have a bug report. What should I include?</strong>
            </div>
            <div class="accordion-content">
                <p>For bug reports, please include:</p>
                <ul style="color: var(--text-muted); margin-left: 1rem;">
                    <li>Description of the bug</li>
                    <li>Steps to reproduce it</li>
                    <li>Browser and device type</li>
                    <li>Screenshots if possible</li>
                    <li>When it started happening</li>
                </ul>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Do you accept partnership inquiries?</strong>
            </div>
            <div class="accordion-content">
                <p>Yes! We're open to partnership opportunities. 
                Please send us a detailed inquiry about your proposal, and we'll review it.</p>
            </div>
        </div>
    </section>

    <!-- Social Media -->
    <section class="section" style="text-align: center; background: rgba(155, 89, 182, 0.1); border: 2px solid var(--primary-purple);">
        <h2>🌐 Follow Us</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">
            Stay updated with the latest news and updates from IMAGINITIATE.
        </p>
        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="#" class="btn btn-primary">Facebook</a>
            <a href="#" class="btn btn-primary">Twitter</a>
            <a href="#" class="btn btn-primary">Instagram</a>
            <a href="#" class="btn btn-primary">LinkedIn</a>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="text-align: center; background: linear-gradient(135deg, var(--primary-purple), var(--primary-gold));">
        <h2 style="color: var(--dark-bg);">Ready to Play?</h2>
        <p style="color: var(--dark-bg); font-size: 1.2rem;">Start your gaming adventure with 1000 free coins!</p>
        <a href="/imaginitiate-casino/public/games.php" class="btn btn-primary btn-lg" style="margin-top: 1rem;">🎮 Play Now</a>
    </section>
</div>

<!-- Accordion Styles -->
<style>
    .accordion {
        background: rgba(22, 33, 62, 0.7);
        border: 1px solid var(--primary-purple);
        border-radius: var(--border-radius);
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .accordion-header {
        padding: 1.5rem;
        cursor: pointer;
        background: rgba(22, 33, 62, 0.7);
        border-bottom: 1px solid var(--primary-purple);
        transition: var(--transition);
        user-select: none;
    }

    .accordion-header:hover {
        background: rgba(155, 89, 182, 0.2);
    }

    .accordion-content {
        display: none;
        padding: 1.5rem;
        background: rgba(26, 26, 46, 0.5);
    }

    .accordion.active .accordion-content {
        display: block;
    }

    .accordion-header::after {
        content: " ▼";
        float: right;
        transition: var(--transition);
    }

    .accordion.active .accordion-header::after {
        transform: rotate(180deg);
    }
</style>

<?php include __DIR__ . '/../includes/footer.php'; ?>
