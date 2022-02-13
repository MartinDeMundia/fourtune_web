<template>
  <div class="full-page" :class="{ 'nav-open': $sidebar.showSidebar }">
    <md-toolbar md-elevation="0" class="md-transparent md-toolbar-absolute">
      <div class="md-toolbar-row md-offset">
        <div class="md-toolbar-section-start">
          <h3 class="md-title"></h3>
        </div>
        <div class="md-toolbar-section-end">
          <md-button
            class="md-just-icon md-simple md-round md-toolbar-toggle"
            :class="{ toggled: $sidebar.showSidebar }"
            @click="toggleSidebar"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </md-button>

          <div
            class="md-collapse"
            :class="{ 'off-canvas-sidebar': responsive }"
          >
            <md-list>
              <!--<md-list-item href="/register" @click="linkClick">
                <md-icon>person_add</md-icon>
                Register
              </md-list-item>-->
              <md-list-item href="/login" @click="linkClick" v-if="!$store.getters['isAuthenticated']">
                <md-icon>fingerprint</md-icon>
                Login
              </md-list-item>
            </md-list>
          </div>
        </div>
      </div>
    </md-toolbar>
    <div class="wrapper wrapper-full-page" @click="toggleSidebarPage">
      <notifications/>
      <div
        class="page-header header-filter"
        :class="setPageClass"
        filter-color="black"
        :style="setBgImage"
      >
        <div class="container md-offset">
          <zoom-center-transition
            :duration="pageTransitionDuration"
            mode="out-in"
          >
            <router-view></router-view>
          </zoom-center-transition>
        </div>
        <footer class="footer">
          
          <div class="container md-offset">
            <nav>
              <ul>
                <li>
                  <a href="home" target="_blank">
                    Hone
                  </a>
                </li>
                <li>
                  <a href="about" target="_blank">
                    About
                  </a>
                </li>
                <li>
                  <a href="fourtune" target="_blank">
                    Fourtune Cryptocurrency
                  </a>
                </li>
                <li>
                  <a href="contact" target="_blank">
                    Contact Us
                  </a>
                </li>
                <li>                
                </li>
              </ul>
            </nav>

                 <div class="copyright text-center">
        &copy; {{ new Date().getFullYear() }},
        made with <i class="fa fa-heart heart"></i>
        by
        <a href="http://coreict.co.ke" target="_blank">Core ICT Consultancy</a>
        development team.
      </div>
 
          </div>
        </footer>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    backgroundColor: {
      type: String,
      default: "black"
    }
  },
  inject: {
    autoClose: {
      default: true
    }
  },
  data() {
    return {
      responsive: false,
      showMenu: false,
      menuTransitionDuration: 250,
      pageTransitionDuration: 300,
      year: new Date().getFullYear()
    };
  },
  computed: {
    setBgImage() {
      let images = {
        Login: process.env.VUE_APP_APP_BASE_URL + "/img/fourtunelogo.png",
        Register: process.env.VUE_APP_APP_BASE_URL + "/img/register.jpg",
      };
      return {
        backgroundImage: `url(${images[this.$route.name]})`
      };
    },
    setPageClass() {
      return `${this.$route.name}-page`.toLowerCase();
    }
  },
  methods: {
    toggleSidebarPage() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
    linkClick() {
      if (
        this.autoClose &&
        this.$sidebar &&
        this.$sidebar.showSidebar === true
      ) {
        this.$sidebar.displaySidebar(false);
      }
    },
    toggleSidebar() {
      this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
    },
    toggleNavbar() {
      document.body.classList.toggle("nav-open");
      this.showMenu = !this.showMenu;
    },
    closeMenu() {
      document.body.classList.remove("nav-open");
      this.showMenu = false;
    },
    onResponsiveInverted() {
      if (window.innerWidth < 991) {
        this.responsive = true;
      } else {
        this.responsive = false;
      }
    }
  },
  mounted() {
    this.onResponsiveInverted();
    window.addEventListener("resize", this.onResponsiveInverted);
  },
  beforeDestroy() {
    this.closeMenu();
    window.removeEventListener("resize", this.onResponsiveInverted);
  },
  beforeRouteUpdate(to, from, next) {
    // Close the mobile menu first then transition to next page
    if (this.showMenu) {
      this.closeMenu();
      setTimeout(() => {
        next();
      }, this.menuTransitionDuration);
    } else {
      next();
    }
  }
};
</script>
<style lang="scss" scoped>
$scaleSize: 0.1;
$zoomOutStart: 0.7;
$zoomOutEnd: 0.46;
@keyframes zoomIn8 {
  from {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
  100% {
    opacity: 1;
  }
}
.wrapper-full-page .zoomIn {
  animation-name: zoomIn8;
}
@keyframes zoomOut8 {
  from {
    opacity: 1;
    transform: scale3d($zoomOutStart, $zoomOutStart, $zoomOutStart);
  }
  to {
    opacity: 0;
    transform: scale3d($zoomOutEnd, $zoomOutEnd, $zoomOutEnd);
  }
}
.wrapper-full-page .zoomOut {
  animation-name: zoomOut8;
}
</style>
