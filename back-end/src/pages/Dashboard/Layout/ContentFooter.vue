<template>
  <footer class="footer">
    <div class="container" >
     <nav>
        <ul>
          <li>
            <a v-if="$route.meta.rtlActive" href="#" target="_blank">
              منزل
            </a>
            <a v-else href="#" target="_blank">
              Focus Group Limited
            </a>
          </li>
          <li>
            <a href="#" target="_blank">
              Dashboard
            </a>
          </li>
          <li>
            <a v-if="$route.meta.rtlActive" href="#" target="_blank">
              شركة
            </a>
            <a v-else href="#">
              Fourtune Website
            </a>
          </li>
          <li>
            <a v-if="$route.meta.rtlActive" href="#" target="_blank">
              محفظة
            </a>
            <a v-else href="#" target="_blank">
              About Us
            </a>
          </li>
          <li>
            <a v-if="$route.meta.rtlActive" href="#" target="_blank">
              بلوق
            </a>
            <a v-else href="#" target="_blank">
              Contact US
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright text-center" >
        &copy; {{ new Date().getFullYear() }},
        made with <i class="fa fa-heart heart"></i>
        by
        <a href="http://coreict.co.ke" target="_blank">Core ICT Consultancy</a>
        development team.
      </div>
    </div>
  </footer>
</template>
<script>
export default {};
</script>
<style></style>
