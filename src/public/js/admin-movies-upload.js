const uploadForm = document.getElementById("upload-form");
const titleInput = document.getElementById("movie-title");
const descriptionInput = document.getElementById("movie-description");
const releaseDateInput = document.getElementById("movie-release-date");
const thumbnailInput = document.getElementById("movie-thumbnail");
const videoInput = document.getElementById("movie-video");

uploadForm.addEventListener("submit", async (event) => {
    event.preventDefault();

    const http = new HttpClient();

    // const videoUploadData = {
    //     fileToUpload: videoInput.files[0],
    // };

    const videoUploadFormData = new FormData();
    videoUploadFormData.append("fileToUpload", videoInput.files[0]);

    const uploadVideoResponse = await http.post(
        "/api/upload",
        videoUploadFormData,
        false
    );

    console.log(uploadVideoResponse);
});

// const uploadVideoResponseJson = JSON.parse(uploadVideoResponse);
// const videoFilePath = "/uploads/videos/" + uploadVideoResponseJson.fileName;

// console.log("updated video at: ", videoFilePath);
// $title = $_POST['title'];
// $description = $_POST['description'];
// $release_date = $_POST['release_date'];
// $content_file_path = $_POST['content_file_path'];
// $thumbnail_file_path = $_POST['thumbnail_file_path'];

// const movieData = {
//     title: titleInput.value,
//     description: descriptionInput.value,
//     release_date: releaseDateInput.value,
// };
