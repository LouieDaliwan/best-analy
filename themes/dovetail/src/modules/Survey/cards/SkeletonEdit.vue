<template>
  <v-row>
    <v-col cols="12">
      <v-card>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
            </v-col>
            <v-col cols="12">
              <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
            </v-col>
            <v-col cols="12">
              <v-skeleton-loader height="120" type="image"></v-skeleton-loader>
            </v-col>
          </v-row>
        </v-card-text>

        <!-- Divider -->
        <div class="d-flex my-6">
          <v-divider></v-divider>
          <span class="muted--text mx-3 mt-n3"><strong>{{ trans('Fields') }}</strong></span>
          <v-divider></v-divider>
        </div>
        <!-- Divider -->

        <!-- Group and Field -->
        <v-card-text class="selects">
          <section>
            <v-row>
              <v-col>
                <v-card>
                  <v-toolbar dark color="muted" class="sticky elevation-1">
                    <v-avatar><v-icon>mdi-circle</v-icon></v-avatar>
                    <v-spacer></v-spacer>
                    <v-toolbar-title class="headline font-weight-bold"></v-toolbar-title>
                    <v-spacer></v-spacer>
                  </v-toolbar>

                  <v-card-text>
                    <v-row>
                      <v-col cols="auto" md="1" class="d-none d-md-block">
                        <div class="group-separator"></div>
                      </v-col>
                      <v-col>
                        <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>

                        <!-- Field Repeater -->
                        <section>
                          <v-row align="center">
                            <v-col cols="12">
                              <v-card class="mb-4">
                                <v-card-text>
                                  <div class="d-flex align-center justify-space-between">
                                    <div>
                                      <span class="text--text muted--text headline font-weight-bold">1</span>
                                    </div>
                                  </div>

                                  <v-row>
                                    <v-col cols="auto" md="1" class="d-none d-md-block">
                                      <div class="field-separator"></div>
                                    </v-col>
                                    <v-col>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                          <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                          <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
                                        </v-col>
                                        <v-col cols="12">
                                          <div class="my-3">
                                            <h4 class="mb-3 muted--text">{{ trans('Choose Category') }}:</h4>
                                            <v-skeleton-loader class="mb-6" height="56" type="image"></v-skeleton-loader>
                                          </div>
                                        </v-col>
                                      </v-row>
                                    </v-col>
                                  </v-row>
                                </v-card-text>
                              </v-card>
                            </v-col>
                          </v-row>
                        </section>
                        <!-- Field Repeater -->
                      </v-col>
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </section>
        </v-card-text>
        <!-- Group and Field -->
      </v-card>
    </v-col>
  </v-row>
</template>
