
<template>
  <div class="draw-history">
    <div class="row">    
      <b-button variant="secondary" size="sm" class="mt-5 col-sm-2 offset-sm-10">Export All</b-button>
    </div>
    <div class="row">
      <h2>Last 10 draw results:</h2>
      <b-table striped hover :items="this.last10Draws"></b-table>
    </div>
  </div>
</template>

<script>

export default {
  props: [
    'drawData'
  ],
  watch: { 
    drawData: function(newVal, oldVal) { 
      console.log(this.last10Draws)
      this.last10Draws.unshift(JSON.parse(newVal))
      if (this.last10Draws.length = 11)
        this.last10Draws.pop()
    }
  },
  data: function () {
    return {
      last10Draws: [
      ]
    }
  }

}
</script>
