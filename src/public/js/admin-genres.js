async function addNewGenre(e) {
    e.preventDefault();

    const genre = document.getElementById('input-genre').value;

    const data = {
        genre
    };

    try {
        const httpClient = new HttpClient();
        const response = await httpClient.post('/api/genre', data, false);
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
