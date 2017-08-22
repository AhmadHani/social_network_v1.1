<template>
<div class="container">

    <div class="row">
    
    <div class="">
    						<div class="widget-area no-padding blank">
								<div class="status-upload">
									<div>
										<textarea placeholder="What are you doing right now?" v-model="content"></textarea>
										<ul >
                                            <!--
											<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a></li>
											<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
											<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>
											<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
                                            -->
                                        
		<li  @click="showlist()"><a  title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
          
            <select v-if="showlist1" class="form-control" v-model="status_id1"  >

                <option v-for="s in status" :value="s.id" >{{s.status}}</option>     
            </select>
               
	
          
        </ul>
                                      								<button type="submit" :disabled="button" @click="create_post()" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
									</div>
								</div><!-- Status Upload  -->
							</div><!-- Widget Area -->
						</div>
        
    </div>
</div>
</template>


<script>
    export default{
        props:['type'],
        data(){
            return{
                content:'',
                button:false,
                showlist1:'',
                status:[],
                status_id1:'',
                type1:this.type
            
            }
        },
        
        mounted(){
            this.all_status()
        },
        methods:{
            create_post(){
                
                axios.post("/post",{content:this.content,status_id1:this.status_id1}).then((resp)=>{
            
              this.content = '';
              new Noty({
                    text:"Your post has been published!",
                    layout:"bottomLeft",
                    theme:"mint",
                    type:"success"
              }).show();
        
                this.$store.commit("add_post",resp.data);
                this.$store.commit("add_my_posts",resp.data);
                })
            },
            showlist(){
                this.showlist1 = true;
            },
            all_status(){
                axios.get("/all_status").then((resp)=>{
                    this.status = resp.data;
                this.showlist1 = false;
                });
            }
        },
        watch:{
            content(){
                if(this.content.length > 0){
                    this.button = false;
                }else{
                    this.button = true;
                }
            }
        }
    }
</script>