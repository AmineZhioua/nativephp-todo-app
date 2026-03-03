import axios from "axios";

export class TodoService {
    constructor() {
        //
    }

    async getTodos(url) {
        return axios.get(url, {
            headers: {
                "Content-Type": "appliaction/json"
            }
        })
    };

    async getSingleTodo(url) {
        return axios.get(url, {
            headers: {
                "Content-Type": "appliaction/json"
            }
        })
    };

    async createTodo(url, data) {
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

    async deleteTodo(url) {
        return axios.delete(url, {
            headers: {
                "Content-Type": "appliaction/json"
            }
        })
    };
};