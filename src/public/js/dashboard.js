const helper = new Helper();
const DashboardTable = {
    data: {},
    currentPage: 1,
    totalPages: 1,
    isAscending: true,
    filterEnabled: false,
    pageSize: 10,
};

let debounceTimer;


const Elements = {
    recommendationsContainer: document.getElementById('search-result-container'),
    navbarSearchInput: document.getElementById('navbar-search-input'),
}

// function handlePaginationButtons() {
//     Elements.currentPageButton.innerHTML = DashboardTable.currentPage;
//     Elements.prevPageButton.disabled = DashboardTable.currentPage === 1;
//     Elements.nextPageButton.disabled =
//         DashboardTable.currentPage === DashboardTable.totalPages;
// }
function updateContents(contents) {
    Elements.recommendationsContainer.innerHTML = '';

    if (contents && contents.length > 0) {
        contents.forEach((content) => {
            const contentId = content.content_id;
            const thumbnailPath = content.thumbnail_file_path;
            addRecommendation(contentId, thumbnailPath);
        })
    } else {
        const noResultsMessage = document.createElement('p');
        noResultsMessage.textContent = 'No results found.';
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
        // handlePaginationButtons();
    } catch (error) {

        console.log(error)
        console.error("An error occurred during fetch data:", error);
        alert("An error occurred during fetch data.");
    }
}

function initEventListeners()
{
    Elements.navbarSearchInput.addEventListener("input", () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchData();
        }, 500);
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