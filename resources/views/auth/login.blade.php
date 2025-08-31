<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISETKR Family - Login</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        height: 100vh;
        overflow: hidden;
        background: linear-gradient(135deg, #c4e9ec 0%, #2d3480 100%);
        position: relative;
    }

    .bg-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.15;
        filter: blur(1px);
    }

    .shape-1 {
        width: 280px;
        height: 280px;
        background: radial-gradient(circle, rgba(45, 52, 128, 0.2) 0%, rgba(196, 233, 236, 0.1) 100%);
        top: 5%;
        left: 8%;
        animation: float 8s ease-in-out infinite;
    }

    .shape-2 {
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(196, 233, 236, 0.3) 0%, rgba(45, 52, 128, 0.1) 100%);
        top: 55%;
        left: 15%;
        animation: float 10s ease-in-out infinite reverse;
    }

    .shape-3 {
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, rgba(45, 52, 128, 0.15) 0%, transparent 70%);
        top: 15%;
        right: 12%;
        animation: float 9s ease-in-out infinite;
    }

    .shape-4 {
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(196, 233, 236, 0.1) 0%, transparent 70%);
        bottom: -80px;
        right: -80px;
        animation: float 12s ease-in-out infinite;
    }

    .shape-5 {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(45, 52, 128, 0.08) 0%, transparent 70%);
        top: 40%;
        right: 25%;
        animation: float 7s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        33% { transform: translateY(-15px) rotate(120deg) scale(1.05); }
        66% { transform: translateY(10px) rotate(240deg) scale(0.95); }
    }

    .main-container {
        display: flex;
        height: 100vh;
        position: relative;
        z-index: 2;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .left-panel {
        flex: 1.2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px 60px;
        color: white;
        position: relative;
        animation: slideInLeft 1.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .logo {
        position: absolute;
        top: 50px;
        left: 60px;
        font-size: 28px;
        font-weight: 800;
        color: white;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .welcome-content h1 {
        font-size: 56px;
        font-weight: 800;
        margin-bottom: 24px;
        line-height: 1.1;
        letter-spacing: -1px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .divider {
        width: 80px;
        height: 5px;
        background: linear-gradient(90deg, #2d3480, rgba(255, 255, 255, 0.8));
        margin: 32px 0;
        border-radius: 3px;
        box-shadow: 0 2px 10px rgba(45, 52, 128, 0.3);
    }

    .welcome-content p {
        font-size: 18px;
        line-height: 1.7;
        opacity: 0.95;
        margin-bottom: 48px;
        max-width: 450px;
        font-weight: 400;
    }

    .learn-more-btn {
        background: linear-gradient(135deg, #2d3480, #c4e9ec);
        color: white;
        border: none;
        padding: 18px 36px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        box-shadow: 0 8px 32px rgba(45, 52, 128, 0.3);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .learn-more-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .learn-more-btn:hover::before {
        left: 100%;
    }

    .learn-more-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(45, 52, 128, 0.4);
    }

    .right-panel {
        flex: 0 0 480px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 60px 50px;
        position: relative;
        margin: 40px 0;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        animation: slideInRight 1.2s ease;
    }

    .right-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .login-form {
        width: 100%;
    }

    .form-title {
        color: white;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 48px;
        text-align: center;
        letter-spacing: -0.5px;
        color: #2d3480;
    }

    .form-group {
        margin-bottom: 28px;
        position: relative;
    }

    .form-group label {
        display: block;
        color: rgba(255, 255, 255, 0.95);
        font-weight: 500;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .form-input {
        width: 100%;
        padding: 18px 24px;
        background: rgba(255, 255, 255, 0.08);
        border: 1.5px solid rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        color: white;
        font-size: 16px;
        backdrop-filter: blur(10px);
        font-weight: 400;
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .form-input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.15);
        border-color: #2d3480;
        box-shadow: 0 0 0 4px rgba(45, 52, 128, 0.15);
        transform: translateY(-1px);
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 32px 0;
        font-size: 14px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
    }

    .remember-me input {
        margin-right: 10px;
        accent-color: #2d3480;
    }

    .forgot-password a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-weight: 500;
        position: relative;
    }

    .forgot-password a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background: #2d3480;
        transition: width 0.3s ease;
    }

    .forgot-password a:hover::after {
        width: 100%;
    }

    .submit-btn {
        width: 100%;
        padding: 20px;
        background: linear-gradient(135deg, #2d3480, #c4e9ec);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.4s ease;
        margin-bottom: 36px;
        box-shadow: 0 8px 32px rgba(45, 52, 128, 0.3);
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .submit-btn:hover::before {
        left: 100%;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(45, 52, 128, 0.4);
    }

    .submit-btn.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .social-login {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 24px;
    }

    .social-btn {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
        border-color: #2d3480;
        box-shadow: 0 8px 25px rgba(45, 52, 128, 0.2);
    }

    .footer-text {
        text-align: center;
        margin-top: 24px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 15px;
    }

    .footer-text a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        position: relative;
    }

    .footer-text a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background: #2d3480;
        transition: width 0.3s ease;
    }

    .footer-text a:hover::after {
        width: 100%;
    }

    .error-message {
        color: #ff6b6b;
        background: rgba(255, 107, 107, 0.1);
        padding: 8px 12px;
        border-radius: 8px;
        margin-top: 8px;
        border-left: 3px solid #ff6b6b;
        font-size: 13px;
        backdrop-filter: blur(10px);
    }

    .status-message {
        background: rgba(76, 175, 80, 0.15);
        border: 1px solid rgba(76, 175, 80, 0.3);
        color: #4caf50;
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 28px;
        font-size: 14px;
        text-align: center;
        backdrop-filter: blur(10px);
        font-weight: 500;
    }

    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-60px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(60px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    @media (max-width: 1024px) {
        .main-container {
            padding: 0 1rem;
        }
        .right-panel {
            flex: 0 0 420px;
        }
    }

    @media (max-width: 768px) {
        .main-container {
            flex-direction: column;
            padding: 0;
        }
        .left-panel {
            padding: 60px 40px 40px;
            text-align: center;
        }
        .logo {
            position: relative;
            top: auto;
            left: auto;
            margin-bottom: 30px;
        }
        .welcome-content h1 {
            font-size: 42px;
        }
        .right-panel {
            padding: 40px 30px;
            margin: 0 20px 20px;
            border-radius: 24px 24px 0 0;
        }
    }

    @media (max-width: 480px) {
        .welcome-content h1 {
            font-size: 36px;
        }
        .right-panel {
            margin: 0;
            border-radius: 0;
            padding: 40px 24px;
        }
    }
</style>

</head>

<body>
    <!-- Enhanced background shapes -->
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>

    <div class="main-container">
        <!-- Left Panel -->
        <div class="left-panel" style="color: #c4e9ec;">
            <div class="logo" style="color: #2d3480;">ISETKR Family</div>
            
            <div class="welcome-content">
                <h1 style="color: #2d3480;">Welcome back!</h1>
                <div class="divider"></div>
                <p style="color: #2d3480;">We're glad to see you again! Explore what's new, reconnect with your clubs .</p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="right-panel">
            <div class="login-form">
                <h2 class="form-title">Sign in</h2>
                
                <!-- Session Status -->
                <div id="status-message" class="status-message" style="display: none;">
                    Login successful! Redirecting...
                </div>

                <form method="POST" action="/login">
                    @csrf
                    
                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                            id="email" 
                            class="form-input" 
                            type="email" 
                            name="email" 
                            placeholder="you@example.com"
                            required 
                            autofocus 
                            autocomplete="email" 
                            style="color: #2d3480;"
                        >
                        <div class="error-message" id="email-error" style="display: none;"></div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input 
                            id="password" 
                            class="form-input"
                            type="password"
                            name="password"
                            placeholder="••••••••••"
                            required 
                            autocomplete="current-password" style="color: #2d3480;"
                        >
                        <div class="error-message" id="password-error" style="display: none;"></div>
                    </div>

                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input id="remember_me" type="checkbox" name="remember">
                            <label for="remember_me">Remember me</label>
                        </div>
                        <div class="forgot-password">
                            <a href="/forgot-password">Forgot password?</a>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn" id="submit-btn">
                        <span>Sign In</span>
                    </button>
                </form>

            

                <div class="footer-text">
                    Don't have an account? <a href="/register">Create account</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form validation and interaction
        const form = document.querySelector('form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const statusMessage = document.getElementById('status-message');
        const submitBtn = document.getElementById('submit-btn');

        // Real-time validation with enhanced UX
        emailInput.addEventListener('blur', validateEmail);
        emailInput.addEventListener('input', clearEmailError);
        passwordInput.addEventListener('blur', validatePassword);
        passwordInput.addEventListener('input', clearPasswordError);

        function validateEmail() {
            const email = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!email) {
                showError(emailError, 'Email is required');
                return false;
            } else if (!emailRegex.test(email)) {
                showError(emailError, 'Please enter a valid email address');
                return false;
            } else {
                hideError(emailError);
                return true;
            }
        }

        function validatePassword() {
            const password = passwordInput.value;
            
            if (!password) {
                showError(passwordError, 'Password is required');
                return false;
            } else if (password.length < 6) {
                showError(passwordError, 'Password must be at least 6 characters');
                return false;
            } else {
                hideError(passwordError);
                return true;
            }
        }

        function clearEmailError() {
            if (emailError.style.display !== 'none') {
                hideError(emailError);
            }
        }

        function clearPasswordError() {
            if (passwordError.style.display !== 'none') {
                hideError(passwordError);
            }
        }

        function showError(element, message) {
            element.textContent = message;
            element.style.display = 'block';
            element.parentElement.querySelector('.form-input').style.borderColor = '#ff6b6b';
        }

        function hideError(element) {
            element.style.display = 'none';
            element.parentElement.querySelector('.form-input').style.borderColor = 'rgba(255, 255, 255, 0.15)';
        }

        // Enhanced form submission with loading state
        form.addEventListener('submit', function(e) {
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            
            if (!isEmailValid || !isPasswordValid) {
                e.preventDefault();
            }
        });

        // Enhanced input interactions with micro-animations
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
                this.parentElement.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Enhanced social button interactions
        document.querySelectorAll('.social-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.transform = 'translateY(-2px) scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px) scale(1)';
                }, 150);
            });
        });

        // Enhanced learn more button interaction
        document.querySelector('.learn-more-btn').addEventListener('click', function(e) {
            e.preventDefault();
            this.style.transform = 'translateY(-3px) scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'translateY(-3px) scale(1)';
            }, 150);
        });

        // Add subtle parallax effect to background shapes
        document.addEventListener('mousemove', function(e) {
            const shapes = document.querySelectorAll('.shape');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.5;
                const xPos = (x - 0.5) * speed;
                const yPos = (y - 0.5) * speed;
                shape.style.transform += ` translate(${xPos}px, ${yPos}px)`;
            });
        });
    </script>
</body>
</html>