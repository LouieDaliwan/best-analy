<template>
  <section>
    <v-form
      @submit.prevent="storeData"
      method="POST"
      >
      <v-card
        flat
        class="sticky emphasis--bg toolbar-mobile"
        >
        <v-container grid-list-lg>
          <v-layout row wrap>
            <v-icon size="16" class="primary--text">mdi-arrow-left</v-icon>
            <v-btn flat class="transparent" exact :to="{ name: 'pages.index' }">
              <span class="subheading primary--text">
                {{ __('All Pages') }}
              </span>
            </v-btn>
          </v-layout>
          <v-layout row wrap justify-space-between>
            <h1 class="display-1">
              {{ __('Create Page') }}
            </h1>
            <v-btn
              class="mx-0"
              color="secondary"
              type="submit"
              >
              {{ __('Save') }}
            </v-btn>
          </v-layout>
        </v-container>
      </v-card>
      <v-container grid-list-lg>
        <v-layout row wrap>
          <v-flex md9 xs12>
            <v-card>
              <v-card-text>
                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Page Title') }}
                </h1>
                <v-text-field
                  :data-vv-as="trans('Title')"
                  :error-messages="errors.collect('title')"
                  :hint="trans('Tap the icon to edit this page\'s slug')"
                  @click:append="resource.viewSlug = !resource.viewSlug"
                  @input="slugify"
                  append-icon="mdi-circle-edit-outline"
                  autofocus
                  placeholder="e.g. My First Page"
                  box
                  name="title"
                  single-line
                  v-model="resource.title"
                  v-validate="'required'"
                ></v-text-field>
                <v-slide-y-transition mode="out-in">
                  <v-text-field
                    :append-icon="resource.lockSlug ? 'lock' : 'lock_open'"
                    :error-messages="errors.collect('slug')"
                    :hint="trans('Locking this field will prevent the title field from overriding this current value')"
                    :label="trans('Slug')"
                    :placeholder="trans('app://your-custom-url-here')"
                    :readonly="resource.lockSlug"
                    @blur="resource.lockSlug = true"
                    @click:append="resource.lockSlug = !resource.lockSlug"
                    outline
                    class="mb-2"
                    name="slug"
                    persistent-hint
                    v-focus
                    v-if="resource.viewSlug"
                    v-model.trim="resource.slug"
                    v-validate="'required'"
                  ></v-text-field>
                </v-slide-y-transition>

                <v-text-field
                  :data-vv-as="trans('Code')"
                  :error-messages="errors.collect('code')"
                  v-validate="'required'"
                  @click:append="() => {resource.lockSlug = !resource.lockSlug}"
                  box
                  autofocus
                  label="Code"
                  name="code"
                  v-model="resource.code"
                ></v-text-field>

                <!-- slug not saved to store -->
                <!-- <v-text-field
                  v-model="resource.title"
                  single-line
                  type="text"
                  name="title"
                  autofocus
                  placeholder="e.g. My First Page"
                  box
                ></v-text-field>

                <v-text-field
                  :value="slug"
                  box
                  single-line
                  type="text"
                  name="code"
                  auto-focus
                  placeholder="e.g. my-first-page"
                  >
                </v-text-field> -->
                <!-- slug not saved to store -->

                <!-- Forms -->

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Page Content') }}
                </h1>
                <v-textarea
                  :data-vv-as="trans('Page Content')"
                  box
                  autofocus
                  single-line
                  name="body"
                  placeholder="Describe Content"
                  row="9"
                  v-model="resource.body"
                ></v-textarea>
              </v-card-text>
            </v-card>
          </v-flex>

          <v-flex md3 xs12>
            <v-card
              height="200"
              hover
              class="transparent upload-image emphasis--border mb-3"
              >
              <v-layout row wrap justify-center align-center fill-height>
                <v-card-text class="text-xs-center grey--text">
                  <v-icon size="50" class="text--lighten-1 grey--text">mdi-google-photos</v-icon>
                  <p>
                    {{ __('Click to upload photo') }}
                  </p>
                </v-card-text>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-form>
    <dialogbox></dialogbox>
  </section>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'Create',

  $_veeValidate: {
    validator: 'new'
  },

  computed: {
    ...mapGetters({
      snackbar: 'snackbar/snackbar',
      dialogbox: 'dialogbox/dialogbox',
    }),
    slug: function() {
      var slug = this.sanitizeTitle(this.resource.title);
      return slug;
    }
  },

  data () {
    return {
      resource: {
        lockSlug: false,
        viewSlug: false,
        title: '',
      },
    }
  },

  mounted () {
    this.ckEditor();
  },

  methods: {
    sanitizeTitle: function(title) {
      var slug = "";
      // Change to lower case
      var titleLower = title.toLowerCase();
      // Letter "e"
      slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
      // Letter "a"
      slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
      // Letter "o"
      slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
      // Letter "u"
      slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
      // Letter "d"
      slug = slug.replace(/đ/gi, 'd');
      // Trim the last whitespace
      slug = slug.replace(/\s*$/g, '');
      // Change whitespace to "-"
      slug = slug.replace(/\s+/g, '-');

      return slug;
    },

    slugify ($value) {
      // if (!this.resource.lockSlug) {
      //   if (typeof $value === 'undefined') {
      //     this.resource.slug = this.$options.filters.slugify(this.resource.title)
      //   } else {
      //     this.resource.slug = this.$options.filters.slugify($value)
      //   }
      // }
    },

    ckEditor () {
      ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .catch( error => {
        console.error( error );
      } );
    },

    beforeFormSubmit () {
      this.$validator.reset()
      this.$validator.validateAll()
        .then(ok => {
          if (ok) {
            this.storeData()
          }
        })
    },

    storeData () {
      axios
        .post('/api/v1/pages/store', this.resource)
        .then((response) => {
          // console.log(this.resource, 'data')
          this.$router.push({name: 'pages.index'})
          this.$store.dispatch(
            'snackbar/TOGGLE_TOAST',
            Object.assign(
              this.snackbar,
              {
                model: true,
                // icon: 'add',
                // iconColor: 'success--text',
                text: 'Delete Resources',
              }
            )
          )
          // push to Create.vue view
        })
    },
  },
}
</script>
