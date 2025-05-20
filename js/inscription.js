const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  togglePassword.addEventListener('click', () => {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
  });

  // Pour la confirmation
  const toggleConfirm = document.getElementById('toggleConfirm');
  const confirmInput = document.getElementById('confirm-password');

  toggleConfirm.addEventListener('click', () => {
    const type = confirmInput.type === 'password' ? 'text' : 'password';
    confirmInput.type = type;
    toggleConfirm.classList.toggle('fa-eye');
    toggleConfirm.classList.toggle('fa-eye-slash');
  });