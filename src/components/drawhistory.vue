<template>
  <div>
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
var moment = require('moment')

export default {
  data: function () {
    return {
      last10Draws: [
        { draw_time: Date.now() | moment("dddd, MMMM Do YYYY, h:mm:ss a"), main_draw_results:'1, 2, 3, 4, 5', has_powerball:true ? 'Yes' : 'No', powerball_draw_results:'1,2,3'},
        { draw_time: '21:21', main_draw_results:'1, 2, 3, 4, 5',  powerball_draw_results:false ? 'Yes' : 'No'}
      ]
    }
  },
  method: {

  }
}
</script>
