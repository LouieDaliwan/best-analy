<template :dark="$store.getters['app/app'].dark">
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex md4 sm6 xs12>
        <v-card hover class="mb-3">
          <carousel
            :autoplayTimeout="1000"
            :paginationActiveColor="app.dark ? '#38a3ee' : '#0c5689'"
            paginationColor="grey"
            :perPage="1"
            autoplay
            >
            <template
              v-for="(item, i) in carousel.items"
              >
              <slide :key="i">
                <v-card flat :href="item.link">
                  <v-img
                    height="160"
                    :src="item.thumbnail"
                    >
                  </v-img>
                  <v-card-text>
                    <p
                      class="caption mb-2 primary--text">
                      <strong v-html="trans(item.category)"></strong>
                    </p>
                    <v-tooltip bottom>
                      <h3
                        slot="activator"
                        class="subheading font-weight-bold mb-2 title__text--ellipsis"
                        v-html="trans(item.title)"
                        >
                      </h3>
                      <span v-html="trans(item.title)"></span>
                    </v-tooltip>
                    <!-- rating -->
                    <div class="mb-3">
                      <v-icon color="secondary" small>star</v-icon>
                      <v-icon color="secondary" small>star</v-icon>
                      <v-icon color="secondary" small>star</v-icon>
                      <v-icon color="secondary" small>star_half</v-icon>
                      <v-icon color="secondary" small>star_border</v-icon>
                    </div>
                    <!-- rating -->
                    <p>
                      <span
                        class="text--ellipsis"
                        v-html="trans(item.description)"
                        >
                      </span>
                    </p>
                  </v-card-text>
                </v-card>
              </slide>
            </template>
          </carousel>
        </v-card>

        <!-- <v-snackbar
          :color="app.dark ? 'white' : 'dark'"
          :timeout="course.snackbarTimeout"
          bottom
          right
          v-model="course.snackbar"
          >
          <span
            class="subheading"
            :class="app.dark ? 'black--text' : 'white--text'"
            >
            {{ trans('You have already finished this part of the lesson') }}
          </span>
          <v-btn
            @click="course.snackbar = false"
            icon
            >
            <v-icon
              :class="app.dark ? 'black--text' : 'white--text'"
              >
              close
            </v-icon>
          </v-btn>
        </v-snackbar> -->
      </v-flex>
    </v-layout>
  </v-container>
</template>

<style lang="stylus" scoped>
  // code
</style>

<script>
  import store from '@/store'
  import { mapGetters } from 'vuex'
  import { Carousel, Slide } from 'vue-carousel'

export default {
  // mounted() {
  //   let token = window.localStorage.getItem('jwt');

  //   window.axios.defaults.headers.common['Content-Type'] = 'application/json'
  //   window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

  //   window.axios.get('/api/v1/users/all').then(response => {
  //     // console.log(response);
  //   });
  // }
  store,

  name: 'Dashboard',

  components: {
    Carousel,
    Slide,
  },

  computed: {
    ...mapGetters({
      app: 'app/app'
    }),
  },

  data () {
    return {
      test: {
        timestamp: false,
        slug: false,
        author: false,
        created: false,
        modified: false,
        selected: [],
        bulkDestroy: false,
        selectAll: true,
        search: '',
        cardLink: '/admin/courses/show',
        chip: true,
        hover: true,
        lg3: false,
        showMimetype: false,
        showToolbar: false,
        headers: [
          { text: 'ID', value: 'id' },
          { text: 'Featured', value: 'thumbnail' },
          { text: 'Title', value: 'title' },
          { text: 'Category', value: 'category' },
          { text: 'Part', value: 'part' },
          { text: 'Status', value: 'status' },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false,
            align: 'center'
          },
        ],
        items: [
          {
            id: '1',
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//preview.ibb.co/cMCYYz/card_Media.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
            status: 'enrolled'
          },
          {
            id: '2',
            title: 'Solve Problems and Make Decisions at Supervisory Level',
            thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '3',
            title: 'Communicate and Relate Effectively at the Workplace at Operations Level',
            thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '4',
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
        ]
      },
      course: {
        snackbar: true,
        snackbarTimeout: 0,
      },
      carousel: {
        items: [
          {
            thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            title: 'My Carousel Card',
            description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ut maiores enim magnam, commodi quis autem blanditiis, eligendi facere, atque optio natus animi quas repellat tempora fugit rem unde eaque ! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, maxime. A similique repellat eligendi asperiores excepturi obcaecati repudiandae dicta? Voluptatem ex ducimus placeat eius magnam debitis minus saepe. Ex, veniam? ',
            link: 'https://www.google.com/',
            category: 'DPE SUP'
          },
          {
            thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
            title: 'My Carousel Card',
            description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ut maiores enim magnam, commodi quis autem blanditiis, eligendi facere, atque optio natus animi quas repellat tempora fugit rem unde eaque!',
            link: 'https://www.pinterest.com/',
            category: 'PSDM SUP'
          },
          {
            thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
            title: 'My Carousel Card',
            description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ut maiores enim magnam, commodi quis autem blanditiis, eligendi facere, atque optio natus animi quas repellat tempora fugit rem unde eaque!',
            link: 'https://www.medium.com/',
            category: 'PSDM SUP'
          }
        ]
      },
    }
  }
}
</script>
