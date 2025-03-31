<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iColab - Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="<?= base_url('assets/images/LOGO-ICOLAB.png') ?>" alt="" class="logo-i-colab">

            <!-- <h1><span>i</span>Colab</h1> -->
            <!-- <p style="color: #6b7280; margin-top: 0.5rem;">Collaboration intelligente</p> -->
        </div>

        <form action="<?= base_url('validate_login') ?>" method="post" id="loginForm">
            <div class="form-group">
                <label class="input-label" for="email">Email</label>
                <input type="email"
                    name="email"
                    id="email"
                    class="input-field"
                    placeholder="user@icolab.com" value="marie.dupont@example.fr"
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
                        value="marie2023"
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