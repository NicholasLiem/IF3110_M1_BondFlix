const contentData = {};
let currentcontentId = null;

async function getcontents() {
    try {
        const httpClient = new HttpClient();
        const response = await httpClient.get("/api/content", null, false);
        const json = JSON.parse(response);

        if (Array.isArray(json.data)) {
            json.data.forEach((content) => {
                if (!contentData[content.content_id]) {
                    const table = document.querySelector("table tbody");
                    const row = table.insertRow();
                    row.setAttribute("data-content-id", content.content_id);
                }

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
            console.log(response);
            return;
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

getcontents().then((r) => {});

const pollingInterval = 30000;
setInterval(getcontents, pollingInterval);
