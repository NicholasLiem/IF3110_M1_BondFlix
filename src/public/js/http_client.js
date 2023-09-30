class HttpClient {
    constructor() {
        this.http = new XMLHttpRequest();
    }

    async request(method, url, data, asXML) {
        return new Promise((resolve, reject) => {
            this.http.open(method, url, true);

            if (method === 'POST' || method === 'PUT') {
                this.http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            }

            this.http.onload = () => {
                if (!asXML) {
                    try {
                        resolve(this.http.responseText);
                    } catch (e) {
                        reject(e);
                    }
                } else {
                    resolve(this.http.responseXML);
                }
            };

            this.http.onerror = () => {
                reject(`Network Error`);
            };

            const params= new URLSearchParams(data).toString();
            this.http.send(params);
        });
    }

    async get(url, data, asXML) {
        return this.request('GET', url, data, asXML);
    }

    async post(url, data, asXML) {
        return this.request('POST', url, data, asXML);
    }

    async put(url, data, asXML) {
        return this.request('PUT', url, data, asXML);
    }

    async delete(url, data, asXML) {
        return this.request('DELETE', url, data, asXML);
    }
}