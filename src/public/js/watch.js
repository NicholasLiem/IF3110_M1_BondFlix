const helper = new Helper();
const DashboardTable = {
    data: {},
    currentPage: 1,
    totalPages: 1,
    isAscending: true,
    filterEnabled: false,
    pageSize: 20,
    searchState: false,
};
let debounceTimer;



const Elements = {
    recommendationsContainer: document.getElementById('search-result-container'),
    navbarSearchInput: document.getElementById('navbar-search-input'),
    mostRecommend: document.getElementById('most-recommended'),
    streamContainer: document.getElementById('wrapper'),
    videoSource: document.getElementById('video-source'),
    videoElement: document.getElementById('video-element'),
    title: document.getElementById('movie-title'),
    description: document.getElementById('movie-description'),
    prevPageButton: document.getElementById("prevPageButton"),
    nextPageButton: document.getElementById("nextPageButton"),
    currentPageButton: document.getElementById("currentPageButton"),
}

async function fetchVideoData() {
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

function handlePaginationButtons() {
    Elements.currentPageButton.innerHTML = DashboardTable.currentPage;
    Elements.prevPageButton.disabled = DashboardTable.currentPage === 1;
    Elements.nextPageButton.disabled =
        DashboardTable.currentPage === DashboardTable.totalPages || DashboardTable.totalPages === 0;
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

async function fetchMovieData()
{
    try {
        const httpClient = new HttpClient();
        const query = Elements.navbarSearchInput.value.trim();
        let url = `/api/content?query=${query}&sortAscending=${DashboardTable.isAscending}&page=${DashboardTable.currentPage}&pageSize=${DashboardTable.pageSize}`;

        if (DashboardTable.filterEnabled) {
            url += ``;
        }

        const response = await httpClient.get(url, null, false);

        const data = JSON.parse(response.body).data;
        DashboardTable.totalPages = parseInt(response.headers["x-total-pages"]);
        updateContents(data);
        handlePaginationButtons();
    } catch (error) {

        console.log(error)
        console.error("An error occurred during fetch data:", error);
        alert("An error occurred during fetch data.");
    }
}

function updateContents(contents) {
    Elements.recommendationsContainer.innerHTML = '';

    if (contents && contents.length > 0) {
        contents.forEach((content) => {
            const contentId = content.content_id;
            const thumbnailPath = content.thumbnail_file_path;
            addRecommendation(contentId, thumbnailPath);
        })
        if (DashboardTable.searchState) {
            Elements.streamContainer.style.maxHeight = '0';
        } else {
            Elements.streamContainer.style.maxHeight = '100vh';
        }
    } else {
        const noResultsMessage = document.createElement('h2');
        noResultsMessage.style.fontWeight = "normal";
        noResultsMessage.textContent = 'No movies at the moment';
        Elements.recommendationsContainer.appendChild(noResultsMessage);
    }

}


function initEventListeners()
{
    Elements.navbarSearchInput.addEventListener("input", () => {
        const query = Elements.navbarSearchInput.value.trim();
        DashboardTable.searchState = query !== '';
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchMovieData();
        }, 500);
    });

    Elements.prevPageButton.addEventListener("click", () => {
        if (DashboardTable.currentPage > 1) {
            DashboardTable.currentPage--;
            fetchMovieData();
        }
    });

    Elements.nextPageButton.addEventListener("click", () => {
        if (DashboardTable.currentPage < DashboardTable.totalPages) {
            DashboardTable.currentPage++;
            fetchMovieData();
        }
    });
}

function addRecommendation(contentId, thumbnailPath)
{
    const link = document.createElement('a');
    link.href = `/watch?id=${contentId}`;

    const image = document.createElement('img');
    image.src = thumbnailPath;
    image.alt = 'Movie Thumbnail';

    link.appendChild(image);
    Elements.recommendationsContainer.appendChild(link);
}

initEventListeners();

fetchMovieData();
fetchVideoData();