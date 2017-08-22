<template>
<div>
<button class="btn btn-primary btn-xs" v-if="!auth_user_likes_post" @click="like">Like</button>
<button class="btn btn-danger btn-xs" v-else @click="unlike">Unlike</button>
<span>{{count_num}} likes this post</span>
</div>
</template>
<script>

export default {
    mounted(){
    this.count()
    },
props:['id'],
data(){
    return{
count_num:0
    }
},
computed:{
    likers(){
        var likers = [];
        this.post.likes.forEach((like)=>{
            likers.push(like.user.id);
        })
        return likers

    },
    auth_user_likes_post(){
       var check_index =  this.likers.indexOf(
             this.$store.state.auth_user.id
        )
        if(check_index === -1){
            return false;
        }else{
            return true;
        }
    },      
    post(){
        return this.$store.state.posts.find((post)=>{
            return post.id === this.id;
        })
    }
    },
 
  methods:{
    like(){
    axios.get("/like/"+this.id).then((resp)=>{
        this.$store.commit("update_like",{
            post_id:this.id,
            like:resp.data
        })
        this.count_num = this.count_num+1;
        new Noty({
        'text':"success",
        'type':"success",
        'layout':"bottomLeft"
        }).show()
    })
    },
    unlike(){
        axios.get("/unlike/"+this.id).then((resp)=>{
            this.$store.commit("delete_like",{
                post_id:this.id,
                like_id:resp.data
            })
            this.count_num = this.count_num-1;
            
        new Noty({
        'text':"success",
        'type':"success",
        'layout':"bottomLeft"
        }).show()
        })
    },
    count(){
        axios.get("/count/"+this.id).then((resp)=>{
            this.count_num = resp.data;
        })
    }
    }
    
}
</script>
