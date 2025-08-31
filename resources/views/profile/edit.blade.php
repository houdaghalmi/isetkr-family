<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - ISETKR Family</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #fafbfc;
            color: #374151;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Header Section */
        .header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .header-content {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            letter-spacing: -0.025em;
        }

        /* Main Content */
        .main-content {
            padding: 3rem 0;
        }

        .container {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #f3f4f6;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: #e5e7eb;
        }

        .card-content {
            padding: 2rem;
            max-width: 36rem;
        }

        /* Form Sections */
        .section-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
            letter-spacing: -0.025em;
        }

        .section-description {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            letter-spacing: 0.025em;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: white;
            color: #374151;
        }

        .form-input:focus {
            outline: none;
            border-color: #2d3480;
            box-shadow: 0 0 0 3px rgba(45, 52, 128, 0.1);
        }

        .form-input:hover {
            border-color: #9ca3af;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.025em;
        }

        .btn-primary {
            background: #2d3480;
            color: white;
        }

        .btn-primary:hover {
            background: #1e2563;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(45, 52, 128, 0.25);
        }

        .btn-secondary {
            background: #f9fafb;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f3f4f6;
        }

        /* Status Messages */
        .status-message {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .status-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .status-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Special Sections */
        .profile-section {
            position: relative;
        }

        .profile-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #c4e9ec, #2d3480);
            border-radius: 0 2px 2px 0;
        }

        .password-section {
            position: relative;
        }

        .password-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #c4e9ec;
            border-radius: 0 2px 2px 0;
        }

        .danger-section {
            position: relative;
            border-color: #fee2e2;
        }

        .danger-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #dc2626;
            border-radius: 0 2px 2px 0;
        }

        .danger-section .section-title {
            color: #dc2626;
        }

        /* Email Verification Notice */
        .verification-notice {
            background: #fffbeb;
            border: 1px solid #fed7aa;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .verification-notice p {
            font-size: 0.875rem;
            color: #92400e;
            margin-bottom: 0.5rem;
        }

        .verification-link {
            color: #2d3480;
            text-decoration: none;
            font-weight: 500;
        }

        .verification-link:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .header-content,
            .container {
                padding: 0 1rem;
            }

            .card-content {
                padding: 1.5rem;
            }

            .main-content {
                padding: 2rem 0;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Loading States */
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .btn.loading {
            position: relative;
            color: transparent;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Focus Indicators */
        .form-input:focus,
        .btn:focus {
            outline: 2px solid #2d3480;
            outline-offset: 2px;
        }

        /* Subtle Animations */
        .card {
            animation: fadeInUp 0.5s ease-out;
        }

        .card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .card:nth-child(3) {
            animation-delay: 0.2s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <div class="header-content">
            <h2>Edit Profile</h2>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            
            <!-- Profile Information Section -->
            <div class="card profile-section">
                <div class="card-content">
                    <div class="section-header">
                        <h3 class="section-title">Profile Information</h3>
                        <p class="section-description">Update your account's profile information and email address.</p>
                    </div>

                    <!-- Email Verification Notice (if needed) -->
                    <div class="verification-notice" style="display: none;" id="verification-notice">
                        <p>Your email address is unverified.</p>
                        <a href="#" class="verification-link">Click here to re-send the verification email.</a>
                    </div>

                    <form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="nom" class="form-label">Name</label>
                            <input type="text" id="nom" name="nom" class="form-input" value="{{ old('nom', $user->nom ?? $user->name ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="prenom" class="form-label">Prenom</label>
                            <input type="text" id="prenom" name="prenom" class="form-input" value="{{ old('prenom', $user->prenom ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="numero" class="form-label">Numero</label>
                            <input type="text" id="numero" name="numero" class="form-input" value="{{ old('numero', $user->numero ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="form-label">Avatar</label>
                            @if ($user->avatar)
                                <div style="margin-bottom: 0.5rem;">
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="max-width: 80px; max-height: 80px; border-radius: 50%;">
                                </div>
                            @endif
                            <input type="file" id="avatar" name="avatar" class="form-input" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email ?? '') }}" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <div class="status-message status-success" style="display: none;" id="profile-success">
                                Profile updated successfully.
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="card password-section">
                <div class="card-content">
                    <div class="section-header">
                        <h3 class="section-title">Update Password</h3>
                        <p class="section-description">Ensure your account is using a long, random password to stay secure.</p>
                    </div>

                    <form id="password-form">
                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" id="current_password" name="current_password" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" name="password" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                            <div class="status-message status-success" style="display: none;" id="password-success">
                                Password updated successfully.
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="card danger-section">
                <div class="card-content">
                    <div class="section-header">
                        <h3 class="section-title">Delete Account</h3>
                        <p class="section-description">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                    </div>

                    <form id="delete-form">
                        <div class="form-group">
                            <label for="delete_password" class="form-label">Password</label>
                            <input type="password" id="delete_password" name="password" class="form-input" placeholder="Enter your password to confirm deletion" required>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete Account</button>
                            <button type="button" class="btn btn-secondary" onclick="cancelDelete()" style="display: none;" id="cancel-delete">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Password Form Handler
        document.getElementById('password-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button[type="submit"]');
            const successMsg = document.getElementById('password-success');
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            // Validate password match
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }
            
            // Add loading state
            btn.classList.add('loading');
            btn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.disabled = false;
                successMsg.style.display = 'block';
                
                // Clear form
                this.reset();
                
                // Hide success message after 3 seconds
                setTimeout(() => {
                    successMsg.style.display = 'none';
                }, 3000);
            }, 1000);
        });

        // Delete Account Confirmation
        function confirmDelete() {
            const password = document.getElementById('delete_password').value;
            
            if (!password) {
                alert('Please enter your password to confirm deletion');
                return;
            }
            
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                const btn = document.querySelector('.btn-danger');
                btn.classList.add('loading');
                btn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    alert('Account deletion process initiated. You will receive a confirmation email.');
                    btn.classList.remove('loading');
                    btn.disabled = false;
                    document.getElementById('delete_password').value = '';
                }, 1500);
            }
        }

        function cancelDelete() {
            document.getElementById('delete_password').value = '';
            document.getElementById('cancel-delete').style.display = 'none';
        }

        // Enhanced form interactions
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-1px)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Email verification toggle (for demo)
        document.getElementById('email').addEventListener('change', function() {
            const notice = document.getElementById('verification-notice');
            // Show verification notice if email is changed (demo purpose)
            if (this.value !== 'john@example.com') {
                notice.style.display = 'block';
            } else {
                notice.style.display = 'none';
            }
        });

        // Smooth scroll for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>