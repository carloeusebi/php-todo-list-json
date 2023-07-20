const baseURL = 'http://localhost/php-todo-list-json/tasks/';

const { createApp } = Vue;
const config = {
	headers: { 'Content-Type': 'multipart/form-data' },
};

const app = createApp({
	data() {
		return {
			tasks: [],
			newTask: '',
		};
	},
	methods: {
		handleTaskClick(id) {
			const taskToUpdate = this.tasks.find(task => task.id === id);
			taskToUpdate.completed = !taskToUpdate.completed;

			const params = { ...taskToUpdate };

			axios.post(baseURL, params, config);
		},
		addTask() {
			if (!this.newTask) return;

			const params = {
				task: this.newTask,
			};

			axios.post(baseURL, params, config).then(res => {
				this.tasks.push(res.data);
			});

			this.newTask = '';
		},
		deleteTask(id) {
			const params = {
				data: { id },
			};
			axios.delete(baseURL, params);

			this.tasks = this.tasks.filter(task => task.id !== id);
		},
	},
	mounted() {
		axios.get(baseURL).then(({ data }) => {
			this.tasks = data;
		});
	},
});

app.mount('#app');
