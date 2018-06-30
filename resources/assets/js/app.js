
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.Vue.prototype.authorize = function (handler) {
    let user = window.App.user;
    return user ? handler(user) : false;
}
import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('replies', require('./components/Replies.vue'));
Vue.component('reply', require('./components/Reply.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('ThreadView', require('./pages/Thread.vue'));

Vue.component('html-textarea',{
    template:'<div contenteditable="true" @input="updateHTML"></div>',
    props:['value'],
    mounted: function () {
      this.$el.innerHTML = this.value;
    },
    methods: {
      updateHTML: function(e) {
        this.$emit('input', e.target.innerHTML);
      }
    }
  });
  
const app = new Vue({
    el: '#app'
});
