require('./bootstrap');
import {createApp} from 'vue'
	import CommentComponent from './components/CommentComponent'
	createApp({
		components: {
			CommentComponent,
		}
	}).mount('#app')