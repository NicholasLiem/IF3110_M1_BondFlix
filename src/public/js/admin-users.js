
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
                        <button>Edit</button>
                        <button>Delete</button>
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