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
<div class="container">
<?php $form = ActiveForm::begin([
            'action' => 'index.php?r=todo/save',
            'options' => [
                'class' => 'form-horizontal',
                'onkeypress' => "return event.keyCode != 13;"
            ],
        ]);
?>
<div id="app">
    <br>
    <br>
    <br>
    <h1>{{title}}</h1>
    <label>
    <input type="text" class="nes-input" placeholder="Add something to do..." v-on:keyup.enter="addTodo" name ="todo[]">
    </label>
    <br>
    <br>
    <h6>(click the checkbox next to a ToDo to mark it as complete, and the 'X' button to remove.)</h6>
    <ul>
        <li v-for="todo in todos" :key="todo.id" class="flex">
            <label class="list">
                <input type="checkbox" id="check" class="nes-checkbox" v-model="todo.done">
                <span>&nbsp</span>
            </label>
            <del v-if="todo.done">{{ todo.text }}</del>
            <span v-else>{{ todo.text }}</span>
            <div class="space"></div>
            <button class="nes-btn is-error padding" v-on:click="removeTodo(todo.id)">X</button>
        </li>
    </ul>
</div>
<!--<button type="submit" class="nes-btn">Save</button>-->
<?php $form = ActiveForm::end(); ?>
</div>
</body>
</html>

<script>
    new Vue({
        el: "#app",
        data: {
            title: 'ToDos before Sunset',
            todos: [
                {text: 'Get to the beach', done: false, id: Date.now()},
                {text: 'Watch the daylight fade', done: false, id: Date.now() + 1}
            ]
        },
        methods: {
            addTodo({target}) {
                const text = event.target.value
                this.todos.unshift({text: target.value, done: false, id: Date.now()})
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
    @keyframes capo {
        0% {
            transform: scale(0.1);
            opacity: 0;
        }
        60% {
            transform: scale(1.2);
            opacity: 1;
        }
        100% {
            transform: scale(1);
        }
    }

    div {
        /*width: 100px;*/
        /*height: 100px;*/
        -webkit-animation-name: capo; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 1s; /* Safari 4.0 - 8.0 */
        animation-name: capo;
        animation-duration: 1s;
    }

    body {
        margin-left: 30px;
        color:white;
        background: url("../src/img/capo.JPG");
        background-size: 100%;
    }

    .list {
        background: burlywood;
    }

</style>