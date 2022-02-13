<template>
  <div
    class="wrapper"
    :class="[
      { 'nav-open': $sidebar.showSidebar },
      { rtl: $route.meta.rtlActive },
    ]"
  >
    <notifications></notifications>
    <side-bar
      :active-color="sidebarBackground"
      :background-image="sidebarBackgroundImage"
      :data-background-color="sidebarBackgroundColor"
    >
      <user-menu></user-menu>
      <mobile-menu></mobile-menu>
      <template slot="links">
        <sidebar-item
          v-if="$route.meta.rtlActive"
          :link="{
            name: 'لوحة القيادةة',
            icon: 'admin',
            path: '/admin',
          }"
        />
        <sidebar-item
          v-else
          :link="{ name: 'Dashboard', icon: 'admin', path: '/admin' }"
        />

        <sidebar-item closed :link="{ name: 'Fourtune Main ', image: '/img/coin_image.png' }">
          <sidebar-item
            :link="{ 
              name: 'Token Purchases', 
              path: '/main/token-purchases'
              }"
          />
          <sidebar-item
            :link="{
              name: 'Coins Earned',
              path: '/main/coins-earned',
            }"
          />

          <sidebar-item
            :link="{
              name: 'Token Transfer',
              path: '/main/token-transfer',
            }"
          />

          <sidebar-item
            :link="{
              name: 'Fourtune Token Price',
              path: '/main/set-token',
            }"
          />
        </sidebar-item>


		
		 <sidebar-item opened :link="{ name: 'Fourtune Events', image: '/img/ticket-3.jpg' }">
          <sidebar-item
            :link="{ name: 'Post Event', path: '/main/post-event'}"
          />
          <sidebar-item
            :link="{
              name: 'List Events ',
              path: '/main/list-events',
            }"
          />
        </sidebar-item>
		


        <sidebar-item opened :link="{ name: 'Users', image: '/img/user_image_golden.png' }">
          <sidebar-item
            :link="{ name: 'User Profile', path: '/main/user-profile' }"
          />
          <sidebar-item
            :link="{
              name: 'User Management',
              path: '/main/list-users',
            }"
          />
        </sidebar-item>



        <li class="button-container">
          <div class="">
            <md-button @click="logout"
              class="md-block md-danger"          
              target="_blank"
              >Sign Out
            </md-button>
          </div>
        </li>
      </template>
    </side-bar>

    <div class="main-panel">
      <top-navbar></top-navbar>  

      <div :class="{ content: !$route.meta.hideContent }">
        <zoom-center-transition :duration="200" mode="out-in">
          <!-- your content here -->
          <router-view />
        </zoom-center-transition>
      </div>
      <content-footer v-if="!$route.meta.hideFooter"></content-footer>
    </div>
  </div>
</template>
<script>
/* eslint-disable no-new */
import PerfectScrollbar from "perfect-scrollbar";
import "perfect-scrollbar/css/perfect-scrollbar.css";

function hasElement(className) {
  return document.getElementsByClassName(className).length > 0;
}

function initScrollbar(className) {
  if (hasElement(className)) {
    new PerfectScrollbar(`.${className}`);
    document.getElementsByClassName(className)[0].scrollTop = 0;
  } else {
    // try to init it later in case this component is loaded async
    setTimeout(() => {
      initScrollbar(className);
    }, 100);
  }
}

function reinitScrollbar() {
  let docClasses = document.body.classList;
  let isWindows = navigator.platform.startsWith("Win");
  if (isWindows) {
    // if we are on windows OS we activate the perfectScrollbar function
    initScrollbar("sidebar");
    initScrollbar("sidebar-wrapper");
    initScrollbar("main-panel");

    docClasses.add("perfect-scrollbar-on");
  } else {
    docClasses.add("perfect-scrollbar-off");
  }
}

import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import MobileMenu from "./Extra/MobileMenu.vue";
import UserMenu from "./Extra/UserMenu.vue";

export default {
  components: {
    TopNavbar,
    ContentFooter,  
    MobileMenu,
    UserMenu,
  },
  data() {
    return {
      sidebarBackgroundColor: "black",
      sidebarBackground: "green",
      sidebarBackgroundImage:
        process.env.VUE_APP_APP_BASE_URL + "/img/fourtunelogo.png",
      sidebarMini: true,
      sidebarImg: true,
      image: process.env.VUE_APP_APP_BASE_URL + "/img/laravel-vue.svg",
 
    };
  },
  methods: {
    logout() {
      this.$store.dispatch("logout");
    },
    toggleSidebar() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
    minimizeSidebar() {
      if (this.$sidebar) {
        this.$sidebar.toggleMinimize();
      }
    },
  },
  updated() {
    reinitScrollbar();
  },
  mounted() {
    reinitScrollbar();
  },
  watch: {
    sidebarMini() {
      this.minimizeSidebar();
    },
  },
};
</script>
<style lang="scss">
$scaleSize: 0.95;
@keyframes zoomIn95 {
  from {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
  to {
    opacity: 1;
  }
}
.main-panel .zoomIn {
  animation-name: zoomIn95;
}
@keyframes zoomOut95 {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
}
.main-panel .zoomOut {
  animation-name: zoomOut95;
}
</style>
