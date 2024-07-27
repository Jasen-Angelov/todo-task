import axios from 'axios';
import { API_URLS } from './constants.js';
export const createTodo = async (data) => {
    try {
        const response = await axios.post(API_URLS.TODOS, data);
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const fetchTodos = async () => {
    try {
        const response = await axios.get(API_URLS.TODOS);
        return response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error;
    }
};

export const deleteTodoById = async (id) => {
    try {
        const response = await axios.delete(`${API_URLS.TODOS}/${id}`);
        return response.data;
    } catch (error) {
        console.error('Error deleting todo:', error);
        throw error;
    }
};
