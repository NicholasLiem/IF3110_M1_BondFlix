async function submitRegister(e) {
    e.preventDefault();

    const username = document.getElementById('input-username').value;
    const first_name = document.getElementById('input-first-name').value;
    const last_name = document.getElementById('input-last-name').value;
    const password = document.getElementById('input-password').value;
    const password_confirmation = document.getElementById('input-password-confirmation').value;

    if (password !== password_confirmation) {
        alert("Password do not match!")
        return;
    }

    const data = {
        username,
        first_name,
        last_name,
        password,
        password_confirmation
    };

    try {
        const httpClient = new HttpClient();
        const response = await httpClient.post('/api/auth/register', data, false);
        const json = JSON.parse(response);
        if (json.success) {
            alert("Registration successful!");
            window.location.href = "/login";
        } else {
            alert("Registration failed: " + json.message);
        }
    } catch (error) {
        console.error("An error occurred:", error);
        alert("An error occurred while processing your request.");
    }
}
