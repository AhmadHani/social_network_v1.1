<template>
    <li>
          <a href="/notifications" >Notificaions <span class="badge" >{{all_nots_count}}</span></a>
                
          </li>
</template>

<script>
    export default{
        
        mounted(){
            this.get_unread()
                      
        },
        methods:{
            get_unread(){
                axios.get("/unread").then((resp)=>{
                    resp.data.forEach((data)=> {
                           this.$store.commit("add_not",data); 
                    });
                })
            }
              
            
        },
        computed:{
            all_nots_count(){
                return this.$store.getters.all_nots_count;
            }
        }
    }
</script>
