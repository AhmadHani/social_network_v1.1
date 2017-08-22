<template>
<div class="container">
    <div class="row">
        <div class="" v-for="post in posts">
            <div class="panel panel-primary" style="border-radius:0">
                <div class="panel-heading">By {{post.user.name}}
                    
<small v-if="post.status != null">Feel Like {{post.status.status}}</small>  
                    <span class="pull-right"> {{post.created_at}}</span>

                </div>
                <div class="panel-body">{{post.body}}
 <hr />
            <like  style="height: 0px; position:relative" :id="post.id"></like>
    <comment  :id="post.id"></comment>
    
                </div>
               
            </div>
        </div>



        
    </div>
    </div>  
</template>

<script>
import Like from "./Like.vue";
import Comment from "./Comment.vue";
export default {
    mounted(){
        this.get_feed()
        this.get_my_posts()
    },
    components:{
        Like,Comment
    },
    data(){
        return {
            profile:this.giveprofile
        }
    },
    props:['giveprofile'],
  methods:{
      get_feed(){
          axios.get("/feed").then((resp)=>{
              resp.data.forEach((data)=>{
                this.$store.commit("add_post",data);         
            
            })
      });
      
  },
  get_my_posts(){
          axios.get("/my_posts").then((resp)=>{
              resp.data.forEach((data)=>{
                  this.$store.commit("add_my_posts",data);
              })
          })
      }
},
computed:{
   
    
   posts(){
       if(this.profile === true){
        return this.$store.getters.all_posts;
       }else{
return this.$store.getters.my_posts;      
       }
    }
}
}
</script>

