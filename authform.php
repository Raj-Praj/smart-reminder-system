<div id="authOverlay" class="auth-overlay hidden">

    <div class="auth-modal">

        <span class="close-btn" onclick="closeAuth()">×</span>

        <div class="auth-toggle">
            <button id="loginBtn" class="active" onclick="showLogin()">Login Box</button>
            <button id="registerBtn" onclick="showRegister()">Register Box</button>
        </div>

        <!-- LOGIN -->
        <div id="loginForm">

            <h2>Login </h2>

            <form method="POST" action="auth.php">
               <div class="input-group">
                  <input type="email" name="email" required>
                  <label>Email</label>
               </div>
                <div class="input-group">
                     <input type="password" name="password" required>
                      <label>Password</label>
                </div>
                <button type="submit" name="login">Login</button>
            </form>

        </div>

        <!-- REGISTER -->
        <div id="registerForm" class="form-hidden">

            <h2>Register</h2>

            <form method="POST" action="auth.php">
                <div class="input-group">
                     <input type="text" name="name" required>
                       <label>Name</label>
                </div>
                <div class="input-group">
                      <input type="email" name="email" required>
                      <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" required>
                     <label>Password</label>
                </div>
                <button type="submit" name="register">Register</button>
            </form>

        </div>

    </div>

</div>

<script src="js/script.js"></script>