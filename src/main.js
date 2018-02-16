import Vue from 'vue'
import BootstrapVue from "bootstrap-vue"
import App from './App.vue'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap-vue/dist/bootstrap-vue.css"
import drawLotto from './components/drawlotto.vue'
import drawHistory from './components/drawhistory.vue'

Vue.use(BootstrapVue)
Vue.component('drawLotto', drawLotto);
Vue.component('drawHistory', drawHistory);

var vm = new Vue({
  el: '#app',
  render: h => h(App)
})
