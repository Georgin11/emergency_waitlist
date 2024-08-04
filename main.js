document.addEventListener('DOMContentLoaded', () => {
    const adminLoginForm = document.getElementById('adminLoginForm');
    const patientSignInForm = document.getElementById('patientSignInForm');
    const waitTimeDisplay = document.getElementById('waitTimeDisplay');
    const adminPanel = document.getElementById('adminPanel');
    const patientQueue = document.getElementById('patientQueue');
    const adminLoginSection = document.getElementById('adminLoginSection');
    const patientSignInSection = document.getElementById('patientSignInSection');
    const patientViewBtn = document.getElementById('patientViewBtn');
    const adminViewBtn = document.getElementById('adminViewBtn');

    // Show patient sign-in by default
    patientSignInSection.style.display = 'block';
    adminLoginSection.style.display = 'none';
    adminPanel.style.display = 'none';

    // Toggle views
    patientViewBtn.addEventListener('click', () => {
        patientSignInSection.style.display = 'block';
        adminLoginSection.style.display = 'none';
        adminPanel.style.display = 'none';
    });

    adminViewBtn.addEventListener('click', () => {
        patientSignInSection.style.display = 'none';
        adminLoginSection.style.display = 'block';
        adminPanel.style.display = 'none';
    });

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
            alert('Login successful!');
            adminPanel.style.display = 'block';
            adminLoginSection.style.display = 'none';
            updatePatientQueue();
        } else {
            alert('Invalid login credentials.');
        }
    });

    patientSignInForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const name = document.getElementById('patientName').value;
        const code = document.getElementById('patientCode').value;
        const severity = document.getElementById('injurySeverity').value;

        const response = await fetch('patient.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, code, severity })
        });

        const result = await response.json();
        if (result.success) {
            waitTimeDisplay.innerText = `Approximate wait time: ${result.waitTime} minutes`;
            updatePatientQueue();
        } else {
            alert('Error signing in. Please try again.');
        }
    });

    async function updatePatientQueue() {
        const response = await fetch('getPatients.php');
        const patients = await response.json();

        patientQueue.innerHTML = '';
        patients.forEach((patient) => {
            const li = document.createElement('li');
            li.textContent = `${patient.name} (${patient.code}): Severity ${patient.severity}, Wait Time: ${patient.wait_time} mins`;
            patientQueue.appendChild(li);
        });
    }
});
