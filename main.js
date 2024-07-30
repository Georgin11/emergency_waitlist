document.addEventListener('DOMContentLoaded', () => {
    const adminLoginForm = document.getElementById('adminLoginForm');
    const patientSignInForm = document.getElementById('patientSignInForm');
    const waitTimeDisplay = document.getElementById('waitTimeDisplay');

    adminLoginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const username = document.getElementById('adminUsername').value;
        const password = document.getElementById('adminPassword').value;

        const response = await fetch('auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password })
        });

        const result = await response.json();
        if (result.success) {
            window.location.href = 'admin.html';
        } else {
            alert('Login failed');
        }
    });

    patientSignInForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const name = document.getElementById('patientName').value;
        const code = document.getElementById('patientCode').value;

        const response = await fetch('patient.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, code })
        });

        const result = await response.json();
        if (result.success) {
            waitTimeDisplay.innerText = `Approximate wait time: ${result.waitTime} minutes`;
        } else {
            alert('Sign-In failed');
        }
    });
});
