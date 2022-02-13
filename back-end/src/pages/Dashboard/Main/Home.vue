<template>
  <div class="md-layout">
   load home
  </div>
</template>
<script>  
import * as $ from "jquery";
  export default {
    components: {
    },
    data: () => ({
    }),
    computed: {
    },
    created() {
       this.$router.push({ name: 'Dashboard' });
       //this.$router.push({ name: 'Profile' });
    },
    methods: {  
    }
  }

</script>