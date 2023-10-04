const contentData = {};
let currentContentId = null;

async function getContents() {
    try {
        const httpClient = new HttpClient();
        const response = await httpClient.get("/api/content", null, false);
        const json = JSON.parse(response.body);

        if (Array.isArray(json.data)) {
            json.data.forEach((content) => {
                if (!contentData[content.content_id]) {
                    const table = document.querySelector("table tbody");
                    const row = table.insertRow();
                    row.setAttribute("data-content-id", content.content_id);
                }

                contentData[content.content_id] = content;

                const row = document.querySelector(
                    `[data-content-id="${content.content_id}"]`
                );
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
            console.error("Invalid API response:", json);
            alert("Invalid API response.");
        }
    } catch (error) {
        console.error("An error occurred:", error);
        alert("An error occurred while processing your request.");
    }
}

/**
 * Delete button functionality
 */
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
                `/api/content?content_id=${contentId}`
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

/**
 * Edit modal functionality
 * @type {HTMLElement}
 */
const closeBtn = document.querySelector(".close");
const editContentModal = document.getElementById("editContentModal");
const editTitleInput = document.getElementById("editTitle");
const editDescriptionInput = document.getElementById("editDescription");
const editReleaseDateInput = document.getElementById("editReleaseDate");
const editContentFilePathInput = document.getElementById("editContentFilePath");
const editThumbnailFilePathInput = document.getElementById(
    "editThumbnailFilePath"
);

document.addEventListener("click", async (event) => {
    const target = event.target;

    if (target.classList.contains("edit-button")) {
        const contentId = target.closest("tr").getAttribute("data-content-id");
        const content = contentData[contentId];
        currentContentId = contentId;

        const title = content.title;
        const description = content.description;
        const releaseDate = content.release_date;
        const contentFilePath = content.content_file_path;
        const thumbnailFilePath = content.thumbnail_file_path;

        editTitleInput.value = title;
        editDescriptionInput.value = description;
        editReleaseDateInput.value = releaseDate;
        editContentFilePathInput.value = contentFilePath;
        editThumbnailFilePathInput.value = thumbnailFilePath;

        editContentModal.style.display = "block";
    }

    if (target.classList.contains("close")) {
        editContentModal.style.display = "none";
    }
});

closeBtn.addEventListener("click", () => {
    editContentModal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === editContentModal) {
        editContentModal.style.display = "none";
    }
});

document
    .getElementById("saveEditButton")
    .addEventListener("click", async (e) => {
        e.preventDefault();

        const contentId = currentContentId;
        const title = editTitleInput.value;
        const description = editDescriptionInput.value;
        const releaseDate = editReleaseDateInput.value;
        const contentFilePath = editContentFilePathInput.value;
        const thumbnailFilePath = editThumbnailFilePathInput.value;

        const updatedContentData = {
            content_id: contentId,
            title: title,
            description: description,
            release_date: releaseDate,
            content_file_path: contentFilePath,
            thumbnail_file_path: thumbnailFilePath,
        };

        try {
            const httpClient = new HttpClient();
            const response = await httpClient.put(
                `/api/content`,
                updatedContentData,
                false
            );

            const json = JSON.parse(response.body);
            if (json.success) {
                alert("Edit operation successful");
                location.reload();
            } else {
                console.error("Edit operation failed:", json.error);
                alert("Edit operation failed: " + json.error);
            }
        } catch (error) {
            console.error("An error occurred during editing:", error);
            console.log(error.toString());
            alert("An error occurred during editing.");
        }
    });

getContents().then((r) => {});

const pollingInterval = 30000;
setInterval(getContents, pollingInterval);
