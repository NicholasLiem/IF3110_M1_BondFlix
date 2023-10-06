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
    currentPageButton: document.getElementById("currentPageButton"),

    /**
     * New Content Modal
     */
    newContentModal: document.getElementById("new-content-modal"),
    openContentModalButton: document.getElementById("add-content-button"),
    closeNewContentModalButton: document.getElementById(
        "close-new-content-modal"
    ),
    submitContentButton: document.getElementById("submit-new-content-button"),

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

    /**
     * Add Content Form
     */
    uploadForm: document.getElementById("upload-form"),
    titleInput: document.getElementById("movie-title"),
    descriptionInput: document.getElementById("movie-description"),
    releaseDateInput: document.getElementById("movie-release-date"),
    thumbnailInput: document.getElementById("movie-thumbnail"),
    videoInput: document.getElementById("movie-video"),
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
    Elements.currentPageButton.innerHTML = ContentTable.currentPage;
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

    Elements.openContentModalButton.addEventListener("click", () => {
        Elements.newContentModal.style.display = "block";
    });

    Elements.closeNewContentModalButton.addEventListener("click", () => {
        Elements.newContentModal.style.display = "none";
    });

    Elements.uploadForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        try {
            const httpClient = new HttpClient();
            const videoFilePath = await uploadFile(
                httpClient,
                Elements.videoInput.files[0],
                "movies"
            );
            const thumbnailFilePath = await uploadFile(
                httpClient,
                Elements.thumbnailInput.files[0],
                "thumbnails"
            );
            const addContentParams = {
                title: Elements.titleInput.value,
                description: Elements.descriptionInput.value,
                release_date: Elements.releaseDateInput.value,
                content_file_path: videoFilePath,
                thumbnail_file_path: thumbnailFilePath,
            };
            const addContentResponseData = await addContent(
                httpClient,
                addContentParams
            );
            console.log(addContentResponseData);
        } catch (err) {
            alert(err.message);
            console.error(err);
        }
    });

    document.addEventListener("click", async (event) => {
        const target = event.target;

        if (
            target.classList.contains("delete-button") ||
            target.id === "delete-button"
        ) {
            const contentId = target.closest("tr").getAttribute("data-content-id");

            try {
                const httpClient = new HttpClient();
                const response = await httpClient.delete(
                    `/api/content?contentId=${contentId}`
                );
                const json = JSON.parse(response.body);
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

/**
 *
 * @param {HttpClient} httpClient
 * @param {*} addContentParams
 * @returns
 */
async function addContent(httpClient, addContentParams) {
    const addContentResponse = await httpClient.post(
        "/api/content",
        addContentParams,
        false
    );

    const addContentResponseBody = JSON.parse(addContentResponse.body);
    if (!addContentResponseBody.success) {
        throw new Error(
            "Failed to add content: " + addContentResponseBody.message
        );
    }

    return addContentResponseBody.data;
}

async function uploadFile(httpClient, file, uploadType) {
    const fileUploadResponse = await httpClient.uploadFile(
        "/api/upload",
        file,
        false
    );

    const fileUploadResponseBody = JSON.parse(fileUploadResponse);
    if (!fileUploadResponseBody.success) {
        throw new Error(fileUploadResponseBody.message);
    }

    console.log(fileUploadResponseBody);
    const uploadedFilePath = `/uploads/${uploadType}/${fileUploadResponseBody.data.file_name}`;
    return uploadedFilePath;
}

initEventListeners();

fetchData();
