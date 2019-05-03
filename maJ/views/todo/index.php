<?php use yii\widgets\ActiveForm; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mark J ToDo</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css@2.1.0/css/nes.min.css" rel="stylesheet" />
</head>
<body>
<?php $form = ActiveForm::begin([
            'action' => 'index.php?r=todo/save',
            'options' => [
                'class' => 'form-horizontal',
                'onkeypress' => "return event.keyCode != 13;"
            ],
        ]);
?>
<div id="app">
    <h1>{{title}}</h1>
    <input type="text" class="nes-input" placeholder="Add something to do..." v-on:keyup.enter="addTodo" name ="todo[]">

    <ul>
        <li v-for="todo in todos" :key="todo.id" class="flex">
            <label>
                <input type="checkbox" class="nes-checkbox" v-model="todo.done">
                <span>&nbsp</span>
            </label>
            <del v-if="todo.done">{{ todo.text }}</del>
            <span v-else>{{ todo.text }}</span>
            <div class="space"></div>
            <button class="nes-btn is-error padding" v-on:click="removeTodo(todo.id)">X</button>
        </li>
    </ul>
</div>
<button type="submit" class="nes-btn">Save</button>
<?php $form = ActiveForm::end(); ?>

</body>
</html>

<script>
    new Vue({
        el: "#app",
        data: {
            title: 'ToDos before Sunset',
            todos: [
                {text: '', done: false, id: Date.now()},
                // {text: 'todo 2', done: false, id: Date.now() + 1}
            ]
        },
        methods: {
            addTodo({target}) {
                const text = event.target.value
                this.todos.push({text: target.value, done: false, id: Date.now()})
                event.target.value = ''
            },
            removeTodo(id) {
                this.todos = this.todos.filter(todo => todo.id !== id)
            },
            check(todo) {
                todo.done = !todo.done
            }
        }
    })
</script>

<style>
    @keyframes example {
        from {background-color: blue;}
        to {background-color: yellow;}
    }

    div {
        /*width: 100px;*/
        /*height: 100px;*/
        background-color: blue;
        -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 5s; /* Safari 4.0 - 8.0 */
        animation-name: example;
        animation-duration: 10s;
    }

    body {
        background: lightblue url("../src/img/capo.JPG");
    }

</style>