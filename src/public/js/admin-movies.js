const helper = new Helper();
const ContentTable = {
    data: {},
    currentUserId: null,
    currentPage: 1,
    totalPages: 1,
    isAscending: true,
    filterEnabled: false,
    pageSize: 10,
};

const Elements = {

    /**
     * Search bar input and buttons
     */
    searchInput: document.getElementById("search-input"),
    sortButton: document.getElementById("sort-button"),

    /**
     * Filter part
     */
    filterEnableButton: document.getElementById("enable-filter-button"),

    /**
     * Pagination Part
     */
    prevPageButton: document.getElementById("prevPageButton"),
    nextPageButton: document.getElementById("nextPageButton"),

    /**
     * New Content Modal
     */
    newUserModal: document.getElementById("newUserModal"),
    openUserModalButton: document.getElementById("add-user-button"),
    closeUserModalButton: document.getElementById("close-user"),
    submitUserButton: document.getElementById("newUserButton"),

    /**
     * Edit Content Modal
     */
    editUserModal: document.getElementById("editUserModal"),
    editUsernameInput: document.getElementById("editUsername"),
    editFirstNameInput: document.getElementById("editFirstName"),
    editLastNameInput: document.getElementById("editLastName"),
    passwordInput: document.getElementById("editPassword"),
    editAdminSelect: document.getElementById("editStatusAdmin"),
    editSubscriptionSelect: document.getElementById("editStatusSubscription"),
    closeEditModalButton: document.getElementById("close-edit"),
    saveEditButton: document.getElementById("saveEditButton"),
};

const Constants = {
    BUTTON_TEXT: {
        ENABLED: "✓",
        DISABLED: "✗",
    },
    BUTTON_CLASSES: {
        ENABLED: "green-status",
        DISABLED: "red-status",
    },
};

function updateTable(contents) {
    const tableBody = document.querySelector("table tbody");
    tableBody.innerHTML = "";

    if (contents && contents.length > 0) {
        contents.forEach((content) => {
            const row = tableBody.insertRow();
            row.setAttribute("data-content-id", content.content_id);

            row.innerHTML = `
            <td>${content.content_id}</td>
            <td>${content.title}</td>
            <td>${content.description}</td>
            <td>${content.release_date}</td>
            <td>${content.content_file_path}</td>
            <td>${content.thumbnail_file_path}</td>
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

    ContentTable.data = contents;
}

function handlePaginationButtons() {
    Elements.prevPageButton.disabled = ContentTable.currentPage === 1;
    Elements.nextPageButton.disabled =
        ContentTable.currentPage === ContentTable.totalPages;
}


async function fetchData() {
    try {
        const httpClient = new HttpClient();
        const query = Elements.searchInput.value.trim();
        let url = `/api/content?query=${query}&sortAscending=${ContentTable.isAscending}&page=${ContentTable.currentPage}&pageSize=${ContentTable.pageSize}`;

        if (ContentTable.filterEnabled) {
            // url += `&isAdmin=${ContentTable.isAdmin}&isSubscribed=${ContentTable.isSubscribed}`;
        }
        const response = await httpClient.get(url, null, false);

        const data = JSON.parse(response.body).data;
        ContentTable.totalPages = parseInt(response.headers["x-total-pages"]);
        updateTable(data);
        handlePaginationButtons();
    } catch (error) {
        console.error("An error occurred during fetch data:", error);
        alert("An error occurred during fetch data.");
    }
}

function initEventListeners() {
    Elements.searchInput.addEventListener("input", () => {
        fetchData();
    });

    Elements.sortButton.addEventListener("click", () => {
        ContentTable.isAscending = !ContentTable.isAscending;
        Elements.sortButton.textContent = `Sort Title ${
            ContentTable.isAscending ? "↑" : "↓"
        }`;
        fetchData();
    });

    Elements.filterEnableButton.addEventListener("click", () => {
        ContentTable.filterEnabled = !ContentTable.filterEnabled;
        Elements.filterEnableButton.textContent = `Filter ${
            ContentTable.filterEnabled ? "Enabled ✓" : "Disabled ✗"
        }`;
        Elements.filterEnableButton.classList.toggle(
            "green-status",
            ContentTable.filterEnabled
        );
        Elements.filterEnableButton.classList.toggle(
            "red-status",
            !ContentTable.filterEnabled
        );
        Elements.filterEnableButton.style.backgroundColor =
            ContentTable.filterEnabled ? "green" : "#e50914";
        fetchData();
    });

    Elements.prevPageButton.addEventListener("click", () => {
        if (ContentTable.currentPage > 1) {
            ContentTable.currentPage--;
            fetchData();
        }
    });

    Elements.nextPageButton.addEventListener("click", () => {
        if (ContentTable.currentPage < ContentTable.totalPages) {
            ContentTable.currentPage++;
            fetchData();
        }
    });

    // helper.openModal(
    //     Elements.newUserModal,
    //     Elements.openUserModalButton,
    //     Elements.closeUserModalButton,
    //     Elements.submitUserButton,
    //     onSubmitUserModal
    // );
    //
    // Elements.closeEditModalButton.addEventListener("click", () => {
    //     Elements.editUserModal.style.display = "none";
    // });
    //
    // window.addEventListener("click", (event) => {
    //     if (event.target === Elements.editUserModal) {
    //         Elements.editUserModal.style.display = "none";
    //     }
    //     if (event.target === Elements.newUserModal) {
    //         Elements.newUserModal.style.display = "none";
    //     }
    // });
}

initEventListeners();

fetchData();
