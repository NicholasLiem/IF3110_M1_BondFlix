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
    mostRecommendWrapper: document.getElementById('most-recommended-wrapper'),
    prevPageButton: document.getElementById("prevPageButton"),
    nextPageButton: document.getElementById("nextPageButton"),
    currentPageButton: document.getElementById("currentPageButton"),
}

function handlePaginationButtons() {
    Elements.currentPageButton.innerHTML = DashboardTable.currentPage;
    Elements.prevPageButton.disabled = DashboardTable.currentPage === 1;
    Elements.nextPageButton.disabled =
        DashboardTable.currentPage === DashboardTable.totalPages || DashboardTable.totalPages === 0;
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
            Elements.mostRecommendWrapper.style.maxHeight = '0';
        } else {
            Elements.mostRecommendWrapper.style.maxHeight = '100vh';
        }
    } else {
        const noResultsMessage = document.createElement('h2');
        noResultsMessage.style.fontWeight = "normal";
        noResultsMessage.textContent = 'No movies at the moment';
        Elements.recommendationsContainer.appendChild(noResultsMessage);
    }

}

async function fetchData()
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

function initEventListeners()
{
    Elements.navbarSearchInput.addEventListener("input", () => {
        const query = Elements.navbarSearchInput.value.trim();
        DashboardTable.searchState = query !== '';
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchData();
        }, 500);
    });

    Elements.prevPageButton.addEventListener("click", () => {
        if (DashboardTable.currentPage > 1) {
            DashboardTable.currentPage--;
            fetchData();
        }
    });

    Elements.nextPageButton.addEventListener("click", () => {
        if (DashboardTable.currentPage < DashboardTable.totalPages) {
            DashboardTable.currentPage++;
            fetchData();
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
fetchData();