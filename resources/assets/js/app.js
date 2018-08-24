
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import VueYoutube from 'vue-youtube'
//
// Vue.use(VueYoutube)

import VueYouTubeEmbed from 'vue-youtube-embed'
Vue.use(VueYouTubeEmbed);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('gazeupon-listener', require('./components/GazeUponListener.vue'));
Vue.component('vimeo-player', require('./components/VimeoPlayer.vue'));
Vue.component('youtube-player', require('./components/YoutubePlayer.vue'));

Vue.component('control-panel', require('./components/ControlPanel.vue'));

const app = new Vue({
    el: '#vue-app'
});
