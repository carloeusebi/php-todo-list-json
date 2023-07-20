const URL = 'http://localhost/php-todo-list-json/tasks/';

const { createApp } = Vue;

const app = createApp({
	data() {
		return {
			helloWorld: 'hello world',
		};
	},
});

app.mount('#app');
