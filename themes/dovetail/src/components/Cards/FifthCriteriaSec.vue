<template>
  <v-sheet class="sticky dt-sheet criteria">
    <v-slide-group single show-arrows>
      <v-slide-item>
        <v-banner class="dt-banner" elevation="1">
          <v-row justify="center" align="start">
          <v-col class="text-center" v-for="(rate, r) in rates" :key="r">
            <v-avatar color="primary" size="20" class="mb-2">
              <small class="white--text" :style="`${ rate.number === 'N/A' ? 'font-size: 10px' : ''}`">{{ rate.number }}</small>
            </v-avatar>
            <div class="overline" v-html="trans(rate.text)"></div>
          </v-col>
          </v-row>
        </v-banner>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script>
  export default {
    data: () => ({
      rates: [
        { number: '1', text: 'Least Satisfied' },
        { number: '2', text: '' },
        { number: '3', text: 'Satisfied' },
        { number: '4', text: '' },
        { number: '5', text: 'Very Satisfied' },
      ],
    })
  }
</script>
