const Elements = {
    editProfilePictureButton: document.getElementById("edit-profile-pic-button"),
    saveButton: document.getElementById("save-button"),
    cancelButton: document.getElementById("cancel-button"),
    firstNameInput: document.getElementById("first-name"),
    lastNameInput: document.getElementById("last-name"),
    passwordInput: document.getElementById("password")
};

function initEventListeners()
{
    Elements.editProfilePictureButton.addEventListener("click", () => {
        updateProfilePicture();
    })

    Elements.saveButton.addEventListener("click", () => {
        updateProfile();
    })

    Elements.cancelButton.addEventListener("click", () => {
        Elements.firstNameInput.value = '';
        Elements.lastNameInput.value = '';
        Elements.passwordInput.value = '';
    })
}

async function updateProfilePicture(){

}

async function updateProfile()
{

    const first_name = Elements.firstNameInput.value;
    const last_name = Elements.lastNameInput.value;
    const password = Elements.passwordInput.value;

    if (first_name === "") {
        alert("Please enter your first name.");
        return;
    }

    if (password !== '' && password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return;
    }
    const data = {
        first_name,
        last_name,
        password,
    }
    try {
        const httpClient = new HttpClient();
        const response = await httpClient.put(
            '/api/account/user',
            data,
            false
        );

        const json = JSON.parse(response.body);
        if (json.success) {
            alert("Update successful!");
            window.location.reload();
        } else {
            alert("Registration failed: " + json.message)
        }
    } catch (error) {
        console.error("An error occurred:", error);
        alert("An error occurred while processing your request.");
    }
}

initEventListeners();
