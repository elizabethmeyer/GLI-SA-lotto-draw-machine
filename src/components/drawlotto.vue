<template>
  <div class="draw-machine">
    <div class="row">
      <b-alert variant="danger"
        class="col-sm"
        :show="(this.powerballDraw.setSize = 0)">
        There won't be a powerball draw.
      </b-alert>
    </div>

    <div class="row">    
      <b-form-group
        id="mainSetSizeGroup"
        class="col-sm"
        description="Between 40 and 49"
        label="Number of balls in main draw ball set:"
        label-for="mainSetSize"
        :state="mainSetSizeState"
        :invalid-feedback="'The main draw set should be between 40 and 49 balls.'"
        :valid-feedback="'&nbsp'"
      >
        <b-form-input id="mainSetSize"
          v-model="mainDraw.setSize"
          type="number"
          :state="mainSetSizeState"
          ></b-form-input>
      </b-form-group>
  
      <b-form-group
        id="mainDrawSizeGroup"
        class="col-sm"
        label="Number of balls in main draw:"
        description="Between 5 and 7"
        label-for="mainDrawSize"
        :state="mainDrawSizeState"
        :invalid-feedback="'The main draw size should be between 5 and 7 balls'"
        :valid-feedback="'&nbsp'"
      >
        <b-form-input id="mainDrawSize"
          v-model="mainDraw.drawSize"
          type="number"
          :state="mainDrawSizeState"
          ></b-form-input>
      </b-form-group>
    </div>
    
    <div class="row">

      <b-form-group
        id="powerballSetSizeGroup"
        class="col-sm"
        description="Between 5 and 49."
        label="Number of balls in the powerball ball set:"
        label-for="powerballSetSize"
        :state="powerballSetSizeState"
        :invalid-feedback="'The main draw set should be between 40 and 49 balls.'"
        :valid-feedback="'&nbsp'"
      >
        <b-form-input id="powerballSetSize"
          v-model="powerballDraw.setSize"
          type="number"
          :state="powerballSetSizeState"
          ></b-form-input>
      </b-form-group>

      <b-form-group
          id="powerballDrawSizeGroup"
          class="col-sm"
          description="Between 0 and 3. (Choose 0 for no powerball draw)"
          label="Number of balls in powerball draw:"
          label-for="powerballDrawSize"
          :state="powerballDrawSizeState"
          :invalid-feedback="'Choose a number between 0 and 3'"
          :valid-feedback="'&nbsp'"
        >
        <b-form-input id="powerballDrawSize"
          v-model="powerballDraw.drawSize"
          type="number"
          :state="powerballDrawSizeState"
          ></b-form-input>
      </b-form-group>
    </div>
    <div class="row">
      <b-button 
        variant="primary" size="lg" class="col-sm" 
        :disable="true"
        v-on:click="playLotto()">
        Play</b-button>  
    </div>
  </div>
</template>

<script>
var moment = require('moment')
export default {
  name: 'drawMachine',
  computed: {
    mainSetSizeState () {
      return (this.mainDraw.setSize >= 40 && this.mainDraw.setSize <= 49) ? true : false
    },
    mainDrawSizeState () {
      return (this.mainDraw.drawSize >= 5 && this.mainDraw.drawSize <= 7) ? true : false
    },    
    powerballSetSizeState () {
      return (this.powerballDraw.setSize >= 5 && this.powerballDraw.setSize <= 49) ? true : false
    },
    powerballDrawSizeState () {
      return (this.powerballDraw.drawSize >= 0 && this.powerballDraw.drawSize <= 3) ? true : false
    }, 
  },
  methods: {
    doDraw: function(drawData) {
      if (!drawData.hasDraw)
        return false;
      //doDraw takes one parameter of type drawObject and returns a value of type drawObject
      var ballDrawn
      drawData.drawTime = Date.now()
      drawData.drawResults = []
      while(drawData.drawResults.length < drawData.drawSize) {
        ballDrawn = Math.floor(Math.random() * drawData.setSize) 
        if (drawData.drawResults.indexOf(ballDrawn) == -1) {
          drawData.drawResults.push(ballDrawn);
        }
      }
      drawData.drawResults = JSON.stringify(drawData.drawResults)
      console.log(drawData.drawResults)      
      return drawData
    },
    playLotto: function () {  
      if (this.mainDraw.drawSize)
        this.mainDraw = this.doDraw(this.mainDraw)
      console.log( 'this.powerballDraw.hasDraw ' + this.powerballDraw.hasDraw)
      if (this.powerballDraw.drawSize) 
        this.powerballDraw = this.doDraw(this.powerballDraw)      
    }    
  },
  data: function () {
    return {
      mainDraw: {
        drawType: 'main',
        setSize: 40,
        drawSize: 5,
        drawResults: []
      },
      powerballDraw: {
        drawType: 'powerball',        
        setSize: 5,
        drawSize: 0,
        drawResults: []
      },
    }
  },
}
</script>