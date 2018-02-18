<template>
  <div id="app" class="container">
    <div class="row">
      <h1 class="col-sm text-center p-3">{{ appTitle }}</h1>
    </div>
    <drawLotto v-on:newdraw="triggerDraw"></drawLotto>
    <drawHistory :draw-data="drawData"></drawHistory>
  </div>
</template>

<script>

export default {
  name: 'lotto-draw-machine',
  data () {
    return {
      appTitle: 'Lotto Draw Machine',
      drawData: {}
    }
  },
  methods: {
    triggerDraw: function (newDraw) {
      this.drawData = newDraw
    },
  },  
}
</script>
