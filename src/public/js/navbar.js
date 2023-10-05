const accountButton = document.querySelector(".account-button");
const accountMenu = document.querySelector(".account-menu");

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
