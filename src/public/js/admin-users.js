let userData = {};
let currentUserId = null;
let isAscending = true;
let isAdmin = true;
let isSubscribed = true;
let filterEnable = false;

/**
 * Debounce for search
 */

const helper = new Helper();
function updateTable(users) {
    const tableBody = document.querySelector("table tbody");

    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }

    const filteredUserData = {};

    users.forEach((user) => {
        if (user && Object.keys(user).length > 0) {
            const row = tableBody.insertRow();
            row.setAttribute("data-user-id", user.user_id);

            filteredUserData[user.user_id] = user;
            const adminStatus = user.is_admin === true ? "✓" : "✗";
            const subscriptionStatus = user.is_subscribed === true ? "✓" : "✗";
            const adminStatusClass = user.is_admin
                ? "green-status"
                : "red-status";
            const subscriptionStatusClass = user.is_subscribed
                ? "green-status"
                : "red-status";
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
        }
    });

    userData = filteredUserData;
}

function resetTable() {
    const tableBody = document.querySelector("table tbody");

    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }

    const placeholderRow = tableBody.insertRow();
    placeholderRow.innerHTML = `
        <td colspan="7">No data available</td>
    `;
}

const searchInput = document.getElementById("search-input");
async function fetchData(query, sortAscending, isAdmin, isSubscribed) {
    try {
        const httpClient = new HttpClient();
        let response;
        if (filterEnable) {
            response = await httpClient.get(
                `/api/users?query=${query}&sortAscending=${sortAscending}&isAdmin=${isAdmin}&isSubscribed=${isSubscribed}`,
                null,
                false
            );
        } else {
            response = await httpClient.get(
                `/api/users?query=${query}&sortAscending=${sortAscending}`,
                null,
                false
            );
        }

        const json = JSON.parse(response);
        if (json.success) {
            updateTable(json.data);
        } else {
            resetTable();
        }
    } catch (error) {
        console.error("An error occurred during fetch data:", error);
        alert("An error occurred during fetch data.");
    }
}

const debouncedFetch = helper.debounce(fetchData, 500);
searchInput.addEventListener("input", function () {
    const query = searchInput.value.trim();
    debouncedFetch(query, isAscending, isAdmin, isSubscribed);
});

/**
 * Sort Feature
 */
const sortButton = document.getElementById("sort-button");
sortButton.addEventListener("click", () => {
    isAscending = !isAscending;
    if (isAscending) {
        sortButton.textContent = "Sort ID ↑";
    } else {
        sortButton.textContent = "Sort ID ↓";
    }
    const query = searchInput.value.trim();

    fetchData(query, isAscending, isAdmin, isSubscribed);
});

/**
 * Filter feature 1 (isAdmin)
 */
const isAdminButton = document.getElementById("admin-filter-button");
isAdminButton.addEventListener("click", () => {
    isAdmin = !isAdmin;
    if (isAdmin) {
        isAdminButton.textContent = "Is Admin ✓";
    } else {
        isAdminButton.textContent = "Is Admin ✗";
    }
    const query = searchInput.value.trim();

    fetchData(query, isAscending, isAdmin, isSubscribed);
});

/**
 * Filter feature 2 (isSubscribed)
 */
const isSubscribedButton = document.getElementById("sub-filter-button");
isSubscribedButton.addEventListener("click", () => {
    isSubscribed = !isSubscribed;
    if (isSubscribed) {
        isSubscribedButton.textContent = "Is Subscribed ✓";
    } else {
        isSubscribedButton.textContent = "Is Subscribed ✗";
    }
    const query = searchInput.value.trim();

    fetchData(query, isAscending, isAdmin, isSubscribed);
});

/**
 * Enable filter function
 */
const filterEnableButton = document.getElementById("enable-filter-button");

filterEnableButton.addEventListener("click", () => {
    filterEnable = !filterEnable;
    if (filterEnable) {
        filterEnableButton.textContent = "Filter Enabled ✓";
        filterEnableButton.style.backgroundColor = "green";
    } else {
        filterEnableButton.textContent = "Filter Disabled ✗";
        filterEnableButton.style.backgroundColor = "red";
    }
    const query = searchInput.value.trim();
    fetchData(query, isAscending, isAdmin, isSubscribed);
});

fetchData("", isAscending, isAdmin, isSubscribed).then((r) => {});
/**
 * Delete button functionality
 */
