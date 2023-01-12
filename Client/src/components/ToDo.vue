<script >
import axios from 'axios';


export default {
    data() {
        return {
            apiUrl: "http://localhost:8888/",
            todoList: [],

        }
    },
    methods: {
        getData() {
            axios.get(this.apiUrl + "api.php")
                .then(res => {

                    const data = res.data;

                    this.todoList = data;
                });

        }
    },
    mounted() {
        this.getData();
    }
}
</script>

<template>
  gg
</template>

<style lang="scss" scoped>

</style>
