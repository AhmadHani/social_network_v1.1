<template>
  
</template>

<script>
export default {
  mounted(){
    this.auth_user_data()
  },
  methods:{
      auth_user_data(){
          axios.get("/auth_user_data").then((resp)=>{

            this.$store.commit("auth_user_data",resp.data);

          })
      }
  }
}
</script>
