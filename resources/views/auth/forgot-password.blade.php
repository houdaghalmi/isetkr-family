<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ISETKR Family - Forgot Password</title>
  <style>
    /* Réutilisation des styles de login/register */
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Inter', sans-serif;
        height: 100vh;
        overflow: hidden;
        background: linear-gradient(135deg, #c4e9ec 0%, #2d3480 100%);
        position: relative;
    }

    .bg-shapes {
        position: absolute; top: 0; left: 0;
        width: 100%; height: 100%;
        overflow: hidden; z-index: 1;
    }

    .shape {
        position: absolute; border-radius: 50%;
        opacity: 0.15; filter: blur(1px);
    }

    .shape-1 { width: 280px; height: 280px; background: radial-gradient(circle, rgba(45, 52, 128, 0.2), rgba(196, 233, 236, 0.1)); top: 5%; left: 8%; animation: float 8s ease-in-out infinite; }
    .shape-2 { width: 180px; height: 180px; background: radial-gradient(circle, rgba(196, 233, 236, 0.3), rgba(45, 52, 128, 0.1)); top: 55%; left: 15%; animation: float 10s ease-in-out infinite reverse; }
    .shape-3 { width: 120px; height: 120px; background: radial-gradient(circle, rgba(45, 52, 128, 0.15), transparent 70%); top: 15%; right: 12%; animation: float 9s ease-in-out infinite; }
    .shape-4 { width: 350px; height: 350px; background: radial-gradient(circle, rgba(196, 233, 236, 0.1), transparent 70%); bottom: -80px; right: -80px; animation: float 12s ease-in-out infinite; }
    .shape-5 { width: 200px; height: 200px; background: radial-gradient(circle, rgba(45, 52, 128, 0.08), transparent 70%); top: 40%; right: 25%; animation: float 7s ease-in-out infinite reverse; }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        33% { transform: translateY(-15px) rotate(120deg) scale(1.05); }
        66% { transform: translateY(10px) rotate(240deg) scale(0.95); }
    }

    .main-container {
        display: flex;
        height: 100vh;
        max-width: 1400px;
        margin: auto;
        padding: 0 2rem;
        z-index: 2;
        position: relative;
    }

    .left-panel {
        flex: 1.2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 80px 60px;
        color: white;
        animation: slideInLeft 1.2s ease;
    }

    .logo {
        position: absolute;
        top: 50px;
        left: 60px;
        font-size: 28px;
        font-weight: 800;
        color: white;
    }

    .welcome-content h1 {
        font-size: 56px;
        font-weight: 800;
        margin-bottom: 24px;
        color: #2d3480;
    }

    .divider {
        width: 80px;
        height: 5px;
        background: linear-gradient(90deg, #2d3480, rgba(255, 255, 255, 0.8));
        margin: 32px 0;
        border-radius: 3px;
    }

    .welcome-content p {
        font-size: 18px;
        line-height: 1.7;
        color: #2d3480;
        max-width: 450px;
    }

    .right-panel {
        flex: 0 0 480px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 24px;
        padding: 60px 50px;
        margin: 120px 0;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        animation: slideInRight 1.2s ease;
    }

    .form-title {
        color: white;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 24px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 28px;
    }

    .form-group label {
        display: block;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 18px 24px;
        background: rgba(255, 255, 255, 0.08);
        border: 1.5px solid rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        color: #2d3480;
        font-size: 16px;
        backdrop-filter: blur(10px);
    }

    .form-input:focus {
        outline: none;
        border-color: #2d3480;
        background: rgba(255, 255, 255, 0.15);
    }

    .error-message {
        color: #ff6b6b;
        font-size: 13px;
        margin-top: 6px;
    }

    .submit-btn {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #2d3480, #c4e9ec);
        color: white;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(45, 52, 128, 0.4);
    }

    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-60px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(60px); }
        to { opacity: 1; transform: translateX(0); }
    }
  </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>

    <div class="main-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="logo" style="color: #2d3480;">ISETKR Family</div>
            <div class="welcome-content">
                <h1>Reset Password</h1>
                <div class="divider"></div>
                <p>Enter your email address and we'll send you a link to reset your password.</p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <div class="form-title" style="color: #2d3480;">Forgot Password</div>

            @if (session('status'))
                <div class="status-message" style="color: #4caf50; text-align:center; margin-bottom: 16px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="submit-btn">Send Reset Link</button>
            </form>
        </div>
    </div>
</body>
</html>
