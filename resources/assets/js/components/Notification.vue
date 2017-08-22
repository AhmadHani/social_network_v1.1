<template>
  
</template>
<script>
    export default{
        props:['id'],
        mounted(){
            Echo.private("App.User."+this.id).notification((notification)=>{
                                            new Noty({
                            
                            text: notification.message,
                            layout:"bottomLeft",
                            type:'success',
                            progressBar:true
                            
                            }).show();
                            this.$store.commit("add_not",notification);
                            document.getElementById("noty_audio").play();
            })
        }
    }
</script>