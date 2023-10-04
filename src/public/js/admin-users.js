const UserTable = {
    data: {},
    currentPage: 1,
    totalPages: 1,
    isAscending: true,
    isAdmin: true,
    isSubscribed: true,
    filterEnabled: false,
    pageSize: 10,
};

const Elements = {
    searchInput: document.getElementById('search-input'),
    sortButton: document.getElementById('sort-button'),
    isAdminButton: document.getElementById('admin-filter-button'),
    isSubscribedButton: document.getElementById('sub-filter-button'),
    filterEnableButton: document.getElementById('enable-filter-button'),
    prevPageButton: document.getElementById('prevPageButton'),
    nextPageButton: document.getElementById('nextPageButton'),
};

const Constants = {
    BUTTON_TEXT: {
        ENABLED: '✓',
        DISABLED: '✗',
    },
    BUTTON_CLASSES: {
        ENABLED: 'green-status',
        DISABLED: 'red-status',
    },
};

function updateTable(users) {
    const tableBody = document.querySelector('table tbody');
    tableBody.innerHTML = '';

    if (users && users.length > 0) {
        users.forEach(user => {
            const row = tableBody.insertRow();
            row.setAttribute('data-user-id', user.user_id);

            const adminStatus = user.is_admin ? Constants.BUTTON_TEXT.ENABLED : Constants.BUTTON_TEXT.DISABLED;
            const subscriptionStatus = user.is_subscribed ? Constants.BUTTON_TEXT.ENABLED : Constants.BUTTON_TEXT.DISABLED;
            const adminStatusClass = user.is_admin ? Constants.BUTTON_CLASSES.ENABLED : Constants.BUTTON_CLASSES.DISABLED;
            const subscriptionStatusClass = user.is_subscribed ? Constants.BUTTON_CLASSES.ENABLED : Constants.BUTTON_CLASSES.DISABLED;

            row.innerHTML = `
        <td>${user.user_id}</td>
        <td>${user.username}</td>
        <td>${user.first_name}</td>
        <td>${user.last_name}</td>
        <td class="${adminStatusClass}">${adminStatus}</td>
        <td class="${subscriptionStatusClass}">${subscriptionStatus}</td>
        <td>
          <button class="edit-button">Edit</button>
          <button class="delete-button">Delete</button>
        </td>
      `;
        });
    } else {
        const placeholderRow = tableBody.insertRow();
        placeholderRow.innerHTML = `
      <td colspan="7">No data available</td>
    `;
    }

    UserTable.data = users;
}


function handlePaginationButtons() {
    Elements.prevPageButton.disabled = UserTable.currentPage === 1;
    Elements.nextPageButton.disabled = UserTable.currentPage === UserTable.totalPages;
}

async function fetchData() {
    try {
        const httpClient = new HttpClient();
        const query = Elements.searchInput.value.trim();
        let url = `/api/users?query=${query}&sortAscending=${UserTable.isAscending}&page=${UserTable.currentPage}&pageSize=${UserTable.pageSize}`;

        if (UserTable.filterEnabled) {
            url += `&isAdmin=${UserTable.isAdmin}&isSubscribed=${UserTable.isSubscribed}`;
        }
        const response = await httpClient.get(
            url,
            null,
            false
        );


        const data = JSON.parse(response.body).data
        UserTable.totalPages = parseInt(response.headers['x-total-pages']);
        updateTable(data);
        handlePaginationButtons();
    } catch (error) {
        console.error('An error occurred during fetch data:', error);
        alert('An error occurred during fetch data.');
    }
}

function initEventListeners() {
    Elements.searchInput.addEventListener('input', () => {
        fetchData();
    });

    Elements.sortButton.addEventListener('click', () => {
        UserTable.isAscending = !UserTable.isAscending;
        Elements.sortButton.textContent = `Sort ID ${UserTable.isAscending ? '↑' : '↓'}`;
        fetchData();
    });

    Elements.isAdminButton.addEventListener('click', () => {
        UserTable.isAdmin = !UserTable.isAdmin;
        const buttonText = UserTable.isAdmin ? Constants.BUTTON_TEXT.ENABLED : Constants.BUTTON_TEXT.DISABLED;
        const buttonClass = UserTable.isAdmin ? Constants.BUTTON_CLASSES.ENABLED : Constants.BUTTON_CLASSES.DISABLED;
        Elements.isAdminButton.textContent = `Is Admin ${buttonText}`;
        Elements.isAdminButton.classList.toggle('green-status', UserTable.isAdmin);
        Elements.isAdminButton.classList.toggle('red-status', !UserTable.isAdmin);
        fetchData();
    });

    Elements.isSubscribedButton.addEventListener('click', () => {
        UserTable.isSubscribed = !UserTable.isSubscribed;
        const buttonText = UserTable.isSubscribed ? Constants.BUTTON_TEXT.ENABLED : Constants.BUTTON_TEXT.DISABLED;
        const buttonClass = UserTable.isSubscribed ? Constants.BUTTON_CLASSES.ENABLED : Constants.BUTTON_CLASSES.DISABLED;
        Elements.isSubscribedButton.textContent = `Is Subscribed ${buttonText}`;
        Elements.isSubscribedButton.classList.toggle('green-status', UserTable.isSubscribed);
        Elements.isSubscribedButton.classList.toggle('red-status', !UserTable.isSubscribed);
        fetchData();
    });

    Elements.filterEnableButton.addEventListener('click', () => {
        UserTable.filterEnabled = !UserTable.filterEnabled;
        Elements.filterEnableButton.textContent = `Filter ${UserTable.filterEnabled ? 'Enabled ✓' : 'Disabled ✗'}`;
        Elements.filterEnableButton.classList.toggle('green-status', UserTable.filterEnabled);
        Elements.filterEnableButton.classList.toggle('red-status', !UserTable.filterEnabled);
        fetchData();
    });

    Elements.prevPageButton.addEventListener('click', () => {
        if (UserTable.currentPage > 1) {
            UserTable.currentPage--;
            fetchData();
        }
    });

    Elements.nextPageButton.addEventListener('click', () => {
        if (UserTable.currentPage < UserTable.totalPages) {
            UserTable.currentPage++;
            fetchData();
        }
    });
}

initEventListeners();

fetchData();