document.addEventListener("click", async (event) => {
    const target = event.target;

    if (
        target.classList.contains("delete-button") ||
        target.id === "delete-button"
    ) {
        const userId = target.closest("tr").getAttribute("data-user-id");

        try {
            const httpClient = new HttpClient();
            const response = await httpClient.delete(
                `/api/users?userId=${userId}`
            );
            const json = JSON.parse(response);
            if (json.success) {
                alert("Delete operation successful");
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
const editUsernameInput = document.getElementById("editUsername");
const editFirstNameInput = document.getElementById("editFirstName");
const editLastNameInput = document.getElementById("editLastName");
const editAdminSelect = document.getElementById("editStatusAdmin");
const editSubscriptionSelect = document.getElementById(
    "editStatusSubscription"
);
document.addEventListener("click", async (event) => {
    const target = event.target;

    if (target.classList.contains("edit-button")) {
        const userId = target.closest("tr").getAttribute("data-user-id");
        const user = userData[userId];

        currentUserId = userId;

        const username = user.username;
        const firstName = user.first_name;
        const lastName = user.last_name;
        const isAdmin = user.is_admin;
        const isSubscribed = user.is_subscribed;

        editUsernameInput.value = username;
        editFirstNameInput.value = firstName;
        editLastNameInput.value = lastName;

        editAdminSelect.value = isAdmin.toString();
        editSubscriptionSelect.value = isSubscribed.toString();
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

document
    .getElementById("saveEditButton")
    .addEventListener("click", async (e) => {
        e.preventDefault();

        const userId = currentUserId;
        const username = document.getElementById("editUsername").value;
        const first_name = document.getElementById("editFirstName").value;
        const last_name = document.getElementById("editLastName").value;
        const is_admin =
            document.getElementById("editStatusAdmin").value === "true"; // Convert to boolean
        const is_subscribed =
            document.getElementById("editStatusSubscription").value === "true"; // Convert to boolean

        const updatedUserData = {
            userId,
            username: username,
            first_name: first_name,
            last_name: last_name,
            is_admin: is_admin,
            is_subscribed: is_subscribed,
        };

        try {
            const httpClient = new HttpClient();
            const response = await httpClient.put(
                `/api/users?userId=${userId}`,
                updatedUserData,
                false
            );
            const json = JSON.parse(response);

            if (json.success) {
                alert("Edit operation successful");
                location.reload();
            } else {
                console.error("Edit operation failed:", json.error);
                alert("Edit operation failed: " + json.error);
            }
        } catch (error) {
            console.error("An error occurred during editing:", error);
            alert("An error occurred during editing.");
        }
    });

/*  Modal add user button
 */
// const newUserModal = document.getElementById("newUserModal");
//
// closeBtn.addEventListener("click", () => {
//     newUserModal.style.display = "none";
// });
//
// window.addEventListener("click", (event) => {
//     if (event.target === newUserModal) {
//         newUserModal.style.display = "none";
//     }
// });
// document.getElementById("newUserButton").addEventListener("click", async (e) => {
//     e.preventDefault();
//
//     const username = document.getElementById("newUsername").value;
//     const first_name = document.getElementById("newFirstName").value;
//     const last_name = document.getElementById("newLastName").value;
//     const password = document.getElementById('newPassword').value;
//     const password_confirmation = document.getElementById('newPasswordConfirmation').value;
//
//     if (username === '') {
//         alert("Please enter a username.");
//         return;
//     }
//
//     if (first_name === '') {
//         alert("Please enter your first name.");
//         return;
//     }
//
//     if (last_name === '') {
//         alert("Please enter your last name.");
//         return;
//     }
//
//     if (password === '') {
//         alert("Please enter a password.");
//         return;
//     }
//
//     if (password.length < 6) {
//         alert("Password must be at least 6 characters long.");
//         return;
//     }
//
//     if (password !== password_confirmation) {
//         alert("Password do not match!")
//         return;
//     }
//
//     const data = {
//         username,
//         first_name,
//         last_name,
//         password,
//         password_confirmation
//     };
//
//     try {
//         const httpClient = new HttpClient();
//         const response = await httpClient.post('/api/auth/register', data, false);
//         const json = JSON.parse(response);
//         if (json.success) {
//             alert("Registration successful!");
//             window.location.href = "/login";
//         } else {
//             alert("Registration failed: " + json.message);
//         }
//     } catch (error) {
//         console.error("An error occurred:", error);
//         alert("An error occurred while processing your request.");
//     }
// });
