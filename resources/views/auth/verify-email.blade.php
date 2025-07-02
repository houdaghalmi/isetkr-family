<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ISETLink - Email Verification</title>
    <style>
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
            color: #2d3480;
        }

        .welcome-content h1 {
            font-size: 44px;
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
            max-width: 480px;
        }

        .right-panel {
            flex: 0 0 480px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 24px;
            padding: 60px 50px;
            margin: 40px 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            animation: slideInRight 1.2s ease;
            color: white;
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            text-align: center;
        }

        .status-msg {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid #2ecc71;
            color: #2ecc71;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .btn {
            padding: 14px 22px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2d3480, #c4e9ec);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(45, 52, 128, 0.3);
        }

        .btn-logout {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.08);
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
            <div class="logo">ISETLink</div>
            <div class="welcome-content">
                <h1>Email Verification</h1>
                <div class="divider"></div>
                <p>Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
                <p>If you didn't receive the email, we will gladly send you another.</p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <div class="form-title">Verify Your Email</div>

            @if (session('status') == 'verification-link-sent')
                <div class="status-msg">
                    A new verification link has been sent to your email.
                </div>
            @endif

            <div class="action-row">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Resend Verification Email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
