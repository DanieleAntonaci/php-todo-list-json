<script >
import axios from 'axios';


export default {
    data() {
        return {
            apiUrl: "http://localhost:8888/",
            todoList: [],
            newTodo: ''

        }
    },
    methods: {
        getData() {
            // funzione per ottenere i dati dal server
            axios.get(this.apiUrl + "api.php")
                .then(res => {

                    const data = res.data;

                    this.todoList = data;
                });

        },
        formSubmit(e) {
            // funzione per l'aggiunta di un nuovo task
            e.preventDefault();
            if (this.newTodo != '') {

                const params = {
                    params: {
                        'newTodo': this.newTodo
                    }
                };
                axios.get(this.apiUrl + 'api-create-todo.php', params)
                    .then(() => {
                        this.getData();
                    });
                this.newTodo = '';
                console.log(this.todoList);
            }
        },
        completedTask(task, todoElement) {
            // funzione per il task completato o non completato

            // inverte il valore booleano
            let invertBollean = this.todoList[task].completed == true ? false : true;

            const params = {
                'taskStatus': invertBollean,
                'position': task,
                'element': todoElement,
            };

            axios.get(this.apiUrl + 'api-completed.php', { params })
                .then(() => {
                    this.getData();
                });
        }, deleteTask(index) {

            const params = {
                'index': index
            }

            axios.get(this.apiUrl + 'api-delete.php', { params })
                .then(() => {
                    this.getData();
                })
            console.log(this.todoList);
        }
    },
    mounted() {
        this.getData();
    }
}
</script>

<template>
    <div id="main">

        <h1>Todo List</h1>
        <ul>
            
            <li v-for="(todoElement, index) in todoList" :key="index">
                
                <span :class="todoElement.completed ? 'done' : ''"  @click="completedTask(index, todoElement.text)">
                    {{ todoElement.text }}

                </span>
                
                
                <button @click="deleteTask(index)" class="btn">
                    <font-awesome-icon icon="fa-solid fa-trash" />
                </button>
            </li>

            
        </ul>
        
        <form @submit="formSubmit">
            <input type="text" name="newTodo" v-model="newTodo" class="input-text">
            <input type="submit" value="newTodo" class="btn">
        </form>
    </div>
</template>

<style lang="scss" scoped>
#main {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

    background-color: #001632;
    height: 100vh;
    width: 100%;

    font-size: 2rem;

    h1 {
        color: #6d767d;
    }

    ul {

        background-color: white;
        border-radius: 7px;
        margin: 20px 0;

        li {
            list-style-type: none;
            padding: 20px;
            min-width: 600px;
            border-bottom: #6d767d 1px solid;
            display: flex;
            justify-content: space-between;

            button {
                padding: 3px 10px;
                background-color: red;
                color: white;
                font-size: 20px;
                border: 0;
                border-radius: 8px;
            }

            .done {
                text-decoration: line-through;

            }
        }
    }

    form {
        input {
            height: 60px;

            &.input-text {
                width: 400px;
                vertical-align: middle;
                border-radius: 5px 0 0 5px;
                font-size: 25px;
                padding-left: 15px;
            }

            &.btn {
                width: 200px;
                font-size: 20px;
                border-radius: 0 5px 5px 0;
                vertical-align: middle;
                border: 1px #f6b80b solid;
                background-color: #001632;
                color: #f6b80b;

            }
        }
    }

}
</style>
