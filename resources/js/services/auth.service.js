import axios from "axios";

export class AuthService {
    constructor() {
        //
    }

    // Function to Create an Account
    async register(data) {
        return axios.post("http://10.0.2.2:8000/api/auth/register", {
            name: data.username,
            email: data.email,
            password: data.password,
            password_confirmation: data.confirmedPassword
        }, {
            headers: {
                "Content-Type": "application/json"
            }
        });
    };
};