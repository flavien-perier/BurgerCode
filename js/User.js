class User {
    constructor() {
        this.username = localStorage.getItem("username");
        this.token = localStorage.getItem("token");
    }

    init(username, token) {
        this.username = username;
        this.token = token;
    }

    disconnect() {
        this.username = null;
        this.token = null;
        localStorage.removeItem("username");
        localStorage.removeItem("token");
    }

    save() {
        localStorage.setItem("username", this.username);
        localStorage.setItem("token", this.token);
    }

    isSet() {
        return this.username != null && this.token != null;
    }
}