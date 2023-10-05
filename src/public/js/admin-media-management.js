const genreData = {};
const actorData = {};
// const categoryData = [];
// const directorData = [];

const editGenreDropdown = document.getElementById("edit_genre_id");
const editGenreButton = document.getElementById("edit_genre_button");
const editGenreModal = document.getElementById("editGenreModal");
const closeButtons = document.querySelectorAll(".close");
const saveEditGenreButton = document.getElementById("saveEditGenreButton");
const addGenreButton = document.getElementById("add-genre-button");

let selectedGenreIdToEdit = null;

async function fetchData() {
    try {
        const httpClient = new HttpClient();
        const [
            genreResponse,
            // actorResponse,
            // categoryResponse,
            // directorResponse,
        ] = await Promise.all([
            httpClient.get("/api/genre", null, false),
            // httpClient.get("/api/actor", null, false),
            // httpClient.get("/api/category", null, false),
            // httpClient.get("/api/director", null, false),
        ]);

        console.log([
            genreResponse,
            // actorResponse,
            // categoryResponse,
            // directorResponse,
        ]);
        console.log(genreResponse);
        const genreJson = JSON.parse(genreResponse.body);
        genreJson.data.forEach((genre) => {
            genreData[genre.genre_id] = genre.genre_name;
        });

        // console.log(genreData);
    } catch (error) {
        console.error("An error occurred during fetch data:", error);
        alert("An error occurred during fetch data.");
    }
}

async function addNewGenre() {
    const genre_name = document.getElementById("input-genre").value;

    const data = {
        genre_name,
    };

    try {
        const httpClient = new HttpClient();
        const response = await httpClient.post("/api/genre", data, false);
        const json = JSON.parse(response);

        if (json.success) {
            alert("Success adding new genre!");
        } else {
            alert("Login Failed: " + json.message);
        }
    } catch (error) {
        console.error("An error occurred:", error);
        alert("An error occurred while processing your request.");
    }
}

async function editGenre(newGenreName) {
    const updatedGenreData = {
        genre_id: selectedGenreIdToEdit,
        genre_name: newGenreName,
    };
    try {
        const httpClient = new HttpClient();
        const response = await httpClient.put(
            `/api/genre`,
            updatedGenreData,
            false
        );
        const json = JSON.parse(response.body);

        if (json.success) {
            alert("Edit genre successful");
            location.reload();
        } else {
            console.error("Edit genre failed:", json.error);
            alert("Edit operation failed: " + json.error);
        }
    } catch (error) {
        console.error("An error occurred during editing:", error);
        alert("An error occurred during editing.");
    }
}

editGenreButton.addEventListener("click", () => {
    editGenreModal.style.display = "block";
});

window.addEventListener("click", (event) => {
    if (event.target === editGenreModal) {
        editGenreModal.style.display = "none";
    }
});

closeButtons.forEach((button) => {
    button.addEventListener("click", () => {
        editGenreModal.style.display = "none";
        // the same for other modals as well
    });
});

saveEditGenreButton.addEventListener("click", (event) => {
    event.preventDefault();
    const newGenreName = document.getElementById("editGenreName").value;
    editGenre(newGenreName);
});

addGenreButton.addEventListener("click", (event) => {
    event.preventDefault();
    addNewGenre();
});

fetchData().then(() => {
    for (genre_id in genreData) {
        editGenreDropdown.innerHTML += `<option value="${genre_id}">${genreData[genre_id]}</option>`;
    }

    selectedGenreIdToEdit =
        editGenreDropdown.options[editGenreDropdown.selectedIndex].value;
});

const pollingInterval = 30000;
setInterval(fetchData, pollingInterval);
