import {useState, useEffect} from "react";
import {deleteTodoById} from "@/Helpers/api.js";
import {Head} from "@inertiajs/react";

export default function TodoTable({todos}) {
    const [todosList, setTodosList] = useState(todos.data || []);

    useEffect(() => {
        setTodosList(todos.data || []);
    }, [todos]);

    const deleteTodo = async (todo) => {
        if (!window.confirm("Are you sure you want to delete the todo?")) return;
        try {
            deleteTodoById(todo.id).then((res) => {
                if (res.data.success) {
                    setTodosList((prevTodos) => prevTodos.filter((t) => t.id !== todo.id));
                    alert(`Todo was deleted successfully!`);
                } else {
                    const messages = JSON.parse(res.message);
                    alert(`Todo was not deleted because: ${Object.values(messages).join(' ')}`);
                }
            });
        } catch (error) {
            alert('Network error. Please try again.');
        }
    };

    return (
        <>
            <Head title="Todos"/>
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="overflow-auto">
                                {todosList.length === 0 ? (
                                    <div className="text-center text-gray-500 dark:text-gray-400 mt-4">
                                        There are no TODO's left, but you can always create a new one!.
                                    </div>
                                ) : (
                                    <table
                                        className="w-full text-sm caret-transparent text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead
                                            className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                                        <tr>
                                            <th className="px-3 py-3 text-center">ID</th>
                                            <th className="px-3 py-3 text-center">Description</th>
                                            <th className="px-3 py-3 text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {todosList.map((todo) => (
                                            <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                                key={todo.id}>
                                                <td className="px-3 py-2 text-center">{todo.id}</td>
                                                <td className="px-3 py-2 sm:text-left">{todo.description}</td>
                                                <td className="px-3 py-2 text-center">
                                                    <button
                                                        onClick={() => deleteTodo(todo)}
                                                        className="font-medium text-red-600 dark:text-red-500 hover:underline mx-1"
                                                    >
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        ))}
                                        </tbody>
                                    </table>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
