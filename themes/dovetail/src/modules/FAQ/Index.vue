<template>
  <admin>
    <page-header>
      <template v-slot:utilities>
        <!-- <p>{{ __('Instructional videos of the app.') }}</p> -->
      </template>
    </page-header>

    <!-- <div v-html="videos"></div> -->
    <!-- <template v-for="(contents, header) in videos">
      <h3 class="my-4" v-html="header"></h3>

      <ul>
        <template v-for="video in contents">
          <can :code="video.code">
            <li class="mb-4">
              <router-link class="title font-weight-normal text--decoration-none" tag="a" :to="{ name: 'faq.single', query: { url: video.url } }">{{ video.title }}</router-link>
            </li>
          </can>
        </template>
      </ul>
      <div style="height: 30px;"></div>
    </template> -->
    <!-- <v-container> -->
      <template class="g-0">
        <v-row justify="center" no-gutters>
          <v-expansion-panels flat focusable color="primary">
            <v-expansion-panel>
              <v-expansion-panel-header>Login to your SME Ratings account</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ol>
                  <li>Go to <a href="https://kfsme.khalifafund.ae" target="_blank">https://kfsme.khalifafund.ae</a>.</li>
                  <li>Click <strong>Username or Email</strong> and enter your email address.</li>
                  <li>Click <strong>Password</strong> and enter your password.</li>
                  <li>Click <strong>Sign in with Active Directory</strong> or <strong>Sign in</strong>.</li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>Retrieve case file from CRM</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ol>
                  <li>Click the <strong>Find Company button</strong> in the top right corner of the Dashboard page, or click the <strong>Company</strong> in the menu in the sidebar to reveal the submenus and click <strong>Find Company</strong>.</li>
                  <li><strong>Type</strong> the case file number into the search bar and click <strong>Enter</strong> on your keyboard.</li>
                  <li>
                    The CRM will respond depending on the status of the case file number on the CRM:
                    <ol type="a">
                      <li>If the case file number <strong>does not exist</strong> on the CRM, a notification 'Request with this File No does not exist will appear' in the upper middle of the page. <strong>Check</strong> with the CRM Developer the status of the case file number.</li>
                      <li>If the case file number <strong>exists</strong> on the CRM, it will show in the result below the search bar. Click <strong>Start</strong> to save case file number information in the SME Ratings.</li>
                    </ol>
                  </li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>Update case file information</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ol>
                  <li>Go to <strong>Dashboard</strong> to view all the companies you have added.</li>
                  <li>Under the <strong>Actions</strong> column, click the <strong>pencil icon</strong> on the same row of the case file you want to update. It will redirect you to a different page.</li>
                  <li>
                    You can find three tabs on the left side of the page: project information, applicant information, and financial statements.
                    <ul>
                      <li>
                        Update project information
                        <ol type="a">
                          <li>Click the tab <strong>project information</strong>.</li>
                          <li><strong>Enter</strong> the project information in the text field.</li>
                          <li>The required fields are <strong>Project Type</strong> and <strong>Investment Value</strong>, as they are influential components in the computation of financial statements.</li>
                          <li>Click <strong>Update</strong>.</li>
                        </ol>
                      </li>
                      <li>
                        Update applicant information
                        <ol type="a">
                          <li>Click the tab <strong>applicant information</strong>.</li>
                          <li><strong>Enter</strong> the applicant information in the text field.</li>
                          <li>Click <strong>Update</strong>.</li>
                        </ol>
                      </li>
                      <li>
                        Update financial information
                        <ol type="a">
                          <li>
                            Click the tab financial information.
                            <ul>
                              <li>
                                Add a new financial period
                                <ol type="a">
                                  <li>Click <strong>Add</strong> in the Periods section.</li>
                                  <li><strong>Enter</strong> the financial information in the text field.</li>
                                  <li>Click <strong>Update</strong>.</li>
                                </ol>
                              </li>
                              <li>
                                View the existing financial period
                                <ol type="a">
                                  <li>Click the year in the <strong>Periods</strong> section.</li>
                                </ol>
                              </li>
                              <li>
                                Edit the existing financial period
                                <ol type="a">
                                  <li>Click the <strong>year</strong> in the Periods section.</li>
                                  <li>Click the <strong>radio button</strong> opposite the year to edit financial information. </li>
                                  <li><strong>Enter</strong> the financial information in the text field.</li>
                                  <li>Click <strong>Update</strong>.</li>
                                </ol>
                              </li>
                            </ul>
                          </li>
                        </ol>
                      </li>
                    </ul>
                  </li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>View team report generation</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ol>
                  <li>In the sidebar menu, select <strong>Team</strong>, and click <strong>All Teams</strong>.</li>
                  <li>Under the <strong>Name</strong> column, select the <strong>team name</strong> you want to check. You will redirect to a new page.</li>
                  <li>
                    You can find the <strong>Team Reports</strong> below the Team Members. The Team Reports table displays member names, company names, and the number of reports.
                    <ul>
                      <li>
                        Update team manager
                        <ol type="a">
                          <li>Click <strong>Edit</strong> below the team name.</li>
                          <li>In the manager field, <strong>enter</strong> the name you want to add as a manager.</li>
                          <li>Click <strong>Save</strong>.</li>
                        </ol>
                      </li>
                      <li>
                        Update team member
                        <ol type="a">
                          <li>Click <strong>Edit</strong> below the team name.</li>
                          <li>Select members by clicking the <strong>checkbox</strong> on the left side of the member name.</li>
                          <li>Click <strong>Save</strong>.</li>
                        </ol>
                      </li>
                    </ul>
                  </li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>Update priority recommendations</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ol>
                  <li>Click <strong>Component</strong> in the sidebar.</li>
                  <li>Click <strong>Translations</strong>.</li>
                  <li><strong>Check</strong> the box right of the recommendation to prioritize it.</li>
                  <li>Click <strong>Save</strong>..</li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>Update Arabic translations</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ul>
                  <li>
                    To change the Arabic translation in the Survey:
                    <ol>
                      <li>Click <strong>Survey</strong> in the sidebar.</li>
                      <li>Click <strong>All Surveys</strong></li>
                      <li>Click the <strong>survey name</strong> you want to change the Arabic translation of.</li>
                      <li>Click <strong>Edit</strong> below the survey name.</li>
                      <li><strong>Enter</strong> Arabic translation in the Arabic field.</li>
                      <li>Click <strong>Save</strong>. </li>
                  </ol>
                  </li>
                  <li>
                    To change the Arabic translation of the recommendations:
                    <ol>
                      <li>Click <strong>Component</strong> in the sidebar.</li>
                      <li>Click <strong>Translations</strong>.</li>
                      <li>Click the <strong>tab</strong> of the survey name you want to change.</li>
                      <li><strong>Enter</strong> Arabic translation in the Arabic text field.</li>
                      <li>Click <strong>Save</strong>. </li>
                    </ol>
                  </li>
                </ul>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>Troubleshooting</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ul>
                  <li>
                    Cannot find case file no. in SME Ratings
                    <p class="mb-0">If you cannot find the case file no. in the SME Ratings:</p>
                    <ul>
                      <li>The file no. may <strong>not be exisiting</strong> in the CRM.</li>
                      <li><strong>Contact</strong> your CRM developer to confirm the Site Visit status.</li>
                    </ul>
                  </li>
                  <li>
                    Error in submitting scores back to CRM
                    <p class="mb-0">These are the possible reasons why there is an error when sending data from the SME Ratings to CRM:</p>
                    <ul>
                      <li>The company may have <strong>no longer</strong> existed on the CRM. It could have been deleted, modified, or updated.</li>
                      <li>If the company is listed in CRM, the company ID recorded in SME Ratings and CRM may have been <strong>different</strong>.</li>
                      <li>The company's status on the CRM is <strong>not on Approved Site Visit</strong> which makes it, perhaps, closed to receive data from SME Ratings.</li>
                    </ul>
                    <p class="mb-0">Try the following steps</p>
                    <ul>
                      <li><strong>Check</strong> if the company you are trying to send the data to is listed on the CRM. You may want to <strong>contact</strong> the person responsible for the CRM about it. Once confirmed, try to send the data again. </li>
                      <li>If the company is listed on the CRM but still failed to send the data, perhaps the company’s status on the CRM is <strong>not Approved Site Visit</strong>, which prevents the CRM from receiving the data. To change its status, you may want to contact the person who handles the CRM records.</li>
                      <li>If the company is listed on the CRM and has an Approved SIte Visit status but still failed to send the data, perhaps the ID in SME Ratings and CRM do not match. To update the company ID in SME Ratings, go to <strong>Find Company</strong>, search the company by entering the file number, then click <strong>Start</strong>. Once updated, try to send the data again.</li>
                      <li>You may want to contact <a href="mailto:analytics@ssagroup.com">analytics@ssagroup.com</a> if the steps mentioned above fail to work.</li>
                    </ul>
                  </li>
                </ul>
              </v-expansion-panel-content>
            </v-expansion-panel>
            <v-expansion-panel>
              <v-expansion-panel-header>Update SSL certificate</v-expansion-panel-header>
              <v-expansion-panel-content>
                <ol type="1">
                  <li>
                    Copy the certificate files to the server.
                    <ol type="a">
                      <li>Download the certificate file (.pfx) from Certificate Authority (CA).</li>
                      <li>
                        Copy the file to the directory on the server where the certificates are kept. (C:\laragon\www\)
                        <ol type="1">
                          <li>Extract .key file from.pfx file.</li>
                          <li>Extract the certificate (.crt) from .pfx file.</li>
                          <li>Convert .pfx file to .pem format. </li>
                        </ol>
                      </li>
                    </ol>
                  </li>
                  <li>
                    Locate the Apache config file to edit.
                    <p class="mb-0">Configure the 00-default.conf file and enter the following commands on the VirtualHost to successfully enable SSL:</p>
                    <v-card color="#f8f9fa" class="py-2 pl-5 my-2">
                      <p class="mb-0">&lt;VirtualHost 192.168.0.1:443&gt;</p>
                        <div class="pa-5">
                          SSLEngine on <br>
                          SSLCertificateFile /path/to/your_domain_name.crt <br>
                          SSLCertificateKeyFile /path/to/your_private.key <br>
                          SSLCertificateChainFile /path/to/cabundle.crt <br>
                        </div>
                      <p class="mb-0">&lt;/VirtualHost&gt;</p>
                    </v-card>
                   </li>
                  <li>
                    Extract .key file from .pfx file
                    <ol type="a">
                      <li>Open the Terminal and go to the folder that contains the .pfx file (C:\laragon\www). Make sure that you are on the right directory.Run the following command to extract the private key:</li>
                      <li>
                        Run the following command to extract the private key:
                        <v-card color="#f8f9fa" class="py-2 pl-5 my-2">
                          <p class="mb-0">openssl pkcs12 -in [yourfile.pfx] -nocerts -out [drlive.key] </p>
                        </v-card>
                      </li>
                      <li>You will be prompted to type the import password. Type the password that you used to protect your keypair when you created the .pfx file. You will be prompted again to provide a new password to protect the .key file that you are creating. Store the password to your key file in a secure place to avoid misuse</li>
                      <li>
                        Run the following command to extract the certificate:
                        <v-card color="#f8f9fa" class="py-2 pl-5 my-2">
                          <p class="mb-0">openssl pkcs12 -in [yourfile.pfx] -clcerts -nokeys -out [drlive.crt]</p>
                        </v-card>
                      </li>
                      <li>
                        Run the following command to decrypt the private key:
                        <v-card color="#f8f9fa" class="py-2 pl-5 my-2">
                          <p class="mb-0">openssl rsa -in [drlive.key] -out [drlive-decrypted.key]</p>
                        </v-card>
                        <p class="mb-0">Type the password that you created to protect the private key file in the previous step.</p>
                        <p class="mb-0">The .crt file and the decrypted and encrypted .key files are available in the path where you started OpenSSL.</p>
                      </li>
                    </ol>
                  </li>
                  <li>
                    Extract the certificate (.crt) from .pfx file
                    <ol type="a">
                      <li>
                        Run the following command to extract the certificate
                        <v-card color="#f8f9fa" class="py-2 pl-5 my-2">
                          <p class="mb-0">openssl pkcs12 -in [yourfile.pfx] -clcerts -nokeys -out [certificate.crt]</p>
                        </v-card>
                      </li>
                    </ol>
                  </li>
                  <li>
                    Converting .pfx file to .pem format
                    <ol type="a">
                      <li>
                        Run the following command to convert the .pfx file to .pem format
                        <v-card color="#f8f9fa" class="py-2 pl-5 my-2">
                          <p class="mb-0">openssl pkcs12 -in filename.pfx -out cert.pem -nodes</p>
                        </v-card>
                      </li>
                    </ol>
                  </li>
                </ol>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </v-row>
      </template>
    <!-- </v-container> -->
  </admin>
</template>


<script>
import $api from './routes/api'

export default {
  data: () => ({
    videos: [],
  }),

  mounted () {
    this.displayVideos()
  },

  methods: {
    displayVideos () {
      axios.get(
        $api.url()
      ).then(response => {
        this.videos = response.data.videos
      })
    },
  },
}
</script>
