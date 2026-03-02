import axios from "axios";

export class TodoService {
    constructor() {
        //
    }

    getTodos(url) {
        return axios.get(url, {
            headers: {
                "Content-Type": "appliaction/json"
            }
        })
    };

    getSingleTodo(url) {
        return axios.get(url, {
            headers: {
                "Content-Type": "appliaction/json"
            }
        })
    };

    createTodo(url, data) {
        return axios.post(url, data, {
            headers: {
                "Content-Type": "appliaction/json"
            }
        });
    };

    async updateTodo(url, data) {
        return axios.put(url, data, {
            headers: {
                "Content-Type": "appliaction/json"
            }
        });
    };
};