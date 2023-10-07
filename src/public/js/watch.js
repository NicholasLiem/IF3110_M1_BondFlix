const helper = new Helper();

const Elements = {
    videoSource: document.getElementById('video-source'),
    videoElement: document.getElementById('video-element'),
    title: document.getElementById('movie-title'),
    description: document.getElementById('movie-description')
}

async function fetchData() {
    try {
        const httpClient = new HttpClient();
        const contentId = helper.getUrlParameter('id');
        let url = `/api/content?content_id=${contentId}`;

        const response = await httpClient.get(url, null, false);
        const data = JSON.parse(response.body);

        const contentFilePath = data.data[0].content_file_path;
        const movieTitle = data.data[0].title;
        const movieDescription = data.data[0].description;

        if (data.success === true) {
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
    const videoElement = Elements.videoElement;
    if (videoElement) {
        videoElement.pause();
        Elements.videoSource.src = videoPath;
        videoElement.load();
        videoElement.play();
    }
}

function updateTitleAndDescription(title, description) {
    const titleElement = Elements.title;
    const descriptionElement = Elements.description;

    if (titleElement && descriptionElement) {
        titleElement.innerHTML = title;
        descriptionElement.textContent = description;
    }
}


fetchData();