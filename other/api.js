const url = "https://backend.nshis.com/api/"

function APIregister(name, password,callback) {
    // Fetch data from the URL
    fetch(url + "register?name=" + name + "&password=" + password)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            callback(data);
        })
        .catch(error => {
            // Handle any errors that occur during the fetch operation
            console.error('There was a problem with the fetch operation:', error);
        });

}

function APIlogin(name, password,callback) {
    // Fetch data from the URL
    fetch(url + "login?name=" + name + "&password=" + password)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            callback(data);
        })
        .catch(error => {
            // Handle any errors that occur during the fetch operation
            console.error('There was a problem with the fetch operation:', error);
        });

}

function APIgetData(token,callback) {
    // Fetch data from the URL
    fetch(url + "data/get?token=" + token)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            callback(data);
        })
        .catch(error => {
            // Handle any errors that occur during the fetch operation
            console.error('There was a problem with the fetch operation:', error);
        });

}

function APIsetData(token,key,value,callback) {
    // Fetch data from the URL
    fetch(url + "data/set?token=" + token + "&key=" + key + "&keyValue=" + value)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            callback(data);
        })
        .catch(error => {
            // Handle any errors that occur during the fetch operation
            console.error('There was a problem with the fetch operation:', error);
        });
}