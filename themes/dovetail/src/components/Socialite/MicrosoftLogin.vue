<template>
  <v-btn
    x-large block
    @click="signInWithMicrosoftAccount"
    >
    {{ $t('Sign in with Microsoft Account') }}
  </v-btn>
</template>

<script>
import * as Msal from 'msal'
import store from '@/store'

export default {
  methods: {
    getMsalConfig() {
      const msalConfig = {
        auth: {
          clientId: window.$app.msauth.clientId,
          authority: window.$app.msauth.authority,
          redirectUri: window.$app.msauth.redirectUri,
        },
        cache: {
          cacheLocation: "sessionStorage", // This configures where your cache will be stored
          storeAuthStateInCookie: false, // Set this to "true" if you are having issues on IE11 or Edge
        }
      }

      return new Msal.UserAgentApplication(msalConfig);
    },

    signInWithMicrosoftAccount () {
      let myMSALObj = this.getMsalConfig()
      let vm = this

      const loginRequest = {
        scopes: ["openid", "profile", "User.Read"],
        extraQueryParameters: {
          '$select': 'displayName,givenName,email,mail,id,surname,userPrincipalName'
        }
      }

      let graphConfig = {
        graphMeEndpoint: "https://graph.microsoft.com/v1.0/me",
        graphMailEndpoint: "https://graph.microsoft.com/v1.0/me/messages"
      }

      myMSALObj.loginPopup(loginRequest).then((loginResponse) => {
        const tokenRequest = {
          scopes: ["User.Read"]
        };

        if (myMSALObj.getAccount()) {
          let token = myMSALObj.acquireTokenSilent(loginRequest)
            .catch(error => {
              console.log(error);
              console.log("silent token acquisition fails. acquiring token using popup");

              // fallback to interaction when silent call fails
              return myMSALObj.acquireTokenPopup(request)
                .then(tokenResponse => {
                  return tokenResponse;
                }).catch(error => {
                  console.log(error);
                });
            })

          token.then(response => {
            this.callMSGraph(graphConfig.graphMeEndpoint, response.accessToken, function (data) {
              axios.post(
                '/best/login/microsoft', data
              ).then(response => {
                store.dispatch('auth/socialite', response.data)
                store.dispatch('snackbar/show', {
                  text: 'Welcome back!'
                })
                vm.$router.push({name: 'dashboard'})
              })
            })
          })
        }

      }).catch(function (error) {
        console.log('e', error);
      });
    },

    callMSGraph (theUrl, accessToken, callback) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          callback(JSON.parse(this.responseText));
        }
      }
      xmlHttp.open("GET", theUrl, true); // true for asynchronous
      xmlHttp.setRequestHeader('Authorization', 'Bearer ' + accessToken);
      xmlHttp.send();
    }
  },
}
</script>
