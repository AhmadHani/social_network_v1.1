
<template>
<div class="pull-right">
                   <p v-show="loading">
                       Loading ...
                       </p>     

                       <div v-if="!loading">
                           <button class="btn btn-primary" v-if="status == 0" @click="add_friend">Add Friend</button>
                           <span class="btn btn-success" v-if="status == 'friends'" >Friends</span>
                           <button class="btn btn-primary" v-if="status == 'pending'" @click="accept_friend">Accept Friend</button>
                           <span class="btn btn-success" v-if="status == 'waiting'">Waiting For Response</span>

                       </div>

     </div>       
        
</template>
<script>
    export default{
       mounted() {
            axios.get("/check/"+this.profile_user_id).then((res)=>{
                this.status = res.data.status;
                this.loading = false;
            })
            },
        props:['profile_user_id'],
        data(){
            return {
                status:'',
                loading:true
            }
        },
        methods:{
            add_friend(){
                this.loading = true;
                axios.get("/add_friend/"+this.profile_user_id).then((resp) =>{
                    this.status = "waiting";
                    this.loading = false;
                });
            },
            accept_friend(){
                this.loading = true;
                axios.get("/accept_friend/"+this.profile_user_id).then((resp)=>{
                    this.status = "friends";
                    this.loading = false;
                });
            }
        }
    }
</script>