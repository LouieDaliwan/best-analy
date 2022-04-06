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
            <div class="overline" v-html="rate.text"></div>
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
        { number: '0', text: 'I am not aware of any <br/> industry standards or <br/> certifications required' },
        { number: '0', text: 'There are no industry standards <br/>required in my business' },
        { number: '1', text: 'Minimum standards required <br/> by the authorities are met' },
        { number: '2', text: 'Critical certifications and standards <br/> are acquired to maintain <br/> high standards in the business	' },
        { number: '4', text: 'Certifications and Standards <br/> acquired over and above <br/> requirements to drive <br/> business growth & innovation' },
      ],
    })
  }
</script>
