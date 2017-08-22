<template>
<div >
    <span class="pull-right">
        {{count_comments}} Comments
</span>
    <br />
    <hr />
  <div v-if="show==true"   v-for="commentt in last_comments">
            <img :src='commentt.user.avatar' width="30px" height="30px" />       {{commentt.comment}}
      <hr />
        </div>
      
  <div v-if="show==false"   v-for="comment in post.comments">
            <img :src='comment.user.avatar' width="30px" height="30px" />       {{comment.comment}}
      <hr />
        </div>
        <center><button class="btn btn-success btn-xs" v-if="show == true" @click="show = false">Show All Comments</button></center>

        <center><button class="btn btn-success btn-xs" v-if="show == false" @click="show = true">Show Less Comments</button></center>
<br />
    <img :src="this.$store.state.auth_user.avatar" width="30px" height="30px" />
    <input style="width:95%" v-model="content"  type="text" class="form-control col-lg-10 pull-right" @keyup.enter="add_comment" name="comment" placeholder="write comment" />
  </div>
</template>
<script>
export default {
    props:['id'],
    mounted(){
        this.get_comments()
    },
    data(){
        return {
            id_post:this.id,
            content:"",
            show:true,
             }
    },
    methods:{
    get_comments(){
        axios.get("/comment/"+this.id).then((resp)=>{
            
            resp.data.forEach((data)=>{
                this.$store.commit("add_comment",data);
            })
        })
    },
 
    add_comment(){
        axios.post("/add_comment",{content:this.content,post_id:this.id_post}).then((resp)=>{
            
            this.content = '';
this.$store.commit("add_comment",{
    post_id:this.id,
    comment:resp.data
});
new Noty({
                    'text':"comment published !",
                    'type':"success",
                    'layout':"bottomLeft"
            }).show()


        })
    },
    //count_comments(){
        //axios.get("/count_comments/"+this.id).then((resp)=>{
        //this.count = resp.data;
      //  })
    //}
    
    },
    computed:{
    count_comments(){
        var comments_arr  = [];
        this.post.comments.forEach((resp)=>{
            comments_arr.push(resp.id);
        })
   return comments_arr.length;

    }, 
        last_comments(){
        
        var comments_arr2  = [];
        this.post.comments.forEach((resp)=>{
            comments_arr2.push(resp);
        })
        return comments_arr2.slice(Math.max(comments_arr2.length - 3, 1))
;
        },
      post(){
        return this.$store.state.posts.find((resp)=>{
            return resp.id === this.id;
        })
      }
    }
}
</script>
