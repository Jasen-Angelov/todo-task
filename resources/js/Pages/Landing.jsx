import { Head } from '@inertiajs/react';
import { useState, useCallback } from "react";
import LaravelLogo from "@/Components/LaravelLogo.jsx";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faPlus } from '@fortawesome/free-solid-svg-icons';
import Create from "@/Pages/Todo/Create.jsx";
import SecondaryButton from "@/Components/SecondaryButton.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import {fetchTodos} from "@/Helpers/api.js";
import TodoTable from "@/Pages/Todo/TodoTable.jsx";

export default function Landing(){
    const [data, setData] = useState({ data: [] });
    const [view, setView] = useState('index');

    const handleLoad = useCallback(async () => {
        try {
            fetchTodos().then((res) => {
                if (res.data.success) {
                    setData(res.data);
                    setView('index');
                    return
                }
                alert('Something went wrong!');
            });
        } catch (error) {
            alert('Something went wrong!')
        }
    }, []);

    const handleCreate = () => {
        setView('create');
    };
    return (
        <>
            <Head title="Landing" />
            <div className=" sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                <div className="max-w-7xl mx-auto p-6 lg:p-8">
                    <LaravelLogo />
                    <div className="mt-16">
                        <div className="mt-16">
                            <div className="grid grid-cols-2">
                                <PrimaryButton
                                    onClick={handleLoad}
                                    className="px-4 py-2 bg-blue-500 text-white rounded ml-8 mr-1"
                                >
                                    Load Todos
                                </PrimaryButton>
                                <SecondaryButton
                                    onClick={handleCreate}
                                    className="px-4 bg-grer py-2 rounded ml-1 mr-8"
                                    disabled={view !== 'index'}
                                >
                                    <FontAwesomeIcon icon={faPlus} className={'mr-1'}/>Create Todo
                                </SecondaryButton>

                            </div>
                        </div>
                        <div className="grid grid-cols-1">
                            {view === 'index' ? <TodoTable todos={data} /> : <Create />}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
