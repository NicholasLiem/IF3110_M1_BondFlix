
const userData = {};
async function getUsers() {
    try {
        const httpClient = new HttpClient();
        const response = await httpClient.get('/api/users', null, false);
        const json = JSON.parse(response);

        if (Array.isArray(json.data)) {
            json.data.forEach((user) => {
                if (!userData[user.user_id]) {
                    const table = document.querySelector("table tbody");
                    const row = table.insertRow();
                    row.setAttribute("data-user-id", user.user_id);
                }

                userData[user.user_id] = user;
                const adminStatus =  (user.is_admin === true ? '✓' : '✗');
                const subscriptionStatus = (user.is_subscribed === true ? '✓' : '✗');
                const adminStatusClass = user.is_admin ? 'green-status' : 'red-status';
                const subscriptionStatusClass = user.is_subscribed ? 'green-status' : 'red-status';

                const row = document.querySelector(`[data-user-id="${user.user_id}"]`);
                row.innerHTML = `
                    <td>${user.user_id}</td>
                    <td>${user.username}</td>
                    <td>${user.first_name}</td>
                    <td>${user.last_name}</td>
                    <td id="admin-status-symbol" class="${adminStatusClass}">${adminStatus}</td>
                    <td id="subscribe-status-symbol" class="${subscriptionStatusClass}">${subscriptionStatus}</td>
                    <td>
                        <button class="edit-button">Edit</button>
                        <button class="delete-button">Delete</button>
                    </td>
                `;
            });
        } else {
            console.error("Invalid API response:", json);
            alert("Invalid API response.");
        }
    } catch (error) {
        console.error("An error occurred:", error);
        alert("An error occurred while processing your request.");
    }
}

getUsers().then(r => {});

const pollingInterval = 30000;
setInterval(getUsers, pollingInterval);

/**
 * Delete button functionality
 */
document.addEventListener("click", async (event) => {
    const target = event.target;

    if (target.classList.contains("delete-button") || target.id === "delete-button") {
        const userId = target.closest("tr").getAttribute("data-user-id");

        try {
            const httpClient = new HttpClient();
            const response = await httpClient.delete(`/api/users?userId=${userId}`);
            const json = JSON.parse(response);
            console.log(json);
            if (json.success) {
                alert('Delete operation successful');
                location.reload();
            } else {
                console.error("Delete operation failed:", response.error);
                alert("Delete operation failed." + response.error);
            }
        } catch (error) {
            console.error("An error occurred during deletion:", error);
            alert("An error occurred during deletion.");
        }
    }
});

/**
 * Edit modal functionality
 * @type {HTMLElement}
 */
const closeBtn = document.querySelector(".close");
const editUserModal = document.getElementById("editUserModal");
// const editUserForm = document.getElementById("editUserForm");
const editUsernameInput = document.getElementById("editUsername");
document.addEventListener("click", async (event) => {
    const target = event.target;

    if (target.classList.contains("edit-button")) {
        const userId = target.closest("tr").getAttribute("data-user-id");
        const user = userData[userId];

        editUsernameInput.value = user.username;
        editUserModal.style.display = "block";
    }

    if (target.classList.contains("close")) {
        editUserModal.style.display = "none";
    }
});


closeBtn.addEventListener("click", () => {
    editUserModal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === editUserModal) {
        editUserModal.style.display = "none";
    }
});

// editUserForm.addEventListener("submit", async (event) => {
//     event.preventDefault();
//
//     const userId = event.target.closest("tr").getAttribute("data-user-id");
//     const editedUsername = editUsernameInput.value;
//
//     const requestData = {
//         userId: userId,
//         username: editedUsername,
//     };
//
//     try {
//         const httpClient = new HttpClient();
//         const response = await httpClient.put(`/api/users/${userId}`, JSON.stringify(requestData));
//         const json = JSON.parse(response);
//
//         if (json.success) {
//             alert('Edit operation successful');
//             location.reload();
//         } else {
//             console.error("Edit operation failed:", response.error);
//             alert("Edit operation failed: " + response.error);
//         }
//     } catch (error) {
//         console.error("An error occurred during editing:", error);
//         alert("An error occurred during editing.");
//     }
//
//     // Close the edit modal after submitting
//     editUserModal.style.display = "none";
// });

