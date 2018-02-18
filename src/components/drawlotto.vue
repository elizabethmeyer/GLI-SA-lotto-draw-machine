<template>
  <div class="draw-machine card">
    <div class="card-body">
      <div class="row">
        <b-alert variant="danger"
          class="col-sm"
          :show="(powerballDraw.drawSize == 0)">
          There won't be a powerball draw.
        </b-alert>
      </div>

      <div class="row">    
        <b-form-group
          id="mainSetSizeGroup"
          class="col-sm"
          label="Number of balls in main draw set:"
          label-for="mainSetSize"
          :state="mainSetSizeState"
          :invalid-feedback="mainSetSizeFeedback"
          :valid-feedback="mainSetSizeFeedback"
        >
          <b-form-input id="mainSetSize"
            required
            v-model="mainDraw.setSize"
            type="number"
            :state="mainSetSizeState" 
            ></b-form-input>
        </b-form-group>
    
        <b-form-group
          id="mainDrawSizeGroup"
          class="col-sm"
          label="Number of balls in main draw:"
          label-for="mainDrawSize"
          :state="mainDrawSizeState"
          :invalid-feedback="mainDrawSizeFeedback"
          :valid-feedback="mainDrawSizeFeedback"
        >
          <b-form-input id="mainDrawSize"
            required
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
          label="Number of balls in the powerball set:"
          label-for="powerballSetSize"
          :state="powerballSetSizeState"
          :invalid-feedback="powerballSetSizeFeedback"
          :valid-feedback="powerballSetSizeFeedback"
        >
          <b-form-input id="powerballSetSize"
            required
            v-model="powerballDraw.setSize"
            type="number"
            :state="powerballSetSizeState"
            ></b-form-input>
        </b-form-group>

        <b-form-group
            id="powerballDrawSizeGroup"
            class="col-sm"
            description="(Choose 0 for no powerball draw)"
            label="Number of balls in powerball draw:"
            label-for="powerballDrawSize"
            :state="powerballDrawSizeState"
            :invalid-feedback="powerballDrawSizeFeedback"
            :valid-feedback="powerballDrawSizeFeedback"
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
          variant="primary" size="lg" class="col-sm-4 offset-4" 
          :disabled="!playReadyState"
          v-on:click="playLotto()">
          Play</b-button>  
      </div>

    </div>
  </div>
</template>

<script>

export default {
  name: 'drawMachine',
  computed: {
    mainSetSizeState () {
      return (this.mainDraw.setSize >= this.mainDraw.minSetSize && this.mainDraw.setSize <= this.mainDraw.maxSetSize)
    },
    mainSetSizeFeedback () {
      return 'Number between ' + this.mainDraw.minSetSize + ' and ' + this.mainDraw.maxSetSize
    },
    mainDrawSizeState () {
      return (this.mainDraw.drawSize >= this.mainDraw.minDrawSize && this.mainDraw.drawSize <= this.mainDraw.maxDrawSize)
    },
    mainDrawSizeFeedback () {
      return 'Number between ' + this.mainDraw.minDrawSize + ' and ' + this.mainDraw.maxDrawSize
    },        
    powerballSetSizeState () {
      return (this.powerballDraw.setSize >= this.powerballDraw.minSetSize && this.powerballDraw.setSize <= this.powerballDraw.maxSetSize)
    },
    powerballSetSizeFeedback() {
      return 'Number between ' + this.powerballDraw.minSetSize + ' and ' + this.powerballDraw.maxSetSize
    },
    powerballDrawSizeState () {
      return (this.powerballDraw.drawSize >= this.powerballDraw.minDrawSize && this.powerballDraw.drawSize <= this.powerballDraw.maxDrawSize)
    }, 
    powerballDrawSizeFeedback() {
      return 'Number between ' + this.powerballDraw.minDrawSize + ' and ' + this.powerballDraw.maxDrawSize
    },    
    playReadyState () {
      return (this.mainSetSizeState && this.mainDrawSizeState && this.powerballSetSizeState && this.powerballDrawSizeState)
    }
  },

  methods: {
  
    doDraw: function(setSize, drawSize) {
      var ballDrawn
      var results = []
      while(results.length < drawSize) {
        ballDrawn = Math.floor(Math.random() * setSize) + 1
        if (results.indexOf(ballDrawn) == -1) {
          results.push(ballDrawn);
        }
      }
      return results
    },

    playLotto: function () {  
      if (this.mainDraw.drawSize)
        this.draw.drawResult = this.doDraw(this.mainDraw.setSize, this.mainDraw.drawSize)
      if (this.powerballDraw.drawSize)
        this.draw.drawResult = this.draw.drawResult.concat(this.doDraw(this.powerballDraw.setSize, this.powerballDraw.drawSize));
      this.draw.drawTime = new Date().toLocaleString();
      this.draw.mainBallsDrawn = this.mainDraw.drawSize
      this.draw.powerballBallsDrawn = this.powerballDraw.drawSize
      this.$emit('newdraw',JSON.stringify(this.draw))
    }    

  },
  
  data: function () {
    return {
      mainDraw : {
        setSize: 40,
        minSetSize:40,
        maxSetSize: 49,
        drawSize: 5,
        minDrawSize: 5,
        maxDrawSize: 7
      },
      powerballDraw : {
        setSize: 5,
        minSetSize: 5,
        maxSetSize: 49,
        drawSize: 1,
        minDrawSize: 0,
        maxDrawSize: 3
      },
      draw: {
        drawTime: '',
        drawResult: [],
        mainBallsDrawn: 0,
        powerballBallsDrawn: 0,
      }
    }
  }
}
</script>