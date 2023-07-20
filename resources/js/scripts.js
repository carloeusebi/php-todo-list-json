const baseURL = 'http://localhost/php-todo-list-json/tasks/';

const { createApp } = Vue;

const app = createApp({
	data() {
		return {
			tasks: [],
			newTask: '',
		};
	},
	methods: {
		handleTaskClick(id) {
			console.log(this.tasks);
			const taskToUpdate = this.tasks.find(task => task.id === id);

			taskToUpdate.completed = !taskToUpdate.completed;
		},
		addTask() {
			if (!this.newTask) return;

			const params = {
				task: this.newTask,
			};

			const config = {
				headers: { 'Content-Type': 'multipart/form-data' },
			};

			axios.post(baseURL, params, config).then(({ data }) => {
				this.tasks.push(data);
			});

			this.newTask = '';
		},
	},
	mounted() {
		axios.get(baseURL).then(({ data }) => {
			this.tasks = data;
		});
	},
});

app.mount('#app');
