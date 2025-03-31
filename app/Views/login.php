<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iColab - Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-section h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .logo-section span {
            color: #3b82f6;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4b5563;
            font-size: 0.9rem;
        }

        .input-field {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        .password-container {
            position: relative;
        }

        .show-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
        }

        .submit-btn {
            width: 100%;
            padding: 0.8rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .submit-btn:hover {
            background: #2563eb;
        }

        .additional-links {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .additional-links a {
            color: #3b82f6;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .additional-links a:hover {
            opacity: 0.8;
        }

        .separator {
            margin: 1.5rem 0;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .separator::before,
        .separator::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <h1><span>i</span>Colab</h1>
            <p style="color: #6b7280; margin-top: 0.5rem;">Collaboration intelligente</p>
        </div>

        <form action="<?= base_url('validate_login') ?>" method="post" id="loginForm">
            <div class="form-group">
                <label class="input-label" for="email">Email</label>
                <input type="email"
                    name="email"
                    id="email"
                    class="input-field"
                    placeholder="user@icolab.com"
                    required>
            </div>

            <div class="form-group">
                <label class="input-label" for="password">Mot de passe</label>
                <div class="password-container">
                    <input type="password"
                        id="password"
                        class="input-field"
                        placeholder="••••••••"
                        name="password"
                        required>
                    <i class="fas fa-eye show-password" onclick="togglePassword()"></i>
                </div>
            </div>

            <button type="submit" class="submit-btn">Se connecter</button>
        </form>

        <div class="additional-links">
            <a href="#">Mot de passe oublié ?</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.querySelector('.show-password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>

</html>