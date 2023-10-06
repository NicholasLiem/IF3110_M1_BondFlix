const uploadForm = document.getElementById("upload-form");
const titleInput = document.getElementById("movie-title");
const descriptionInput = document.getElementById("movie-description");
const releaseDateInput = document.getElementById("movie-release-date");
const thumbnailInput = document.getElementById("movie-thumbnail");
const videoInput = document.getElementById("movie-video");

uploadForm.addEventListener("submit", async (event) => {
    event.preventDefault();

    try {
        const httpClient = new HttpClient();
        const videoFilePath = await uploadFile(
            httpClient,
            videoInput.files[0],
            "movies"
        );
        const thumbnailFilePath = await uploadFile(
            httpClient,
            thumbnailInput.files[0],
            "thumbnails"
        );
        const addContentParams = {
            title: titleInput.value,
            description: descriptionInput.value,
            release_date: releaseDateInput.value,
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
