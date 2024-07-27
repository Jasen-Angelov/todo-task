import { Head, useForm } from "@inertiajs/react";
import { createTodo } from "@/Helpers/api.js";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";

export default function Create() {
    const { data, setData, reset } = useForm({ description: "" });

    const onSubmit = async (e) => {
        e.preventDefault();
        try {
            await createTodo(data);
            alert('New todo added successfully!');
            reset();
        } catch (error) {
            alert('Something went wrong!');
        }
    };

    return (
        <>
            <Head title="Create Todo" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <form
                            onSubmit={onSubmit}
                            className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                        >
                            <div className="mt-4">
                                <InputLabel htmlFor="todo_description" value="Todo description" />
                                <TextInput
                                    id="todo_description"
                                    type="text"
                                    name="description"
                                    value={data.description}
                                    className="mt-1 block w-full"
                                    isFocused={true}
                                    onChange={(e) => setData('description', e.target.value)}
                                />
                            </div>
                            <div className="mt-4 text-right">
                                <button
                                    type="submit"
                                    className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                                >
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}
