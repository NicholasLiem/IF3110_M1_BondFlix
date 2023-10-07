const VideoElements = {
    videoSource: document.getElementById('video-source'),
    videoElement: document.getElementById('video-element'),
    title: document.getElementById('movie-title'),
    description: document.getElementById('movie-description')
}

async function fetchVideoData() {
    try {
        const httpClient = new HttpClient();
        const contentId = helper.getUrlParameter('id');
        let url = `/api/content?content_id=${contentId}`;

        const response = await httpClient.get(url, null, false);
        const data = JSON.parse(response.body);

        if (data.success === true) {
            const contentFilePath = data.data[0].content_file_path;
            const movieTitle = data.data[0].title;
            const movieDescription = data.data[0].description;
            updateTitleAndDescription(movieTitle, movieDescription);
            updateSource(contentFilePath);
        } else {
            window.location.href = '/404';
        }
    } catch (error) {
        console.error("An error occurred during fetch data:", error);
        alert("An error occurred during fetch data.");
    }
}

function updateSource(videoPath) {
    const videoElement = VideoElements.videoElement;
    if (videoElement) {
        videoElement.pause();
        VideoElements.videoSource.src = videoPath;
        videoElement.load();
        videoElement.play();
    }
}

function updateTitleAndDescription(title, description) {
    const titleElement = VideoElements.title;
    const descriptionElement = VideoElements.description;

    if (titleElement && descriptionElement) {
        titleElement.innerHTML = title;
        descriptionElement.textContent = description;
    }
}


fetchVideoData();