
<template>
  <div class="draw-history">
    <div class="row">    
      <b-button href="http://www.lightinside.co.za/elizabethmeyer/lotto-draw-machine/lotto-csv-api/drawresults.csv" variant="secondary" size="sm" class="mt-5 col-sm-2 offset-sm-10">Export All</b-button>
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
      newVal = JSON.parse(newVal)
      this.last10Draws.unshift(newVal)
      if (this.last10Draws.length > 10)
        this.last10Draws.pop()
      this.writeToCSV(newVal)
    }
  },
  methods: {
    writeToCSV (drawData) {
      const url = 'http://www.lightinside.co.za/elizabethmeyer/lotto-draw-machine/lotto-csv-api/writeToCSV/'   

      $.ajax({
          url: url,
          type: 'POST',
          data: drawData
      })
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
