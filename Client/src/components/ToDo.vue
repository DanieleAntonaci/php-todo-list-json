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
            axios.get(this.apiUrl + "api.php")
                .then(res => {

                    const data = res.data;

                    this.todoList = data;
                });

        },
        formSubmit(e) {
            e.preventDefault();

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
        },
        completedTask(task, todoElement) {
            let invert = this.todoList[task].completed == true ? false : true;
            const params = {
                'taskStatus': invert,
                'position': task,
                'element': todoElement,
            }
            axios.get(this.apiUrl + 'api-completed.php', { params })
                .then(() => {
                    this.getData();
                });
            console.log(this.todoList[task].completed, invert);
        }
    },
    mounted() {
        this.getData();
    }
}
</script>

<template>
    <form @submit="formSubmit">
        <input type="text" name="newTodo" v-model="newTodo">
        <input type="submit" value="newTodo">
    </form>

  <ul>

    <li v-for="(todoElement, index) in todoList" :key="index" :class="todoElement.completed ? 'done' : ''">
        {{ todoElement.text }}
        {{ todoElement.completed }}
        <button @click="completedTask(index, todoElement.text)"> ok</button>
    </li>

  </ul>

</template>

<style lang="scss" scoped>
ul {
    li {
        list-style-type: none;

        &.done {
            text-decoration: line-through;
        }
    }
}
</style>
