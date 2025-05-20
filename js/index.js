const toggleConnexion = document.getElementById('toggleConnexion');
        const mdpInput = document.getElementById('mdp');

        toggleConnexion.addEventListener('click', () => {
            const type = mdpInput.type === 'password' ? 'text' : 'password';
            mdpInput.type = type;
            toggleConnexion.classList.toggle('fa-eye');
            toggleConnexion.classList.toggle('fa-eye-slash');
        });