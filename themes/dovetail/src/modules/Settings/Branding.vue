<template>
  <section>
    <page-header>
      <template v-slot:title v-text="trans('General Settings')"></template>
    </page-header>

    <v-row>
      <v-col cols="12" md="8">
        <v-card>
          <v-card-title v-text="trans('Site Branding')"></v-card-title>

          <v-row>
            <v-col cols="12" md="8">
              <v-card-text>
                <v-text-field
                  :label="trans('Site Name')"
                  autofocus
                  class="mb-3"
                  outlined
                ></v-text-field>

                <v-text-field
                  :label="trans('Site Tagline/Description')"
                  class="mb-3"
                  outlined
                ></v-text-field>

                <v-text-field
                  :label="trans('Site Author')"
                  class="mb-3"
                  outlined
                ></v-text-field>

                <v-text-field
                  :label="trans('Site Email')"
                  class="mb-3"
                  outlined
                ></v-text-field>

                <v-text-field
                  :label="trans('Year Published')"
                  class="mb-3"
                  outlined
                ></v-text-field>
              </v-card-text>
            </v-col>

            <v-col cols="12" md="4">
              <v-card-text>
                <v-img
                  src="https://picsum.photos/500/300?image="
                  lazy-src="https://picsum.photos/10/6?image="
                  aspect-ratio="1"
                  class="muted"
                  >
                  <template v-slot:placeholder>
                    <v-row
                      class="fill-height ma-0"
                      align="center"
                      justify="center"
                      >
                      <v-progress-circular indeterminate color="grey lighten-4"></v-progress-circular>
                    </v-row>
                  </template>
                </v-img>
              </v-card-text>
            </v-col>
          </v-row>

          <v-card-text>
            <div class="d-flex justify-end">
              <v-btn large color="primary" v-text="trans('Save Settings')"></v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </section>
</template>
