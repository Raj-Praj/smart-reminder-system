function openAuth(type) {
    const overlay = document.getElementById("authOverlay");

    if (!overlay) return;

    overlay.classList.remove("hidden");

    if (type === "register") {
        showRegister();
    } else {
        showLogin();
    }
}

function closeAuth() {
    document.getElementById("authOverlay").classList.add("hidden");
}

function showLogin() {
    document.getElementById("loginForm").classList.remove("form-hidden");
    document.getElementById("registerForm").classList.add("form-hidden");

    document.getElementById("loginBtn").classList.add("active");
    document.getElementById("registerBtn").classList.remove("active");
}

function showRegister() {
    document.getElementById("loginForm").classList.add("form-hidden");
    document.getElementById("registerForm").classList.remove("form-hidden");

    document.getElementById("registerBtn").classList.add("active");
    document.getElementById("loginBtn").classList.remove("active");
}