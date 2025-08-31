<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISETKR Family - Register</title>
    <style>
        /* 👇 Copie exacte du style de la page login */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #c4e9ec 0%, #2d3480 100%);
            position: relative;
        }

        .bg-shapes {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            filter: blur(1px);
        }

        .shape-1 { width: 280px; height: 280px; background: radial-gradient(circle, rgba(45, 52, 128, 0.2), rgba(196, 233, 236, 0.1)); top: 5%; left: 8%; animation: float 8s infinite ease-in-out; }
        .shape-2 { width: 180px; height: 180px; background: radial-gradient(circle, rgba(196, 233, 236, 0.3), rgba(45, 52, 128, 0.1)); top: 55%; left: 15%; animation: float 10s infinite reverse ease-in-out; }
        .shape-3 { width: 120px; height: 120px; background: radial-gradient(circle, rgba(45, 52, 128, 0.15), transparent 70%); top: 15%; right: 12%; animation: float 9s infinite ease-in-out; }
        .shape-4 { width: 350px; height: 350px; background: radial-gradient(circle, rgba(196, 233, 236, 0.1), transparent 70%); bottom: -80px; right: -80px; animation: float 12s infinite ease-in-out; }
        .shape-5 { width: 200px; height: 200px; background: radial-gradient(circle, rgba(45, 52, 128, 0.08), transparent 70%); top: 40%; right: 25%; animation: float 7s infinite reverse ease-in-out; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0) scale(1); }
            33% { transform: translateY(-15px) rotate(120deg) scale(1.05); }
            66% { transform: translateY(10px) rotate(240deg) scale(0.95); }
        }

        .main-container {
            display: flex;
            height: 100vh;
            z-index: 2;
            max-width: 1600px;
            margin: auto;
            padding: 0 2rem;
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
            background: linear-gradient(90deg, #2d3480, rgba(255,255,255,0.8));
            margin: 32px 0;
            border-radius: 3px;
        }

        .welcome-content p {
            font-size: 18px;
            line-height: 1.7;
            max-width: 450px;
            color: #2d3480;
        }

        .right-panel {
            flex: 0 0 480px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 24px;
            padding: 60px 50px;
            margin: 40px 0;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            animation: slideInRight 1.2s ease;
        }

        .login-form {
            width: 100%;
        }

        .form-title {
            color: white;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 28px;
            text-align: center;
            color: #2d3480;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            color: rgba(255,255,255,0.95);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: 18px 24px;
            background: rgba(255,255,255,0.08);
            border: 1.5px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            color: #2d3480;
            font-size: 16px;
            backdrop-filter: blur(10px);
        }

        .form-input:focus {
            outline: none;
            background: rgba(255,255,255,0.15);
            border-color: #2d3480;
            box-shadow: 0 0 0 4px rgba(45,52,128,0.15);
        }

        .error-message {
            color: #ff6b6b;
            background: rgba(255,107,107,0.1);
            padding: 8px 12px;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 13px;
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
            margin-bottom: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(45,52,128,0.4);
        }

        .footer-text {
            text-align: center;
            color: rgba(255,255,255,0.85);
            font-size: 15px;
        }

        .footer-text a {
            color: white;
            font-weight: 600;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-60px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(60px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @media (max-width: 768px) {
            .main-container { flex-direction: column; }
            .right-panel { margin: 0 20px; }
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
        <div class="left-panel">
            <div class="logo" style="color: #2d3480;">ISETKR Family</div>
            <div class="welcome-content">
                <h1>Join Us!</h1>
                <div class="divider"></div>
                <p>Create an account to stay connected with your ISET clubs and receive the latest updates.</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="login-form">
                <h2 class="form-title">Create Account</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input id="nom" class="form-input" type="text" name="nom" value="{{ old('nom') }}" required autofocus>
                        @error('nom') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                      <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input id="prenom" class="form-input" type="text" name="prenom" value="{{ old('prenom') }}" required autofocus>
                        @error('prenom') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required>
                        @error('email') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-input" type="password" name="password" required>
                        @error('password') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required>
                        @error('password_confirmation') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="submit-btn">Register</button>
                </form>

                <div class="footer-text">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
