const baseURL = 'http://localhost/php-todo-list-json/tasks/';

const { createApp } = Vue;

const app = createApp({
	data() {
		return {
			helloWorld: 'hello world',
			tasks: [],
		};
	},
	mounted() {
		axios.get(baseURL).then(({ data }) => {
			this.tasks = data;
		});
	},
});

app.mount('#app');
