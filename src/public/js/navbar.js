const accountButton = document.querySelector(".account-button");
const accountMenu = document.querySelector(".account-menu");
const profilePicture = document.getElementById('profile-picture-navbar')

accountButton.addEventListener("click", () => {
    if (accountMenu.style.display === "block") {
        accountMenu.style.display = "none";
    } else {
        accountMenu.style.display = "block";
    }
});

async function logout() {
    try {
        const httpClient = new HttpClient();
        const response = await httpClient.post("/api/auth/logout", null, false);
        const json = JSON.parse(response.body);
        if (json.success) {
            document.cookie =
                "PHPSESSID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = "/";
        } else {
        }
    } catch (error) {
        console.error("An error occurred:", error);
        alert("An error occurred while processing your request.");
    }
}

async function fetchAndSetProfilePicture() {
    try {
        const httpClient = new HttpClient();
        const response = await httpClient.get('/api/avatar/user', null, false);
        const json = JSON.parse(response.body);
        if (json.success && json.data !== '' && json.data !== null) {
            profilePicture.src = '/uploads/avatars/' + json.data;
        } else {
            profilePicture.src = '/public/avatar.png';
        }
    } catch (error) {
        console.error('Error fetching profile picture:', error);
    }
}

fetchAndSetProfilePicture();