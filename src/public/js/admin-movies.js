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
            <td>${content.uploaded_at}</td>
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