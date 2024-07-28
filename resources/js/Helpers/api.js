import axios from 'axios';
import {API_URLS} from './constants.js';

export const createTodo = async (data) => {
    try {
        return await axios.post(API_URLS.TODOS, data);
    } catch (error) {
        throw error;
    }
};

export const fetchTodos = async () => {
    try {
        return await axios.get(API_URLS.TODOS);
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error;
    }
};

export const deleteTodoById = async (id) => {
    try {
        return await axios.delete(`${API_URLS.TODOS}/${id}`);
    } catch (error) {
        console.error('Error deleting todo:', error);
        throw error;
    }
};
